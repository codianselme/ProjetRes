<?php

namespace App\Http\Livewire\Dashboard\Food;

use App\Models\FoodSupply;
use App\Models\FoodCategory;
use Livewire\Component;
use Livewire\WithPagination;
use RealRashid\SweetAlert\Facades\Alert;

class Supply extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $category_id;
    public $food_name;
    public $unit;
    public $supplier_name;
    public $quantity;
    public $unit_price;
    public $total_cost;
    public $supply_date;
    public $supplyId;
    public $searchTerm;
    public $isEditing = false;

    protected $listeners = ['deleteConfirmed'];

    protected $rules = [
        'category_id' => 'required|exists:food_categories,id',
        'food_name' => 'required|min:3',
        'unit' => 'required',
        'supplier_name' => 'required',
        'quantity' => 'required|numeric|min:1',
        'unit_price' => 'required|numeric|min:0',
        'supply_date' => 'required|date',
    ];

    protected $messages = [
        'category_id.required' => 'La catégorie est obligatoire',
        'food_name.required' => 'Le nom de l\'aliment est obligatoire',
        'unit.required' => 'L\'unité de mesure est obligatoire',
        'supplier_name.required' => 'Le nom du fournisseur est obligatoire',
        'quantity.required' => 'La quantité est obligatoire',
        'unit_price.required' => 'Le prix unitaire est obligatoire',
        'supply_date.required' => 'La date d\'approvisionnement est obligatoire',
    ];

    public function store()
    {
        $this->validate();

        try {
            $this->total_cost = $this->quantity * $this->unit_price;
            
            FoodSupply::create([
                'category_id' => $this->category_id,
                'food_name' => $this->food_name,
                'unit' => $this->unit,
                'supplier_name' => $this->supplier_name,
                'quantity' => $this->quantity,
                'unit_price' => $this->unit_price,
                'total_cost' => $this->total_cost,
                'supply_date' => $this->supply_date,
            ]);

            $this->resetInputFields();
            $this->dispatchBrowserEvent('close-modal');
            Alert::success('Succès', 'Approvisionnement ajouté avec succès !');
        } catch (\Exception $e) {
            Alert::error('Erreur', "Une erreur est survenue lors de l'ajout de l'approvisionnement.");
        }

        return redirect()->route('dashboard.food.supply');
    }

    public function edit($id)
    {
        try {
            $supply = FoodSupply::findOrFail($id);
            $this->supplyId = $supply->id;
            $this->category_id = $supply->category_id;
            $this->food_name = $supply->food_name;
            $this->unit = $supply->unit;
            $this->supplier_name = $supply->supplier_name;
            $this->quantity = $supply->quantity;
            $this->unit_price = $supply->unit_price;
            $this->supply_date = $supply->supply_date->format('Y-m-d');
            $this->isEditing = true;
            
            $this->dispatchBrowserEvent('show-modal');
        } catch (\Exception $e) {
            Alert::error('Erreur', "Une erreur est survenue lors de la récupération des données.");
        }
    }

    public function update()
    {
        $this->validate();

        try {
            $supply = FoodSupply::findOrFail($this->supplyId);
            $this->total_cost = $this->quantity * $this->unit_price;
            
            $supply->update([
                'category_id' => $this->category_id,
                'food_name' => $this->food_name,
                'unit' => $this->unit,
                'supplier_name' => $this->supplier_name,
                'quantity' => $this->quantity,
                'unit_price' => $this->unit_price,
                'total_cost' => $this->total_cost,
                'supply_date' => $this->supply_date,
            ]);

            $this->resetInputFields();
            $this->dispatchBrowserEvent('close-modal');
            Alert::success('Succès', 'Approvisionnement mis à jour avec succès !');
        } catch (\Exception $e) {
            Alert::error('Erreur', "Une erreur est survenue lors de la mise à jour de l'approvisionnement.");
        }

        return redirect()->route('dashboard.food.supply');
    }

    public function delete($id)
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'title' => 'Êtes-vous sûr?',
            'text' => 'Cette action est irréversible!',
            'id' => $id
        ]);
    }

    public function deleteConfirmed($id)
    {
        try {
            $supply = FoodSupply::findOrFail($id);
            $supply->delete();
            Alert::success('Succès', 'Approvisionnement supprimé avec succès !');
        } catch (\Exception $e) {
            Alert::error('Erreur', "Une erreur est survenue lors de la suppression de l'approvisionnement.");
        }
        return redirect()->route('dashboard.food.supply');
    }

    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';
        $supplies = FoodSupply::with('category')
            ->where(function($query) use ($searchTerm) {
                $query->where('food_name', 'like', $searchTerm)
                    ->orWhere('supplier_name', 'like', $searchTerm)
                    ->orWhereHas('category', function($q) use ($searchTerm) {
                        $q->where('name', 'like', $searchTerm);
                    });
            })
            ->orderBy('supply_date', 'desc')
            ->paginate(10);

        $categories = FoodCategory::where('is_active', true)->get();

        return view('livewire.dashboard.food.supply', [
            'supplies' => $supplies,
            'categories' => $categories,
        ])->extends('layouts.base')->section('content');
    }
}
