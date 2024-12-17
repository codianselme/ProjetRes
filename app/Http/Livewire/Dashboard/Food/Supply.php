<?php

namespace App\Http\Livewire\Dashboard\Food;

use Livewire\Component;

class Supply extends Component
{
    public function render()
    {
        return view('livewire.dashboard.food.supply')->extends('layouts.base')->section('content');
    }
}
