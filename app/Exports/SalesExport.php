<?php

namespace App\Exports;

use App\Models\Sale;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SalesExport implements FromCollection, WithHeadings
{
    protected $startDate;
    protected $endDate;
    protected $searchTerm;

    public function __construct($startDate, $endDate, $searchTerm)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->searchTerm = $searchTerm;
    }

    public function collection()
    {
        $query = Sale::with('items.itemable')
            ->whereBetween('created_at', [$this->startDate." 00:00:00", $this->endDate." 23:59:59"]);

        if ($this->searchTerm) {
            $searchTerm = '%' . $this->searchTerm . '%';
            $query->where('invoice_number', 'like', $searchTerm);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'Numéro de Facture',
            'Date',
            'Montant Total',
            'Montant Payé',
            'Méthode de Paiement',
        ];
    }
}
