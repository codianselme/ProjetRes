<?php

namespace App\Http\Livewire\Dashboard\Stock;

use App\Models\DrinkStock;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Drink extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $searchTerm;
    public $filterCategory;

    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';

        $stocks = DrinkStock::select(
            'drink_name',
            'unit_price',
            DB::raw('SUM(quantity) as total_quantity'),
            DB::raw('AVG(unit_price) as average_price'),
            DB::raw('MAX(total_cost) as total_total_cost')
        )->where('drink_name', 'like', $searchTerm) 
        ->groupBy('drink_name', 'unit_price')
        ->orderBy('drink_name')
        ->paginate(10);
        

        return view('livewire.dashboard.stock.drink', [
            'stocks' => $stocks,
        ])->extends('layouts.base')->section('content');
    }
}
