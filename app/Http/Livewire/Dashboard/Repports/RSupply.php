<?php

namespace App\Http\Livewire\Dashboard\Repports;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\FoodSupply;
use App\Models\DrinkSupply;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class RSupply extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $startDate;
    public $endDate;
    public $supplyType = 'all';
    public $categoryId;
    public $searchTerm;
    public $selectedItem;
    public $showDetails = false;

    protected $queryString = ['startDate', 'endDate', 'supplyType', 'categoryId'];

    public function mount()
    {
        $this->startDate = $this->startDate ?? Carbon::today()->format('Y-m-d');
        $this->endDate = $this->endDate ?? Carbon::today()->format('Y-m-d');
    }

    public function showItemDetails($id, $type)
    {
        $this->selectedItem = $type === 'food' 
            ? FoodSupply::with('category')->find($id)
            : DrinkSupply::with('category')->find($id);
        $this->showDetails = true;
    }

    public function closeDetails()
    {
        $this->showDetails = false;
        $this->selectedItem = null;
    }

    public function getSupplyData()
    {
        $foodQuery = FoodSupply::query()
            ->whereBetween('supply_date', [$this->startDate, $this->endDate]);
        
        $drinkQuery = DrinkSupply::query()
            ->whereBetween('supply_date', [$this->startDate, $this->endDate]);

        if ($this->categoryId) {
            $foodQuery->where('category_id', $this->categoryId);
            $drinkQuery->where('category_id', $this->categoryId);
        }

        if ($this->searchTerm) {
            $searchTerm = '%' . $this->searchTerm . '%';
            $foodQuery->where('food_name', 'like', $searchTerm);
            $drinkQuery->where('drink_name', 'like', $searchTerm);
        }

        $groupByFormat = 'DATE(supply_date)';

        $foodData = $foodQuery->select(
            DB::raw("$groupByFormat as period"),
            DB::raw('SUM(total_cost) as total_cost'),
            DB::raw('COUNT(*) as total_supplies'),
            DB::raw("'food' as type")
        )->groupBy('period');

        $drinkData = $drinkQuery->select(
            DB::raw("$groupByFormat as period"),
            DB::raw('SUM(total_cost) as total_cost'),
            DB::raw('COUNT(*) as total_supplies'),
            DB::raw("'drink' as type")
        )->groupBy('period');

        if ($this->supplyType === 'food') {
            return $foodData->get();
        } elseif ($this->supplyType === 'drink') {
            return $drinkData->get();
        }

        return $foodData->union($drinkData)->orderBy('period')->get();
    }

    public function render()
    {
        $summaryData = $this->getSupplyData();
        
        $foodQuery = FoodSupply::with('category')
            ->whereBetween('supply_date', [$this->startDate, $this->endDate]);
            
        $drinkQuery = DrinkSupply::with('category')
            ->whereBetween('supply_date', [$this->startDate, $this->endDate]);

        if ($this->categoryId) {
            $foodQuery->where('category_id', $this->categoryId);
            $drinkQuery->where('category_id', $this->categoryId);
        }

        if ($this->searchTerm) {
            $searchTerm = '%' . $this->searchTerm . '%';
            $foodQuery->where('food_name', 'like', $searchTerm);
            $drinkQuery->where('drink_name', 'like', $searchTerm);
        }

        $detailedData = collect();
        if ($this->supplyType === 'all' || $this->supplyType === 'food') {
            $detailedData = $detailedData->concat($foodQuery->get()->map(function($item) {
                $item->type = 'food';
                return $item;
            }));
        }
        if ($this->supplyType === 'all' || $this->supplyType === 'drink') {
            $detailedData = $detailedData->concat($drinkQuery->get()->map(function($item) {
                $item->type = 'drink';
                return $item;
            }));
        }

        $detailedData = new \Illuminate\Pagination\LengthAwarePaginator(
            $detailedData->forPage($this->page, 10),
            $detailedData->count(),
            10,
            $this->page,
            ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath()]
        );

        return view('livewire.dashboard.repports.r-supply', [
            'summaryData' => $summaryData,
            'detailedData' => $detailedData,
            'totalCost' => $summaryData->sum('total_cost'),
            'totalSupplies' => $summaryData->sum('total_supplies'),
            'foodCategories' => \App\Models\FoodCategory::where('is_active', true)->get(),
            'drinkCategories' => \App\Models\DrinkCategory::where('is_active', true)->get(),
        ])->extends('layouts.base')->section('content');
    }
}
