<?php

namespace App\Http\Livewire\Dashboard\Sales;

use App\Models\Dish;
use App\Models\Sale;
use App\Models\Caisse;
use Livewire\Component;
use App\Models\Parametre;
use App\Models\DrinkSupply;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use App\Services\InvoiceService;
use App\Services\SgmefApiService;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\InvoicesController;
use App\Models\DishCategory;
use App\Models\DrinkCategory;

class Sales extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $sale_id;
    public $invoice_number;
    public $items = [];
    public $searchTerm;
    public $payment_method;
    public $paid_amount = 0;
    public $notes;
    public $showInvoice = false;
    public $currentSale;

    // Nouveaux champs
    public $aib_amount;
    public $tax_group;
    public $phone_client;
    public $client_ifu;
    public $client_fullname;
    public $client_address;
    public $identify_of_mobile_transaction;
    public $reference_of_cheque;
    public $name_banque_of_cheque;

    protected $sgmefApiService;
    protected $invoiceService;
    protected $invoiceController;

    protected $rules = [
        'items' => 'required|array|min:1',
        'items.*.quantity' => 'required|numeric|min:1',
        'payment_method' => 'required', //'required|in:cash,card,mobile_money',
        'paid_amount' => 'required|numeric|min:0',
        'aib_amount' => 'required', //'nullable|numeric',
        // 'tax_group' => 'nullable|string',
        'phone_client' => 'nullable|string',
        //'client_ifu' => 'nullable|string',
        'client_fullname' => 'nullable|string',
        //'client_address' => 'nullable|string',
        //'identify_of_mobile_transaction' => 'nullable|string',
        //'reference_of_cheque' => 'nullable|string',
        //'name_banque_of_cheque' => 'nullable|string',
    ];

    protected $messages = [
        'items.required' => 'Vous devez ajouter au moins un article à la vente.',
        'items.array' => 'Les articles doivent être sous forme de tableau.',
        'items.*.quantity.required' => 'La quantité est requise pour chaque article.',
        'items.*.quantity.numeric' => 'La quantité doit être un nombre.',
        'items.*.quantity.min' => 'La quantité doit être au moins 1.',
        'payment_method.required' => 'Le mode de paiement est requis.',
        // 'payment_method.in' => 'Le mode de paiement sélectionné n\'est pas valide.',
        'paid_amount.required' => 'Le montant payé est requis.',
        'paid_amount.numeric' => 'Le montant payé doit être un nombre.',
        'paid_amount.min' => 'Le montant payé ne peut pas être négatif.',
        'aib_amount.numeric' => 'Le montant AIB doit être un nombre.',
        'phone_client.string' => 'Le numéro de téléphone doit être une chaîne de caractères.',
        'client_ifu.string' => 'L\'IFU du client doit être une chaîne de caractères.',
        'client_fullname.string' => 'Le nom complet du client doit être une chaîne de caractères.',
        'client_address.string' => 'L\'adresse du client doit être une chaîne de caractères.',
        'identify_of_mobile_transaction.string' => 'L\'identifiant de la transaction mobile doit être une chaîne de caractères.',
        'reference_of_cheque.string' => 'La référence du chèque doit être une chaîne de caractères.',
        'name_banque_of_cheque.string' => 'Le nom de la banque du chèque doit être une chaîne de caractères.',
    ];

    public function boot(SgmefApiService $sgmefApiService, InvoiceService $invoiceService)
    {
        $this->sgmefApiService = $sgmefApiService;
        $this->invoiceService = $invoiceService;
        $this->invoiceController = new InvoicesController();
    }

    public function mount()
    {
        $this->invoice_number = 'INV-' . date('Ymd') . '-' . date('His');
    }

    public function addItem($type, $id)
    {
        $item = $type === 'dish' ? Dish::find($id) : DrinkSupply::find($id);
        
        if (!$item) return;

        $this->items[] = [
            'id' => $id,
            'type' => $type,
            'name' => $type === 'dish' ? $item->name : $item->drink_name,
            'price' => $type === 'dish' ? $item->price : $item->unit_price,
            'quantity' => 1,
            'total' => $type === 'dish' ? $item->price : $item->unit_price,
        ];
    }


    public function removeItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);
    }

    public function updateQuantity($index, $quantity)
    {
        $this->items[$index]['quantity'] = $quantity;
        $this->items[$index]['total'] = $this->items[$index]['price'] * $quantity;
    }

    public function getTotal()
    {
        return collect($this->items)->sum('total');
    }

    public function saveSale()
    {
        // dd($this->items, $this->payment_method, $this->paid_amount, $this->aib_amount, $this->phone_client, $this->client_fullname);
        $this->validate();

        $caisse = Caisse::whereDate('date', now()->toDateString())->first();

        if (!$caisse) {
            Alert::error('Erreur', "Veuillez ouvrir d'abord la caisse avant de faire une vente.");
            return redirect()->route('dashboard.sales.sales');
        }

        try {
            $sale = Sale::create([
                'invoice_number' => $this->invoice_number,
                'total_amount' => $this->getTotal(),
                'paid_amount' => $this->paid_amount,
                'payment_method' => $this->payment_method,
                'notes' => $this->notes,
                'aib_amount' => $this->aib_amount,
                'tax_group' => 'B', //$this->tax_group,
                'phone_client' => $this->phone_client,
                'client_ifu' => $this->client_ifu,
                'client_fullname' => $this->client_fullname,
                'client_address' => $this->client_address,
                'identify_of_mobile_transaction' => $this->identify_of_mobile_transaction,
                'reference_of_cheque' => $this->reference_of_cheque,
                'name_banque_of_cheque' => $this->name_banque_of_cheque,
            ]);

            foreach ($this->items as $item) {
                $sale->items()->create([
                    'itemable_type' => $item['type'] === 'dish' ? Dish::class : DrinkSupply::class,
                    'itemable_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['price'],
                    'total_price' => $item['total'],
                ]);
            }

            $this->reset(['items', 'payment_method', 'paid_amount', 'notes']);
            $this->invoice_number = 'INV-' . date('Ymd') . '-' . date('His');

            $this->dispatchBrowserEvent('swal:success', [
                'title' => 'Succès!',
                'text' => 'Vente enregistrée avec succès!',
            ]);

            Alert::success('Succès', 'Vente enregistrée avec succès !');
        } catch (\Exception $e) {
            dd($e);
            $this->dispatchBrowserEvent('swal:error', [
                'title' => 'Erreur!',
                'text' => "Une erreur s'est produite lors de l'enregistrement : " . $e->getMessage(),
            ]);

            Alert::error('Erreur', "Une erreur s'est produite lors de l'enregistrement : " . $e->getMessage());
        }
        return redirect()->route('dashboard.sales.sales');
    }

    public function showInvoice($id)
    {
        $this->currentSale = Sale::with('items.itemable')->find($id);
        $this->showInvoice = true;
    }

    public function genererFacture($code_vente)
    {
        $id = Sale::where('invoice_number', $code_vente)->first()->id;
        //dd($id, Auth::user()->id);

        return redirect()->route('invoices.show', [
            'id' => $id,
            // 'typeVendeur' => 'vente_physiques',
            "user_id" => Auth::user()->id,
            // "structure_id" => Auth::user()->structure_id
        ]);

        // $this->dispatchBrowserEvent('openFactureInNewTab', ['url' => $url, 'code_vente' => $code_vente]);
    }

    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';
        
        $sales = Sale::when($this->searchTerm, function($query) use ($searchTerm) {
            $query->where('invoice_number', 'like', $searchTerm)
                  ->orWhere('total_amount', 'like', $searchTerm);
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        $parametres = Parametre::where('id', 1)->first();

        // Récupération des plats et des catégories
        $dishes = Dish::where('is_available', true)->get();
        $categories = DishCategory::with('dishes')->get(); // Assurez-vous que la relation est définie dans le modèle DishCategory

        // Récupération des boissons et des catégories
        $drinkCategories = DrinkCategory::with('drinks')->get(); // Récupération des catégories de boissons
        //dd($drinkCategories);

        $drinks = DrinkSupply::select('id', 'drink_name', 'unit_price')
            ->groupBy('id', 'drink_name', 'unit_price')
            ->having(DB::raw('SUM(quantity)'), '>', 0)
            ->get();

        return view('livewire.dashboard.sales.sales', [
            'sales' => $sales,
            'dishes' => $dishes,
            'drinks' => $drinks,
            'parametres' => $parametres,
            'categories' => $categories, // Passage des catégories de plats à la vue
            'drinkCategories' => $drinkCategories // Passage des catégories de boissons à la vue
        ])->extends('layouts.base')->section('content');
    }
}
