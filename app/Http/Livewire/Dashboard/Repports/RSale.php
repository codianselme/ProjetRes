<?php

namespace App\Http\Livewire\Dashboard\Repports;

use Livewire\Component;
use App\Models\Sale;
use Livewire\WithPagination;
use Carbon\Carbon;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SalesExport;

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
        $query = Sale::with('items.itemable')
            ->whereBetween('date', [$this->startDate." 00:00:00", $this->endDate." 23:59:59"]);

        if ($this->searchTerm) {
            $searchTerm = '%' . $this->searchTerm . '%';
            $query->where('invoice_number', 'like', $searchTerm);
        }

        return $query->orderBy('date', 'desc')->paginate(10);
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

    public function exportPDF()
    {
        $sales = $this->getSalesData()->items();
        $pdf = PDF::loadView('exports.sales', ['sales' => $sales]);
        return $pdf->download('rapport_ventes.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new SalesExport($this->startDate, $this->endDate, $this->searchTerm), 'rapport_ventes.xlsx');
    }

    public function exportTXT()
    {
        $sales = $this->getSalesData()->items();
        $filename = 'rapport_ventes.txt';
        $handle = fopen($filename, 'w');

        foreach ($sales as $sale) {
            $line = "Numéro de Facture: {$sale->invoice_number}, Date: {$sale->date->format('d/m/Y')}, Montant Total: {$sale->total_amount} FCFA, Montant Payé: {$sale->paid_amount} FCFA\n";
            fwrite($handle, $line);
        }

        fclose($handle);
        return response()->download($filename)->deleteFileAfterSend(true);
    }

    public function render()
    {
        $sales = $this->getSalesData();

        return view('livewire.dashboard.repports.r-sale', [
            'sales' => $sales,
        ])->extends('layouts.base')->section('content');
    }
}
