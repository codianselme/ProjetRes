<?php

namespace App\Http\Livewire\Dashboard\Preparations;

use Livewire\Component;
use App\Models\Order;
use App\Models\Preparation;

class Preparations extends Component
{

    public $order_id;
    public $quantity_used;
    public $ingredients;

    protected $rules = [
        'order_id' => 'required|exists:orders,id',
        'quantity_used' => 'required|integer|min:1',
        'ingredients' => 'required|string',
    ];

    public function prepareOrder()
    {
        $this->validate();

        Preparation::create([
            'order_id' => $this->order_id,
            'quantity_used' => $this->quantity_used,
            'ingredients' => $this->ingredients,
            'is_completed' => true,
        ]);

        // Mettre à jour le statut de la commande
        $order = Order::find($this->order_id);
        $order->status = 'completed';
        $order->save();

        session()->flash('message', 'Commande préparée avec succès.');
        $this->reset();
    }


    public function render()
    {
        $orders = Order::where('status', 'pending')->get();
        return view('livewire.dashboard.preparations.preparations', [
            'orders' => $orders
        ])->extends('layouts.base')->section('content');
    }
}
