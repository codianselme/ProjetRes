<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Sale;
use Carbon\Carbon;

class Index extends Component
{
    public $totalSales;
    public $totalAmount;
    public $monthlySalesData;
    public $salesByPaymentMethod;

    public function mount()
    {
        $this->totalSales = Sale::count();
        $this->totalAmount = Sale::sum('total_amount');
        $this->monthlySalesData = $this->getMonthlySalesData();
        $this->salesByPaymentMethod = $this->getSalesByPaymentMethod();
    }

    public function getMonthlySalesData()
    {
        return Sale::selectRaw('MONTH(created_at) as month, SUM(total_amount) as total')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total')
            ->toArray();
    }

    public function getSalesByPaymentMethod()
    {
        return Sale::selectRaw('payment_method, COUNT(*) as count')
            ->groupBy('payment_method')
            ->pluck('count', 'payment_method')
            ->toArray();
    }

    public function render()
    {
        return view('livewire.dashboard.index', [
            'totalSales' => $this->totalSales,
            'totalAmount' => $this->totalAmount,
            'monthlySalesData' => $this->monthlySalesData,
            'salesByPaymentMethod' => $this->salesByPaymentMethod,
        ])->extends('layouts.base')->section('content');
    }
}
