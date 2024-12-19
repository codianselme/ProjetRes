<?php

namespace App\Http\Livewire\Dashboard\Preparations;

use Livewire\Component;
use App\Models\Order;
use App\Models\Preparation;
use App\Models\PreparationIngredient;
use App\Models\FoodSupply;

class Preparations extends Component
{
    public $order_id;
    public $quantity_used;
    public $selected_ingredient_id;
    public $ingredient_quantity;
    public $selected_unit;
    public $ingredients = [];

    protected $rules = [
        'order_id' => 'required|exists:orders,id',
        'quantity_used' => 'required|integer|min:1',
        // 'selected_ingredient_id' => 'required|exists:food_supplies,id',
        // 'ingredient_quantity' => 'required|integer|min:1',
        // 'selected_unit' => 'required|string',
    ];

    public function addIngredient()
    {
        $this->validateOnly('selected_ingredient_id');
        $this->validateOnly('ingredient_quantity');
        $this->validateOnly('selected_unit');

        $ingredient = FoodSupply::find($this->selected_ingredient_id);

        $this->ingredients[] = [
            'name' => $ingredient->food_name,
            'quantity' => $this->ingredient_quantity,
            'unit' => $this->selected_unit,
        ];

        // Reset ingredient fields
        $this->selected_ingredient_id = '';
        $this->ingredient_quantity = '';
        $this->selected_unit = '';
    }

    public function prepareOrder()
    {
        $this->validate();

        $preparation = Preparation::create([
            'order_id' => $this->order_id,
            'quantity_used' => $this->quantity_used,
            'ingredients' => json_encode($this->ingredients),
            'is_completed' => true,
        ]);

        // Enregistrer les ingrédients
        foreach ($this->ingredients as $ingredient) {
            PreparationIngredient::create([
                'preparation_id' => $preparation->id,
                'ingredient_name' => $ingredient['name'],
                'quantity' => $ingredient['quantity'],
                'unit' => $ingredient['unit'],
                'operateur' => auth()->user()->first_name . ' ' . auth()->user()->last_name
            ]);
        }

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
        $food_supplies = FoodSupply::all();
        $units = ['1/8l', '1/4l', '1/2l', 'l',  '1/8kg',  '1/4kg',  '1/2kg',  'kg',  '1', 'kg', 'g', 'ml', 'paquet', 'pièce', 'boite', 'casier', 'carton', 'un', 'aucun'];

        // Récupérer les préparations et leurs ingrédients
        $preparations = Preparation::with('ingredientsUtilises')->get();

        return view('livewire.dashboard.preparations.preparations', [
            'orders' => $orders,
            'food_supplies' => $food_supplies,
            'units' => $units,
            'preparations' => $preparations, // Passer les préparations à la vue
        ])->extends('layouts.base')->section('content');
    }
}
