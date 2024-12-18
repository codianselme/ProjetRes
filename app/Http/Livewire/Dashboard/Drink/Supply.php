<?php

namespace App\Http\Livewire\Dashboard\Drink;

use App\Models\DrinkSupply;
use App\Models\DrinkCategory;
use Livewire\Component;
use Livewire\WithPagination;
use RealRashid\SweetAlert\Facades\Alert;

class Supply extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $category_id;
    public $drink_name;
    public $unit;
    public $supplier_name;
    public $quantity;
    public $unit_price;
    public $total_cost;
    public $supply_date;
    public $supplyId;
    public $searchTerm;
    public $isEditing = false;
    public $bottles_per_case;
    public $existingDrinks;
    public $new_drink_name;

    protected $listeners = ['deleteConfirmed'];

    protected $rules = [
        'category_id' => 'required|exists:drink_categories,id',
        'drink_name' => 'required|min:3',
        'unit' => 'required',
        'supplier_name' => 'required',
        'quantity' => 'required|numeric|min:1',
        'unit_price' => 'required|numeric|min:0',
        'supply_date' => 'required|date',
        'bottles_per_case' => 'nullable|in:12,16,24',
    ];

    protected $messages = [
        'category_id.required' => 'La catégorie est obligatoire',
        'drink_name.required' => 'Le nom de la boisson est obligatoire',
        'unit.required' => 'L\'unité de mesure est obligatoire',
        'supplier_name.required' => 'Le nom du fournisseur est obligatoire',
        'quantity.required' => 'La quantité est obligatoire',
        'unit_price.required' => 'Le prix unitaire est obligatoire',
        'supply_date.required' => 'La date d\'approvisionnement est obligatoire',
    ];

    public function store()
    {
        $this->validate();

        if ($this->drink_name === 'new') {
            $this->drink_name = $this->new_drink_name;
        }

        try {
            $this->total_cost = $this->quantity * $this->unit_price;

            if ($this->unit === 'casiers' && $this->bottles_per_case) {
                $this->quantity *= $this->bottles_per_case;
            }

            DrinkSupply::create([
                'category_id' => $this->category_id,
                'drink_name' => $this->drink_name,
                'unit' => $this->unit,
                'supplier_name' => $this->supplier_name,
                'quantity' => $this->quantity,
                'unit_price' => $this->unit_price,
                'total_cost' => $this->total_cost,
                'supply_date' => $this->supply_date,
            ]);

            // Mettre à jour le stock
            // $drinkStock = DrinkStock::where('drink_name', $this->drink_name)->first();
            // if ($drinkStock) {
            //     $drinkStock->drink_name;
            //     $drinkStock->quantity = $drinkStock->quantity + $this->quantity;
            //     $drinkStock->unit_price = $this->unit_price;
            //     $drinkStock->total_cost = $this->total_cost;
            //     $drinkStock->save();
            // }else{
            //     DrinkStock::create([
            //         'drink_name' => $this->drink_name,
            //         'quantity' => $this->quantity,
            //         'unit_price' => $this->unit_price,
            //         'total_cost' => $this->total_cost
            //     ]);
            // }

            $this->resetInputFields();
            $this->dispatchBrowserEvent('close-modal');
            Alert::success('Succès', 'Approvisionnement ajouté avec succès !');
        } catch (\Exception $e) {
            Alert::error('Erreur', "Une erreur est survenue lors de l'ajout de l'approvisionnement.");
        }

        return redirect()->route('dashboard.drink.supply');
    }

    public function edit($id)
    {
        try {
            $supply = DrinkSupply::findOrFail($id);
            $this->supplyId = $supply->id;
            $this->category_id = $supply->category_id;
            $this->drink_name = $supply->drink_name;
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
            $supply = DrinkSupply::findOrFail($this->supplyId);
            $this->total_cost = $this->quantity * $this->unit_price;
            
            $supply->update([
                'category_id' => $this->category_id,
                'drink_name' => $this->drink_name,
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

        return redirect()->route('dashboard.drink.supply');
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
            $supply = DrinkSupply::findOrFail($id);
            $supply->delete();
            Alert::success('Succès', 'Approvisionnement supprimé avec succès !');
        } catch (\Exception $e) {
            Alert::error('Erreur', "Une erreur est survenue lors de la suppression de l'approvisionnement.");
        }

        return redirect()->route('dashboard.drink.supply');
    }

    private function resetInputFields()
    {
        $this->category_id = '';
        $this->drink_name = '';
        $this->unit = '';
        $this->supplier_name = '';
        $this->quantity = '';
        $this->unit_price = '';
        $this->total_cost = '';
        $this->supply_date = '';
        $this->supplyId = null;
        $this->isEditing = false;
        $this->bottles_per_case = null;
        $this->new_drink_name = '';
    }

    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';
        $supplies = DrinkSupply::with('category')
            ->where(function($query) use ($searchTerm) {
                $query->where('drink_name', 'like', $searchTerm)
                    ->orWhere('supplier_name', 'like', $searchTerm)
                    ->orWhereHas('category', function($q) use ($searchTerm) {
                        $q->where('name', 'like', $searchTerm);
                    });
            })->orderBy('supply_date', 'desc')
            ->paginate(10);

        $categories = DrinkCategory::where('is_active', true)->get();
        $this->existingDrinks = DrinkSupply::pluck('drink_name')->unique();

        return view('livewire.dashboard.drink.supply', [
            'supplies' => $supplies,
            'categories' => $categories,
            'existingDrinks' => $this->existingDrinks,
        ])->extends('layouts.base')->section('content');
    }
}
