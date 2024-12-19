<?php

namespace App\Http\Livewire\Dashboard\Orders;

use App\Models\Dish;
use Livewire\Component;

class Orders extends Component
{

    public $dish_id;
    public $quantity;

    protected $rules = [
        'dish_id' => 'required|exists:dishes,id',
        'quantity' => 'required|integer|min:1',
    ];

    public function createOrder()
    {
        $this->validate();

        Order::create([
            'user_id' => auth()->id(),
            'dish_id' => $this->dish_id,
            'quantity' => $this->quantity,
        ]);

        session()->flash('message', 'Commande créée avec succès.');
        $this->reset();
    }

    public function render()
    {
        $dishes = Dish::all();
        return view('livewire.dashboard.orders.orders', [
            'dishes' => $dishes
        ])->extends('layouts.base')->section('content');
    }
}
