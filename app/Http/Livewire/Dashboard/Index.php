<?php

namespace App\Http\Livewire\Dashboard;

use Carbon\Carbon;
use App\Models\Dish;
use App\Models\Sale;
use App\Models\User;
use App\Models\Caisse;
use Livewire\Component;
use App\Models\DrinkSupply;
use App\Models\DishCategory;
use App\Models\DrinkCategory;

class Index extends Component 
{
    public $totalSales;
    public $totalAmount;
    public $monthlySalesData;
    public $salesByPaymentMethod;
    public $totalDishes;
    public $totalDrinks;
    public $totalFoodStock;
    public $totalDrinkStock;
    public $totalUsers;
    public $isCashRegisterOpen;
    public $dataCaisse;
    public $startDate;
    public $endDate;
    public $filterPeriod = 'week'; // valeurs possibles: 'all', 'today', 'week', 'month', 'custom'

    public function mount()
    {
        $this->startDate = now()->startOfWeek()->format('Y-m-d');
        $this->endDate = now()->endOfWeek()->format('Y-m-d');
        $this->updateStats();
        $this->totalDishes = Dish::count();
        $this->totalDrinks = DrinkSupply::count();
        $this->totalFoodStock = $this->getTotalFoodStock();
        $this->totalDrinkStock = $this->getTotalDrinkStock();
        $this->totalUsers = User::count();
        $this->isCashRegisterOpen = $this->checkCashRegisterStatus();
        $this->dataCaisse = $this->checkDataCaisse();
    }

    public function updatedFilterPeriod()
    {
        switch ($this->filterPeriod) {
            case 'today':
                $this->startDate = now()->format('Y-m-d');
                $this->endDate = now()->format('Y-m-d');
                break;
            case 'week':
                $this->startDate = now()->startOfWeek()->format('Y-m-d');
                $this->endDate = now()->endOfWeek()->format('Y-m-d');
                break;
            case 'month':
                $this->startDate = now()->startOfMonth()->format('Y-m-d');
                $this->endDate = now()->endOfMonth()->format('Y-m-d');
                break;
            case 'all':
                $this->startDate = null;
                $this->endDate = null;
                break;
        }
        $this->updateStats();
    }

    public function updatedStartDate()
    {
        $this->filterPeriod = 'custom';
        $this->updateStats();
    }

    public function updatedEndDate()
    {
        $this->filterPeriod = 'custom';
        $this->updateStats();
    }

    public function updateStats()
    {
        $query = Sale::query();
        
        if ($this->filterPeriod !== 'all') {
            $query->whereBetween('date', [$this->startDate, $this->endDate]);
        }

        $this->totalSales = $query->count();
        $this->totalAmount = $query->sum('total_amount');
        $this->monthlySalesData = $this->getMonthlySalesData();
        $this->salesByPaymentMethod = $this->getSalesByPaymentMethod();
    }

    public function checkCashRegisterStatus()
    {
        $today_caisse = Caisse::whereDate('date', now()->toDateString())->exists();
        return $today_caisse;
    }


    public function checkDataCaisse()
    {
        $today_caisse = Caisse::whereDate('date', Carbon::now()->format('Y-m-d'))->first();
        $dataCaisse = $today_caisse ?? Caisse::whereDate('date', Carbon::now()->subDay(1)->format('Y-m-d'))->first();
        return $dataCaisse;
    }

    public function getMonthlySalesData()
    {
        $query = Sale::selectRaw('MONTH(date) as month, SUM(total_amount) as total')
            ->whereYear('date', Carbon::now()->year);
            
        if ($this->filterPeriod !== 'all') {
            $query->whereBetween('date', [$this->startDate, $this->endDate]);
        }

        return $query->groupBy('month')
            ->orderBy('month')
            ->pluck('total')
            ->toArray();
    }

    public function getSalesByPaymentMethod()
    {
        $query = Sale::selectRaw('payment_method, COUNT(*) as count');
            
        if ($this->filterPeriod !== 'all') {
            $query->whereBetween('date', [$this->startDate, $this->endDate]);
        }

        return $query->groupBy('payment_method')
            ->pluck('count', 'payment_method')
            ->toArray();
    }

    public function getTotalFoodStock()
    {
        return \DB::table('food_supplies')->sum('quantity');
    }

    public function getTotalDrinkStock()
    {
        return \DB::table('drink_stocks')->sum('quantity');
    }

    public function render()
    {
        return view('livewire.dashboard.index', [
            'totalSales' => $this->totalSales,
            'totalAmount' => $this->totalAmount,
            'monthlySalesData' => $this->monthlySalesData,
            'salesByPaymentMethod' => $this->salesByPaymentMethod,
            'totalDishes' => $this->totalDishes,
            'totalDrinks' => $this->totalDrinks,
            'totalFoodStock' => $this->totalFoodStock,
            'totalDrinkStock' => $this->totalDrinkStock,
            'totalUsers' => $this->totalUsers,
            'isCashRegisterOpen' => $this->isCashRegisterOpen,
        ])->extends('layouts.base')->section('content');
    }
}
