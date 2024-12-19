<?php

namespace App\Http\Livewire\Dashboard\Orders;

use App\Models\Dish;
use App\Models\Order;
use Livewire\Component;

class Orders extends Component
{
    public $orders = [];

    protected $rules = [
        'orders.*.dish_id' => 'required|exists:dishes,id',
        'orders.*.quantity' => 'required|integer|min:1',
    ];

    public function addOrder()
    {
        $this->orders[] = ['dish_id' => null, 'quantity' => 1];
    }

    public function removeOrder($index)
    {
        unset($this->orders[$index]);
        $this->orders = array_values($this->orders);
    }

    public function createOrders()
    {
        $this->validate();

        foreach ($this->orders as $orderData) {
            Order::create([
                'user_id' => auth()->id(),
                'dish_id' => $orderData['dish_id'],
                'quantity' => $orderData['quantity'],
            ]);
        }

        session()->flash('message', 'Commandes créées avec succès.');
        $this->reset('orders');
    }

    public function render()
    {
        $dishes = Dish::all();
        $pendingOrders = Order::with('dish')->where('status', 'pending')->get();
        return view('livewire.dashboard.orders.orders', [
            'dishes' => $dishes,
            'pendingOrders' => $pendingOrders,
        ])->extends('layouts.base')->section('content');
    }
}
