<?php

namespace App\Http\Livewire\Dashboard\Repports;

use Livewire\Component;
use App\Models\Sale;
use Livewire\WithPagination;
use Carbon\Carbon;

class RSale extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $startDate;
    public $endDate;
    public $searchTerm;
    public $supplyType = 'all';
    public $currentSale;
    public $showInvoice = false;

    protected $queryString = ['startDate', 'endDate', 'searchTerm', 'supplyType'];

    public function mount()
    {
        $this->startDate = Carbon::today()->format('Y-m-d');
        $this->endDate = Carbon::today()->format('Y-m-d');
    }

    public function getSalesData()
    {
        // dd($this->startDate, $this->endDate);
        $query = Sale::with('items.itemable')
            ->whereBetween('created_at', [$this->startDate." 00:00:00", $this->endDate." 23:59:59"]);

        if ($this->searchTerm) {
            $searchTerm = '%' . $this->searchTerm . '%';
            $query->where('invoice_number', 'like', $searchTerm);
        }

        return $query->orderBy('created_at', 'desc')->paginate(10);
    }

    public function showInvoice($id)
    {
        $this->currentSale = Sale::with('items.itemable')->find($id);
        $this->showInvoice = true;
    }

    public function closeInvoice()
    {
        $this->showInvoice = false;
        $this->currentSale = null;
    }

    public function render()
    {
        $sales = $this->getSalesData();

        return view('livewire.dashboard.repports.r-sale', [
            'sales' => $sales,
        ])->extends('layouts.base')->section('content');
    }
}
