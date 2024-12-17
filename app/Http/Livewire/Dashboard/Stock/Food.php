<?php

namespace App\Http\Livewire\Dashboard\Stock;

use App\Models\FoodSupply;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Food extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $searchTerm;
    public $filterCategory;

    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';

        $stocks = FoodSupply::select(
            'food_name',
            'unit',
            'category_id',
            DB::raw('SUM(quantity) as total_quantity'),
            DB::raw('AVG(unit_price) as average_price'),
            DB::raw('MAX(supply_date) as last_supply_date')
        )
        ->with('category')
        ->when($this->filterCategory, function($query) {
            return $query->where('category_id', $this->filterCategory);
        })
        ->where(function($query) use ($searchTerm) {
            $query->where('food_name', 'like', $searchTerm)
                ->orWhereHas('category', function($q) use ($searchTerm) {
                    $q->where('name', 'like', $searchTerm);
                });
        })
        ->groupBy('food_name', 'unit', 'category_id')
        ->orderBy('food_name')
        ->paginate(10);

        $categories = \App\Models\FoodCategory::where('is_active', true)->get();

        return view('livewire.dashboard.stock.food', [
            'stocks' => $stocks,
            'categories' => $categories
        ])->extends('layouts.base')->section('content');
    }
}
