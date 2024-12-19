<?php

namespace App\Services;

use App\Models\Invoice;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use MercurySeries\Flashy\Flashy;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceErrorMail;


class InvoiceService
{
    public function __construct()
    {
        $request=request();
    }

    public function createCreditNoteData(int $invoiceId): array
    {

        // Log the start of the function
        Log::channel('invoice')->info('Starting createCreditNoteData function', ['invoice_id' => $invoiceId]);

        // Retrieve the invoice by its ID
        $invoice = Invoice::find($invoiceId);

        if (!$invoice) {
            Log::channel('invoice')->error('Invoice not found', ['invoice_id' => $invoiceId]);
            throw new Exception('Invoice not found');
        }

        // Log the successful retrieval of the invoice
        Log::channel('invoice')->info('Invoice retrieved successfully', ['invoice' => $invoice]);

        // Get the invoice request data
        $invoiceRequestData = $invoice->invoiceRequestDataDto;

        if (empty($invoiceRequestData)) {
            Log::channel('invoice')->error('Invoice request data not found', ['invoice_id' => $invoiceId]);
            throw new Exception('Invoice request data not found');
        }

        // Log the invoice request data retrieval
        Log::channel('invoice')->info('Invoice request data retrieved successfully', ['invoice_request_data' => $invoiceRequestData]);

        // Modify the type to 'FA' for the credit note
        $originalType = $invoiceRequestData['type'];
        $invoiceRequestData['type'] = 'FA';

        // Log the type change
        Log::channel('invoice')->info('Invoice type changed', ['original_type' => $originalType, 'new_type' => 'FA']);

        // Add the reference to each item
        $invoiceRequestData['reference'] = $invoice->securityElementsDto['codeMECeFDGI'] ?? null;

        // Log the item reference update
        Log::channel('invoice')->info('Item reference updated', [
            'invoiceRequestData' => $invoiceRequestData,
            'codeMECeFDGI' => $invoice->securityElementsDto['codeMECeFDGI'] ?? null,
        ]);

        // Log the successful completion of the function
        Log::channel('invoice')->info('createCreditNoteData function completed successfully', ['invoice_request_data' => $invoiceRequestData]);

        return $invoiceRequestData;
    }


    public function createInvoiceData($vente): array
    {
        Log::channel('invoice')->info('Début du processus de création de la facture', ['vente' => $vente]);

        $currentUser = Auth::user();
        $firstVente = $vente->first();
        $aibTaxType = match ($firstVente->aib_amount) {
            '1' => 'A',
            '5' => 'B',
            '0' => null,
            default => null,
        };

        $data = [
            'ifu' => env('SGMEF_IFU'),
            'type' => 'FV',
            'aib' => $aibTaxType,
            'items' => [],
            'client' => [
                'contact' => $firstVente->phone_client,
                'ifu' => $firstVente->client_ifu,
                'name' => $firstVente->client_fullname,
                'address' => $firstVente->client_address,
            ],
            'operator' => [
                'id' => $currentUser->id,
                'name' => $currentUser->getFullNameAttribute(),
            ],
            'payment' => [],
            'reference' => $firstVente->invoice_number,
        ];

        $amount = 0;
        $taxPercentage = $aibTaxType === 'A' ? 0 : 0.18;
        $aibPercentage = $aibTaxType === 'A' ? 0 : 0.05;
        // dd($data, $firstVente->aib_amount, $aibTaxType, $amount, $taxPercentage, $aibPercentage);
        //dd($vente, $vente->first()->items);

        foreach ($firstVente->items as $item) {

            // dd($firstVente, $item);

            $priceBeforeTax = $item->unit_price;
            $taxPercentage = $firstVente->aib_amount !== null && $firstVente->aib_amount !== 0
                ? (float)$firstVente->tax_value / 100
                : 0;
                $aibPercentage = $firstVente->aib_amount !== null && $firstVente->aib_amount !== 0
                ? (float)$firstVente->aib_amount / 100
                : 0;

            $priceAfterTax = $priceBeforeTax * (1 + $taxPercentage);
            $priceAfterAib = $priceAfterTax / (1 + $taxPercentage + $aibPercentage);
            $debugData = [
                "Valeur de taxe: " .$firstVente->tax_value,
                "Groupe de taxe: " .$firstVente->tax_group,
                "Pourcentage de taxe: " . $taxPercentage,
                "Prix avant taxe: " . $priceBeforeTax,
                "Pourcentage de taxe: " . ($taxPercentage * 100) . "%",
                "Prix après taxe: " . $priceAfterTax,
                "Pourcentage d'AIB: " . ($aibPercentage * 100) . "%",
                "Prix après AIB: " . $priceAfterAib
            ];
            if ($item->unit_price != null) {

                $data['items'][] = [
                    'code' => $item->itemable->name ?? $item->itemable->drink_name,
                    'name' => $item->itemable->name ?? $item->itemable->drink_name,
                    'price' => $priceAfterAib,
                    'quantity' => $item->quantity,
                    'taxGroup' => $firstVente->tax_group,
                    'originalPrice' => $item->unit_price, // A modifier
                    'priceModification' => "Remise ". $item->taux_reduction ?? 0 . "%",
                ];

            } else {

                $data['items'][] = [
                    'code' => $item->itemable->name ?? $item->itemable->drink_name,
                    'name' => $item->itemable->name ?? $item->itemable->drink_name,
                    'price' => $priceAfterAib,
                    'quantity' => $item->quantity,
                    'taxGroup' => $firstVente->tax_group,
                    // 'originalPrice' => $price,
                    // 'priceModification' => null,
                ];

            }


            $amount += $priceAfterAib * $item->quantity;

            $context = [
                'vente' => $item,
                // 'user_id' => (Request::user() ? Request::user()->id : 'Guest'),
                // 'user_name' => (Request::user() ? Request::user()->name : 'Guest'),
                // 'user_agent' => $Request::header('User-Agent'),
                // 'ip_address' => $Request::ip(),
                'data' => $data,
            ];

            Log::channel('invoice')->info('Data construct for {vente}', $context);

        }

        $data['payment'][] = [
            'name' => $firstVente->payment_method,
            'amount' => $amount,
        ];

        Log::channel('invoice')->info('Final invoice data prepared', ['data' => $data, 'total_amount' => $amount, 'debugData' => $debugData]);

        return $data;
    }


    public function invoiceRequestDataDto(array $data, int $id, int $user_id, ?string $origineReference = null)
    {
        DB::beginTransaction();
        

        $venteInfo = DB::table('sales')
                        ->where('id', $id)
                        ->select('name_banque_of_checque', 'reference_of_cheque', 'identify_of_mobile_trasaction', 'commentaire')
                        ->first();

        // dd($data, $id, $user_id, $origineReference, is_null($venteInfo));

        if (is_null($venteInfo)) {
            $message = 'Aucune information trouvée dans la table ' . 'sales' . ' pour les identifiants ' . $id;
            Log::channel('invoice')->error($message);
            Flashy::error($message);
            return back();
        }

        try {

            // dd($data, $origineReference, $venteInfo, $venteInfo->identify_of_mobile_trasaction);

            $invoice = Invoice::updateOrCreate(
                ['vente_id' => $id],
                [
                    'date' => Carbon::now()->format('Y-m-d'),
                    'invoiceRequestDataDto' => json_encode($data),
                    'typeInvoice' => $data['type'],
                    'invoice_number' => $origineReference ?? $data['reference'],
                    'commentaire' => $venteInfo->commentaire,
                    'identify_of_mobile_trasaction' => $venteInfo->identify_of_mobile_trasaction,
                    'reference_of_cheque' => $venteInfo->reference_of_cheque,
                    'name_banque_of_checque' => $venteInfo->name_banque_of_checque,
                    'user_id' => $user_id,
                ]
            );
            
            
            // $new_invoice = new Invoice();
            // $new_invoice->date = Carbon::now()->format('Y-m-d');
            // $new_invoice->invoiceRequestDataDto         = $data;
            // //$new_invoice->invoiceResponseDataDto        = ;
            // //$new_invoice->statusInvoice                 = ;
            // $new_invoice->typeInvoice                   = $data['type'];
            // //$new_invoice->securityElementsDto           = ;
            // $new_invoice->vente_id                      = $id;
            // $new_invoice->invoice_number                = $origineReference ?? $data['reference'];
            // $new_invoice->commentaire                   = $venteInfo->commentaire;
            // $new_invoice->identify_of_mobile_trasaction = $venteInfo->identify_of_mobile_trasaction;
            // $new_invoice->reference_of_cheque           = $venteInfo->reference_of_cheque;
            // $new_invoice->name_banque_of_checque        = $venteInfo->name_banque_of_checque;
            // $new_invoice->user_id                       = $user_id;
            // dd($new_invoice);
            // $new_invoice->save();

            



            // $new_invoice->typeInvoice = $data['type'];
            // $new_invoice->typeVendeur = $data['typeVendeur'];
            // $new_invoice->structure_id = $data['structure_id'] ?? Auth::user()->structure_id;
            // $new_invoice->invoice_number = $origineReference ?? $data['reference'];
            // $new_invoice->user_id = $user_id;
            // $new_invoice->date = Carbon::now()->format('Y-m-d');
            // $new_invoice->name_banque_of_checque = $venteInfo->name_banque_of_checque;
            // $new_invoice->reference_of_cheque = $venteInfo->reference_of_cheque;
            // $new_invoice->identify_of_mobile_trasaction = $venteInfo->identify_of_mobile_trasaction;
            // $new_invoice->commentaire = $venteInfo->commentaire;
            // dd($new_invoice);
            // $new_invoice->save();

            


            // $invoiceData = [
            //     'invoiceRequestDataDto' => $data,
            //     'typeInvoice' => $data['type'],
            //     //'typeVendeur' => $typeVendeur,
            //     //'structure_id' => $structure_id ?? Auth::user()->structure_id,
            //     'invoice_number' => $origineReference ?? $data['reference'],
            //     'user_id' => $user_id,
            //     'date' => Carbon::now()->format('Y-m-d'),
            //     'name_banque_of_checque' => $venteInfo->name_banque_of_checque,
            //     'reference_of_cheque' => $venteInfo->reference_of_cheque,
            //     'identify_of_mobile_trasaction' => $venteInfo->identify_of_mobile_trasaction,
            //     'commentaire' => $venteInfo->commentaire,
            // ];

            // $invoice = Invoice::updateOrCreate(
            //     [
            //         //$typeVendeur . '_ids' => json_encode($saleIds), 
            //         'typeInvoice' => $data['type'], 
            //         //'typeVendeur' => $typeVendeur
            //     ],
            //     $invoiceData
            // );

            // dd($invoice);

            DB::commit();

            Flashy::success('Données de facture créées/mises à jour avec succès');
            return $invoice;
        } catch (Exception $e) {
            DB::rollback();

            $errorMessage = 'Erreur lors de la création/mise à jour des données de la facture : ' . $e->getMessage();
            Log::channel('invoice')->error($errorMessage);
            Flashy::error('Une erreur s\'est produite lors de la création/mise à jour des données de la facture. Veuillez réessayer plus tard.');
            return back();
        }
    }

    public function invoiceResponseDataDto(array $createInvoice, int $id, $typeInvoice, ?string $invoice_number)
    {
        // dd($createInvoice, $id, $typeInvoice, $invoice_number);
        try {
            // Convertir les ids des ventes en JSON
            // $saleIdsJson = json_encode($id);

            // Log before retrieving the invoice
            Log::channel('invoice')->info('Retrieving invoice for updating response data', ['sale_id' => $id]);

            // dd($saleIds, $saleIdsJson, json_encode($saleIdsJson), $typeVendeur, $typeVendeur . '_ids', $saleIdsJson, Invoice::where($typeVendeur . '_ids', json_encode($saleIdsJson))->first());

            // Retrieve the invoice corresponding to the saleIds and typeVendeur
            $invoice = Invoice::where('typeInvoice', $typeInvoice)->where('invoice_number', $invoice_number)->first();
            // dd($invoice);
            //$invoice = Invoice::where($typeVendeur . '_ids', json_encode($saleIdsJson))->where('typeInvoice', $typeInvoice)->first();
            // dd($createInvoice, $saleIds, $typeVendeur, $typeInvoice, $invoice, $typeVendeur . '_ids', json_encode($saleIdsJson), $typeInvoice);
            if (!$invoice) {
                // Log if the invoice is not found
                Log::channel('invoice')->error('Invoice not found', ['sale_id' => $id]);
                throw new Exception('Invoice not found.');
            }

            // Log before updating the invoice response data
            Log::channel('invoice')->info('Updating invoice response data', [
                'invoice_id' => $invoice->id,
                'create_invoice' => $createInvoice,
            ]);
            $invoice->update([
                'invoiceResponseDataDto' => $createInvoice,
                'statusInvoice' => 'pending',
            ]);
            // Log after the invoice response data is updated
            Log::channel('invoice')->info('Invoice response data updated successfully', ['invoice' => $invoice]);

            return $invoice;
        } catch (Exception $e) {
            dd($e);
            // Log the error
            Log::channel('invoice')->error('Error updating invoice response data', [
                'error_message' => $e->getMessage(),
                'create_invoice' => $createInvoice,
                'sale_ids' => $saleIds,
            ]);

            Flashy::error('Une erreur s\'est produite lors de la mise à jour des données de réponse de la facture.');
            return back();
        }
    }



    private function logToJson(array $logData)
    {
        // Définir le chemin du fichier JSON
        $logFilePath = storage_path('logs/invoice_logs.json');

        // Vérifier si le fichier existe déjà
        if (file_exists($logFilePath)) {
            // Lire le contenu existant
            $existingContent = file_get_contents($logFilePath);
            $logEntries = json_decode($existingContent, true) ?: [];
        } else {
            // Créer un tableau vide si le fichier n'existe pas
            $logEntries = [];
        }

        // Ajouter les nouvelles données de journalisation
        $logEntries[] = $logData;

        // Écrire les données mises à jour dans le fichier
        file_put_contents($logFilePath, json_encode($logEntries, JSON_PRETTY_PRINT));
    }

    
    public function generateLogReport(string $operationId): string
    {
        $logFilePath = storage_path('logs/invoice.log');
    
        if (!file_exists($logFilePath)) {
            return "Log file does not exist.";
        }
    
        $reportHeader = "Rapport de Log pour l'Opération ID: $operationId\n";
        $reportHeader .= str_repeat("=", 80) . "\n";
    
        $reportContent = '';
        $handle = fopen($logFilePath, 'r');
    
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                if (strpos($line, $operationId) !== false) {
                    $reportContent .= $line;
                }
            }
            fclose($handle);
        }
    
        return $reportHeader . $reportContent;
    }
    


    public function securityElementsDto(array $invoiceResponseDataDto, int $invoiceId, string $statusInvoice)
    {
        $logData = [
            'invoice_id' => $invoiceId,
            'timestamp' => Carbon::now()->toDateTimeString(),
        ];

        try {
            $invoice = Invoice::find($invoiceId);

            if (!$invoice) {
                $this->handleError('Invoice not found', $logData);
                return back();
            }

            if ($this->hasError($invoiceResponseDataDto)) {
                $newInvoiceNumber = $invoice->invoice_number . '_errorDGI';
                $this->updateInvoice($invoice, $invoiceResponseDataDto, 'error', $newInvoiceNumber);

                $logData['errorCode'] = $invoiceResponseDataDto['errorCode'];
                $logData['errorDesc'] = $invoiceResponseDataDto['errorDesc'];
                $this->sendErrorEmail($logData, $newInvoiceNumber);

                Flashy::error('La facture a été mise à jour avec un suffixe d\'erreur. Veuillez vérifier les détails de l\'email envoyé.');
                return back();
            }

            // Normal case: update security elements
            $this->updateInvoice($invoice, $invoiceResponseDataDto, $statusInvoice);

            $logData['status'] = 'success';
            $this->logToJson($logData);

            Log::channel('invoice')->info('Security elements updated successfully', ['invoice' => $invoice]);
            return $invoice;
        } catch (Exception $e) {
            $this->handleError('Error updating security elements: ' . $e->getMessage(), $logData);
            return back();
        }
    }

    private function hasError(array $data): bool
    {
        return isset($data['errorCode']) && isset($data['errorDesc']);
    }

    private function updateInvoice(Invoice $invoice, array $data, string $status, ?string $newInvoiceNumber = null)
    {
        $updateData = [
            'securityElementsDto' => $data,
            'statusInvoice' => $status,
        ];

        if ($newInvoiceNumber) {
            $updateData['invoice_number'] = $newInvoiceNumber;
        }

        $invoice->update($updateData);
    }

    private function sendErrorEmail(array $logData, ?string $newInvoiceNumber)
    {
        Mail::to('codianselme@gmail.com')
            ->send(new InvoiceErrorMail([
                'errorCode' => $logData['errorCode'],
                'errorDesc' => $logData['errorDesc'],
                'invoice_number_before' => $newInvoiceNumber,
                'invoice_number_after' => $newInvoiceNumber,
                'user_id' => Auth::id(),
                'user_name' => Auth::user()->name,
                'timestamp' => Carbon::now()->toDateTimeString(),
                'log' => $this->generateLogReport($logData['invoice_id']),
            ]));
    }

    private function handleError(string $message, array &$logData)
    {
        $logData['error'] = $message;
        Log::channel('invoice')->error($message, ['invoice_id' => $logData['invoice_id']]);
        $this->logToJson($logData);

        Mail::to('codianselme@gmail.com')
            ->send(new InvoiceErrorMail($logData));

        Flashy::error('Une erreur s\'est produite : ' . $message);
    }


}