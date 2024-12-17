<?php

namespace App\Http\Livewire\Dashboard\Drink;

use Livewire\Component;

class Supply extends Component
{
    public function render()
    {
        return view('livewire.dashboard.drink.supply')->extends('layouts.base')->section('content');
    }
}
