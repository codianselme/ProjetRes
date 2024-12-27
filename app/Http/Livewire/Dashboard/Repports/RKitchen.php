<?php

namespace App\Http\Livewire\Dashboard\Repports;

use Livewire\Component;
use App\Models\Preparation;
use Carbon\Carbon;

class RKitchen extends Component
{
    public $preparations;
    public $statusFilter = '';
    public $startDate;
    public $endDate;
    public $ingredientFilter = '';

    public $totalCommandes = 0;
    public $totalIngredients = 0;
    public $mostUsedIngredients = [];

    public function mount()
    {
        $this->startDate = Carbon::today()->format('Y-m-d');
        $this->endDate = Carbon::today()->format('Y-m-d');

        $this->loadPreparations();
    }

    public function loadPreparations()
    {
        $query = Preparation::with('ingredientsUtilises');

        if ($this->statusFilter) {
            $query->where('is_completed', $this->statusFilter === 'completed');
        }

        if ($this->startDate) {
            $query->whereDate('created_at', '>=', Carbon::parse($this->startDate));
        }

        if ($this->endDate) {
            $query->whereDate('created_at', '<=', Carbon::parse($this->endDate));
        }

        if ($this->ingredientFilter) {
            $query->whereHas('ingredientsUtilises', function($q) {
                $q->where('ingredient_name', 'like', '%' . $this->ingredientFilter . '%');
            });
        }

        $this->preparations = $query->get();

        $this->calculateTotals();
    }

    public function calculateTotals()
    {
        $this->totalCommandes = $this->preparations->count();
        $this->totalIngredients = $this->preparations->sum(function($preparation) {
            return $preparation->ingredientsUtilises->sum('quantity');
        });

        $ingredientCounts = [];
        foreach ($this->preparations as $preparation) {
            foreach ($preparation->ingredientsUtilises as $ingredient) {
                if (!isset($ingredientCounts[$ingredient->ingredient_name])) {
                    $ingredientCounts[$ingredient->ingredient_name] = 0;
                }
                $ingredientCounts[$ingredient->ingredient_name] += $ingredient->quantity;
            }
        }

        arsort($ingredientCounts);
        $this->mostUsedIngredients = array_slice($ingredientCounts, 0, 5);
    }

    public function updated($propertyName)
    {
        $this->loadPreparations();
    }

    public function render()
    {
        return view('livewire.dashboard.repports.r-kitchen', [
            'preparations' => $this->preparations,
            'mostUsedIngredients' => $this->mostUsedIngredients,
        ])->extends('layouts.base')->section('content');
    }
}
