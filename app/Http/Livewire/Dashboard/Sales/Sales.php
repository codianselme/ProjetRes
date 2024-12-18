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

class Sales extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $sale_id;
    public $invoice_number;
    public $items = [];
    public $searchTerm;
    public $payment_method = 'cash';
    public $paid_amount = 0;
    public $notes;
    public $showInvoice = false;
    public $currentSale;

    protected $sgmefApiService;
    protected $invoiceService;
    protected $invoiceController;

    protected $rules = [
        'items' => 'required|array|min:1',
        'items.*.quantity' => 'required|numeric|min:1',
        'payment_method' => 'required|in:cash,card,mobile_money',
        'paid_amount' => 'required|numeric|min:0',
    ];

    public function boot(SgmefApiService $sgmefApiService, InvoiceService $invoiceService)
    {
        $this->sgmefApiService = $sgmefApiService;
        $this->invoiceService = $invoiceService;
        $this->invoiceController = new InvoicesController();
    }

    public function mount()
    {
        $this->invoice_number = 'INV-' . date('Ymd') . '-' . Str::random(4);
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
        $caisse = Caisse::whereDate('date', now()->toDateString())->first();

        if(!$caisse){
            Alert::error('Erreur', "Veuillez ouvrir d'abord la caisse avant de faire une vente.");
            return redirect()->route('dashboard.sales.sales');
        }

        $this->validate();

        try {
            $sale = Sale::create([
                'invoice_number' => $this->invoice_number,
                'total_amount' => $this->getTotal(),
                'paid_amount' => $this->paid_amount,
                'payment_method' => $this->payment_method,
                'notes' => $this->notes,
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
            $this->invoice_number = 'INV-' . date('Ymd') . '-' . Str::random(4);
            
            $this->dispatchBrowserEvent('swal:success', [
                'title' => 'Succès!',
                'text' => 'Vente enregistrée avec succès!',
            ]);

            Alert::success('Succès', 'Vente enregistrée avec succès !');
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('swal:error', [
                'title' => 'Erreur!',
                'text' => "Une erreur s'est produite lors de l'enregistrement.",
            ]);

            Alert::error('Erreur', "Une erreur s'est produite lors de l'enregistrement.");
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

        $dishes = Dish::where('is_available', true)->get();
        $parametres = Parametre::where('id', 1)->first();

        $drinks = DrinkSupply::select('id', 'drink_name', 'unit_price')
            ->groupBy('id', 'drink_name', 'unit_price')
            ->having(DB::raw('SUM(quantity)'), '>', 0)
            ->get();

        return view('livewire.dashboard.sales.sales', [
            'sales' => $sales,
            'dishes' => $dishes,
            'drinks' => $drinks,
            'parametres' => $parametres
        ])->extends('layouts.base')->section('content');
    }
}
