<?php

namespace App\Http\Livewire\Dashboard\Orders;

use App\Models\Dish;
use App\Models\Order;
use Livewire\Component;

class Orders extends Component
{
    public $orders = [];
    public $client_number;

    public function mount()
    {
        // Générer le numéro de client au format : DATE-NUMÉRO (exemple: 20240318-001)
        $today = now()->format('Ymd');
        $lastOrder = Order::where('client_number', 'like', $today . '-%')
                         ->orderBy('client_number', 'desc')
                         ->first();

        if ($lastOrder) {
            $lastNumber = intval(substr($lastOrder->client_number, -3));
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '001';
        }

        $this->client_number = $today . '-' . $newNumber;
    }

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
                'client_number' => $this->client_number,
                'status' => 'pending'
            ]);
        }

        session()->flash('message', 'Commandes créées avec succès.');
        $this->reset('orders');
        
        // Générer un nouveau numéro de client
        $this->mount();
    }

    public function render()
    {
        $dishes = Dish::all();
        // $pendingOrders = Order::with('dish')->where('status', 'pending')->get();
        $pendingOrders = Order::with('dish')
            ->where('status', 'pending')
            ->orderBy('client_number')
            ->get()
            ->groupBy('client_number');

        return view('livewire.dashboard.orders.orders', [
            'dishes' => $dishes,
            'pendingOrders' => $pendingOrders,
        ])->extends('layouts.base')->section('content');
    }
}
