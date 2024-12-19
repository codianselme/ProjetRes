<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Sale;
use GuzzleHttp\Client;
use App\Models\Invoice;
use App\Models\VenteMasters;
use Illuminate\Http\Request;
use \CloudConvert\Models\Job;
use App\Models\VentePhysique;
use \CloudConvert\Models\Task;
use \CloudConvert\CloudConvert;
use App\Models\VenteCommercial;
use App\Services\InvoiceService;
use MercurySeries\Flashy\Flashy;
use App\Services\SgmefApiService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Client\Factory as HttpClient;

class InvoicesController extends Controller
{
    

    public function downloadInvoice(Request $request, $venteId)
    {
        try {
            // Log initial à l'appel de la fonction
            $currentUser = Auth::user();
            $currentDateTime = now();
            Log::channel('invoice')->info('Appel de la méthode downloadInvoice', [
                'user' => $currentUser->id,
                'username' => $currentUser->name,
                'date_time' => $currentDateTime,
                'vente_id' => $venteId,
            ]);

            // Récupérer le type de vendeur à partir de la requête ou d'une logique spécifique
            $typeVendeur = $request->input('typeVendeur', 'vente_physiques');

            // Récupérer la vente en fonction du type de vendeur
            switch ($typeVendeur) {
                case 'vente_masters':
                    $vente = VenteMasters::findOrFail($venteId);
                    break;
                case 'vente_physiques':
                    $vente = VentePhysique::findOrFail($venteId);
                    break;
                case 'vente_commercials':
                    $vente = VenteCommercial::findOrFail($venteId);
                    break;
                default:
                    throw new \Exception('Type de vendeur non pris en charge : ' . $typeVendeur);
            }

            // Récupérer la clé API depuis le fichier .env
            $apiKey = env('CLOUDCONVERT_API_KEY');
            if (!$apiKey) {
                throw new \Exception('Clé API CloudConvert non définie');
            }

            $cloudconvert = new CloudConvert(['api_key' => $apiKey]);

            // Créer les tâches de conversion et d'exportation
            $convert = (new Job())
                ->addTask(
                    (new Task('capture-website', 'invoice' . $venteId))
                        ->set('url', $this->getVenteUrl($vente, $typeVendeur)) // Fonction pour récupérer l'URL spécifique en fonction du type de vendeur
                        ->set('output_format', 'pdf')
                        ->set('engine', 'chrome')
                        ->set('pages', '1')
                        ->set('zoom', 1)
                        ->set('print_background', true)
                        ->set('display_header_footer', false)
                )
                ->addTask(
                    (new Task('export/url', 'export-invoice' . $venteId))
                        ->set('input', ['invoice' . $venteId])
                        ->set('inline', true)
                        ->set('archive_multiple_files', true)
                        ->set('redirect', 'true')
                );

            Log::channel('invoice')->info('Tâches de conversion et d\'exportation créées', ['vente_id' => $venteId]);

            // Créer le job CloudConvert
            $job = $cloudconvert->jobs()->create($convert);
            $jobId = $job->getId();
            Log::channel('invoice')->info('Job CloudConvert créé', ['job_id' => $jobId]);

            // Faire une requête GET pour obtenir l'URL du fichier converti
            $client = new Client();
            $response = $client->request('GET', 'https://sync.api.cloudconvert.com/v2/jobs/' . $jobId, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $apiKey,
                ],
            ]);

            $body = $response->getBody();
            $data = json_decode($body, true);
            $url = $data['data']['tasks'][0]['result']['files'][0]['url'];

            Log::channel('invoice')->info('URL du fichier converti récupérée', ['url' => $url]);

            return redirect($url);
        } catch (\Exception $e) {
            // Journaliser l'erreur
            Log::channel('invoice')->error('Erreur lors de la création de la facture PDF', [
                'message' => $e->getMessage(),
                'user' => $currentUser->id,
                'username' => $currentUser->name,
                'date_time' => $currentDateTime,
                'vente_id' => $venteId,
            ]);
            return back()->with('error', 'Une erreur s\'est produite lors de la création de la facture PDF. Veuillez réessayer plus tard.');
        }
    }

    private function getVenteUrl($vente, $typeVendeur)
    {
        switch ($typeVendeur) {
            case 'vente_masters':
                return route('vente_masters.show', $vente->id);
            case 'vente_physiques':
                return route('vente_physiques.show', $vente->id);
            case 'vente_commercials':
                return route('vente_commercials.show', $vente->id);
            default:
                throw new \Exception('Type de vendeur non pris en charge : ' . $typeVendeur);
        }
    }


    public function createCreditInvoice($invoiceId, $ids, $typeVendeur)
    {
        Log::channel('invoice')->info('Starting creation of credit invoice', ['invoice_id' => $invoiceId]);

        try {
            // Decode IDs and validate
            $idsArray = json_decode($ids, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('Invalid JSON format for IDs.');
            }

            // Fetch sales based on vendor type
            $ventes = $this->fetchSalesByType($typeVendeur, $idsArray);

            // Retrieve the original invoice
            $invoice = Invoice::find($invoiceId);
            if (!$invoice) {
                Log::channel('invoice')->error('Original invoice not found', ['invoice_id' => $invoiceId]);
                throw new Exception('Original invoice not found.');
            }

            Log::channel('invoice')->info('Original invoice retrieved', ['invoice' => $invoice]);

            // Validate the original invoice
            if ($invoice->statusInvoice != 'confirm' || $invoice->typeInvoice != 'FV') {
                Log::channel('invoice')->error('Original invoice not confirmed or not type FV', [
                    'invoice_id' => $invoiceId,
                    'statusInvoice' => $invoice->statusInvoice,
                    'typeInvoice' => $invoice->typeInvoice,
                ]);
                throw new Exception('Original invoice not confirmed or not type FV.');
            }

            // Check if credit invoice already exists
            $existingCreditInvoice = Invoice::where('invoice_number', $invoice->invoice_number . '_FA')
                ->where('typeInvoice', 'FA')
                ->first();
            if ($existingCreditInvoice) {
                Log::channel('invoice')->error('Credit invoice already exists for the original invoice', [
                    'invoice_id' => $invoiceId,
                    'reference' => $invoice->invoice_number . '_FA',
                ]);
                throw new Exception('Credit invoice already exists for this original invoice.');
            }

            Log::channel('invoice')->info('No existing credit invoice found, continuing process');

            // Prepare credit invoice data
            $origineReference = $invoice->invoiceRequestDataDto['reference'] . '_FA';
            $creditInvoiceData = $invoice->invoiceRequestDataDto;
            $creditInvoiceData['type'] = 'FA';
            $creditInvoiceData['reference'] = $invoice->securityElementsDto['codeMECeFDGI'];

            Log::channel('invoice')->info('Credit invoice data prepared', ['creditInvoiceData' => $creditInvoiceData]);

            // Create the credit invoice request data
            $invoiceService = new InvoiceService();
            $creditInvoiceRequestDataDto = $invoiceService->invoiceRequestDataDto(
                $creditInvoiceData,
                $idsArray,
                $typeVendeur,
                $invoice->user_id,
                $invoice->structure_id,
                $origineReference
            );
            Log::channel('invoice')->info('Credit invoice request data created', ['creditInvoiceRequestDataDto' => $creditInvoiceRequestDataDto]);

            // Call the API to create the credit invoice
            $sgmefApiService = new SgmefApiService(new HttpClient());
            $createCreditInvoice = $sgmefApiService->createInvoice($creditInvoiceData);
            Log::channel('invoice')->info('Credit invoice created successfully via API', ['createCreditInvoice' => $createCreditInvoice]);

            // Update the invoice with the response data
            $creditInvoiceResponseDataDto = $invoiceService->invoiceResponseDataDto(
                $createCreditInvoice,
                $idsArray,
                $typeVendeur,
                'FA',
                $origineReference
            );

            Log::channel('invoice')->info('Credit invoice response data saved', ['creditInvoice' => $creditInvoiceResponseDataDto]);

            // Success feedback
            Flashy::success('Credit invoice generated successfully.');

            // Prepare final data for response
            return [
                'createCreditInvoice' => $createCreditInvoice,
                'creditInvoiceData' => $creditInvoiceData,
                'creditInvoice' => $creditInvoiceResponseDataDto,
                'origineReference' => $origineReference,
            ];

        } catch (Exception $e) {
            // Error handling
            Log::channel('invoice')->error('Error creating credit invoice', [
                'invoice_id' => $invoiceId,
                'error_message' => $e->getMessage(),
            ]);

            Flashy::error('An error occurred while creating the credit invoice. Please try again later.');

            return back()->with('error', 'An error occurred while creating the credit invoice. Please try again later.');
        }
    }



    private function fetchSalesByType($typeVendeur, array $idsArray)
    {
        switch ($typeVendeur) {
            case 'vente_masters':
                return VenteMasters::whereIn('id', $idsArray)->get();
            case 'vente_physiques':
                return VentePhysique::whereIn('id', $idsArray)->get();
            case 'vente_commercials':
                return VenteCommercial::whereIn('id', $idsArray)->get();
            default:
                throw new Exception('Unsupported vendor type: ' . $typeVendeur);
        }
    }


    
    public function show($id, $user_id)
    {
        
        // logActivity( 'create Invoice Data.');

        Log::channel('invoice')->info('Début du processus de récupération des ventes', [
            'id' => $id,
            //'type_vendeur' => $typeVendeur,
            'user_id' => $user_id,
            //'structure_id' => $structure_id,
        ]);

        try {

            // $idsArray = explode(',', $ids);

            Log::channel('invoice')->info('Récupération de la vente', ['id_vente' => $id]);
            
            $vente = Sale::where('id', $id)->with('items')->get();

            Log::channel('invoice')->info('Vente récupérées avec succès', ['vente' => $vente]);

            if ($vente->isEmpty()) {
                Log::channel('invoice')->error('Les vente spécifiées n\'existent pas.');
                return back()->with('error', 'Les vente spécifiées n\'existent pas.');
            }

            $firstVente = $vente->first();
            $existingInvoice = Invoice::where('invoice_number', $firstVente->invoice_number)->first();
            // dd($existingInvoice);

            if ($existingInvoice != null) {
                Log::channel('invoice')->info('Facture déjà générée', ['existing_invoice' => $existingInvoice]);
                if ($existingInvoice->statusInvoice == 'confirm' || $existingInvoice->statusInvoice == 'cancel') {
                    Flashy::success('Facture déjà générée.');
                    return view('livewire.dashboard.normalize-invoices.create', [
                        'createInvoice' => $existingInvoice?->invoiceResponseDataDto,
                        'data' => $existingInvoice?->invoiceRequestDataDto,
                        'invoice' => $existingInvoice,
                        'securityElementsDto' => $existingInvoice?->securityElementsDto,
                    ]);
                } else {
                    // dd($existingInvoice?->invoiceResponseDataDto, $existingInvoice?->invoiceRequestDataDto, $existingInvoice, $existingInvoice?->securityElementsDto);
                    Flashy::info('Facture partiellement générée.');
                    return view('livewire.dashboard.normalize-invoices.create', [
                        'createInvoice' => $existingInvoice?->invoiceResponseDataDto,
                        'data' => $existingInvoice?->invoiceRequestDataDto,
                        'invoice' => $existingInvoice,
                        'securityElementsDto' => $existingInvoice?->securityElementsDto,
                    ]);
                }
            }

            

            Log::channel('invoice')->info('Début du processus de création de la facture');

            $httpClient = new HttpClient();
            $invoiceService = new InvoiceService();
            $sgmefApiService = new SgmefApiService($httpClient);
            
            $data = $invoiceService->createInvoiceData($vente);
            $invoiceRequestDataDto = $invoiceService->invoiceRequestDataDto($data, $id, $user_id);
            dd($vente, $data, $invoiceRequestDataDto);
            $createInvoice = $sgmefApiService->createInvoice($data);
            $invoiceResponseDataDto = $invoiceService->invoiceResponseDataDto($createInvoice, $id, 'FV', $firstVente->invoice_number);
            $invoice = $invoiceResponseDataDto;

            dd($httpClient, $invoiceService, $sgmefApiService);

            Log::channel('invoice')->info('Facture créée avec succès', ['create_invoice' => $createInvoice]);

            Flashy::success('L\'envoi de la vente à la DGI effectué');
            if (isset($createInvoice['errorDesc'])) {
                Log::channel('invoice')->error('Erreur lors de la création de la facture : ' . $createInvoice['errorDesc']);
                Flashy::error('Une erreur s\'est produite' . $createInvoice['errorDesc']);
                return back()->with('error', "Une erreur s'est produite : " . $createInvoice['errorDesc']);
            } else {
                Log::channel('invoice')->info('Facture créée avec succès');
                Flashy::success('L\'envoi de la vente à la DGFI effectué');
                return view('livewire.dashboard.normalize-invoices.create', compact('createInvoice', 'data', 'invoice'));
            }
        } catch (Exception $e) {
            Log::channel('invoice')->error('Erreur lors de la création de la facture : ' . $e->getMessage());
            Flashy::error('Une erreur s\'est produite lors de la création de la facture. Veuillez réessayer plus tard.');
            return back()->with('error', 'Une erreur s\'est produite lors de la création de la facture. Veuillez réessayer plus tard.');
        }
    }

    public function returnviewaftercancelinvoice($invoice_number)
    {
        $existingInvoice = Invoice::where('invoice_number', $invoice_number)->first();

        Flashy::success('Facture d\'avoir générée .');
        return view('livewire.direction.normalize-invoices.create', [
            'createInvoice' => $existingInvoice?->invoiceResponseDataDto,
            'data' => $existingInvoice?->invoiceRequestDataDto,
            'invoice' => $existingInvoice,
            'securityElementsDto' => $existingInvoice?->securityElementsDto,
        ]);
    }

    public function confirmInvoiceQrCode(int $invoice_id)
    {
        try {
            Log::channel('invoice')->info('Attempting to find invoice for cancellation QR code generation', ['invoice_id' => $invoice_id]);

            $invoice = Invoice::findOrFail($invoice_id);
            $existingInvoice = Invoice::where(function ($query) use ($invoice_id) {
                $query->where('id', $invoice_id)
                    ->where(function ($query) {
                        $query->where('statusInvoice', 'confirm')
                            ->whereNotNull('securityElementsDto->qrCode');
                    })
                    ->orWhere(function ($query) {
                        $query->where('statusInvoice', 'cancel')
                            ->whereNotNull('securityElementsDto->dateTime')
                            ->whereNull('securityElementsDto->qrCode');
                    });
            })->first();

            if ($existingInvoice) {
                Log::channel('invoice')->warning('QR code or cancellation already processed for invoice', ['invoice_id' => $invoice_id]);

                Flashy::success('Un QR code de confirmation ou d\'annulation a déjà été généré pour la facture.');
                return redirect()->route('sales.index');
            }

            $securityElementsDto = $this->processInvoiceQrCode($invoice->invoiceResponseDataDto['uid'], 'confirm', $invoice_id);

            if (isset($securityElementsDto['errorDesc'])) {
                Log::channel('invoice')->error('Error creating QR code for confirmation', [
                    'invoice_id' => $invoice_id,
                    'error_message' => $securityElementsDto['errorDesc'],
                ]);
                Flashy::error('Une erreur s\'est produite lors de la création du QR code de confirmation.' . $securityElementsDto['errorDesc']);
                return back()->with('error', 'Une erreur s\'est produite lors de la création du QR code de confirmation.' . $securityElementsDto['errorDesc']);
            } else {
                Log::channel('invoice')->info('QR code for confirmation generated successfully', ['invoice_id' => $invoice_id]);
                Flashy::success('La Génération du QR code a été effectuée');
                return redirect()->route('invoice.final', $invoice_id)->with('success', 'La Génération du QR code a été effectuée');
            }
        } catch (Exception $e) {
            Log::channel('invoice')->error('Error creating QR code for confirmation: ' . $e->getMessage(), ['invoice_id' => $invoice_id]);
            Flashy::error('Error creating QR code for confirmation: ' . $e->getMessage(), ['invoice_id' => $invoice_id]);
            return back()
                ->with('error', 'Une erreur s\'est produite lors de la création du QR code de confirmation.' . $e->getMessage());
        }
    }

    public function cancelInvoiceQrCode($invoice_id)
    {
        try {
            Log::channel('invoice')->info('Attempting to find invoice for cancellation QR code generation', ['invoice_id' => $invoice_id]);

            $invoice = Invoice::findOrFail($invoice_id);
            $existingInvoice = Invoice::where(function ($query) {
                $query->where('statusInvoice', 'cancel')
                    ->whereNotNull('securityElementsDto->dateTime')
                    ->whereNull('securityElementsDto->qrCode')
                    ->orWhere(function ($query) {
                        $query->where('statusInvoice', 'confirm')
                            ->whereNotNull('securityElementsDto->qrCode');
                    });
            })->first();

            if ($existingInvoice) {
                Log::channel('invoice')->warning('QR code or cancellation already processed for invoice', ['invoice_id' => $invoice_id]);

                Flashy::success('Un QR code d\'annulation est déjà en cours de traitement.');
                return redirect()->route('invoices.show', $invoice_id);
            }

            $securityElementsDto = $this->processInvoiceQrCode($invoice->invoiceResponseDataDto['uid'], 'cancel', $invoice_id);

            if (isset($securityElementsDto['errorDesc'])) {
                Log::channel('invoice')->error('Error creating QR code for cancellation', [
                    'invoice_id' => $invoice_id,
                    'error_message' => $securityElementsDto['errorDesc'],
                ]);
                Flashy::error('Une erreur s\'est produite lors de l\'annulation du QR code de confirmation.' . $securityElementsDto['errorDesc']);
                return back()->with('error', 'Une erreur s\'est produite lors de l\'annulation du QR code de confirmation.' . $securityElementsDto['errorDesc']);
            } else {
                Log::channel('invoice')->info('QR code for cancellation generated successfully', ['invoice_id' => $invoice_id]);
                Flashy::success('L\'Annulation du QR code a été effectuée');
                return redirect()->route('invoice.final', $invoice_id)->with('success', ' L\'Annulation du QR code a été effectuée');
            }
        } catch (\Exception $e) {
            Log::channel('invoice')->error('Error creating QR code for cancellation: ' . $e->getMessage(), ['invoice_id' => $invoice_id]);
            Flashy::error('Une erreur s\'est produite lors de la création du QR code d\'annulation..' . $e->getMessage());
            return back()
                ->with('error', 'Une erreur s\'est produite lors de la création du QR code d\'annulation. Veuillez réessayer plus tard.');
        }
    }

    public function modalqrcode($invoice_id)
    {
        # code...
        $invoice = Invoice::find($invoice_id);

        $data = $invoice->invoiceRequestDataDto;

        $createInvoice = $invoice->invoiceResponseDataDto;

        return view('livewire.direction.normalize-invoices.qrcodeModal', compact('createInvoice', 'data', 'invoice_id'));
    }

    /**
     * Process the invoice QR code based on the status.
     */
    private function processInvoiceQrCode($uid, $statusInvoice, $invoice_id)
    {

        try {
            Log::channel('invoice')->info('Processing QR code generation for invoice', [
                'invoice_id' => $invoice_id,
                'status_invoice' => $statusInvoice,
                'uid' => $uid,
            ]);

            $httpClient = new HttpClient();
            $sgmefApiService = new SgmefApiService($httpClient);
            if ($statusInvoice === 'confirm') {
                $invoiceResponseDataDto = $sgmefApiService->confirmInvoice($uid);
            } else {
                $invoiceResponseDataDto = $sgmefApiService->cancelInvoice($uid);
            }

            Log::channel('invoice')->info('QR code generated successfully', [
                'invoice_id' => $invoice_id,
                'status_invoice' => $statusInvoice,
                'uid' => $uid,
            ]);

            $invoiceService = new InvoiceService();
            $securityElementsDto = $invoiceService->securityElementsDto($invoiceResponseDataDto, $invoice_id, $statusInvoice);

            return $securityElementsDto;
        } catch (Exception $e) {
            Log::channel('invoice')->error('Error processing QR code generation: ' . $e->getMessage(), [
                'invoice_id' => $invoice_id,
                'status_invoice' => $statusInvoice,
                'uid' => $uid,
            ]);

            throw $e;
        }
    }

    public function finalinvoice($invoice_id)
    {
        // Log initial à l'appel de la fonction
        $currentUser = Auth::user();
        $currentDateTime = now();
        Log::channel('invoice')->info('Appel de la méthode finalinvoice', [
            'user_id' => $currentUser->id,
            'username' => $currentUser->name,
            'date_time' => $currentDateTime,
            'invoice_id' => $invoice_id,
        ]);

        try {
            // Récupération de la facture par ID
            $invoice = Invoice::find($invoice_id);
            if (!$invoice) {
                Log::channel('invoice')->warning('Facture non trouvée', [
                    'invoice_id' => $invoice_id,
                ]);
                Flashy::error('Facture non trouvée.');
                return back()->with('error', 'Facture non trouvée.');
            }

            Log::channel('invoice')->info('Facture trouvée', [
                'invoice_id' => $invoice_id,
                'invoice_data' => $invoice->toArray(),
            ]);

            // Récupération des données de la demande de facture
            $data = $invoice->invoiceRequestDataDto;
            Log::channel('invoice')->info('Données de la demande de facture récupérées', [
                'invoice_id' => $invoice_id,
                'data' => $data,
            ]);

            // Récupération des données de réponse de la facture
            $createInvoice = $invoice->invoiceResponseDataDto;
            Log::channel('invoice')->info('Données de réponse de la facture récupérées', [
                'invoice_id' => $invoice_id,
                'create_invoice' => $createInvoice,
            ]);

            // Récupération des éléments de sécurité de la facture
            $securityElementsDto = $invoice->securityElementsDto;
            Log::channel('invoice')->info('Éléments de sécurité de la facture récupérés', [
                'invoice_id' => $invoice_id,
                'security_elements_dto' => $securityElementsDto,
            ]);

            // Retourne la vue avec les données nécessaires
            return view('livewire.direction.normalize-invoices.create', compact('createInvoice', 'data', 'invoice_id', 'invoice', 'securityElementsDto'));
        } catch (\Exception $e) {
            // Journaliser l'erreur finalisation
            Log::channel('invoice')->error('Erreur lors de l\'affichage de la facture finale', [
                'message' => $e->getMessage(),
                'user_id' => $currentUser->id,
                'username' => $currentUser->name,
                'date_time' => $currentDateTime,
                'invoice_id' => $invoice_id,
            ]);

            // Flasher un message d'erreur à l'utilisateur
            Flashy::error('Une erreur s\'est produite lors de l\'affichage de la facture finale. Veuillez réessayer plus tard.');
            return back()->with('error', 'Une erreur s\'est produite lors de l\'affichage de la facture finale. Veuillez réessayer plus tard.');
        }
    }
}
