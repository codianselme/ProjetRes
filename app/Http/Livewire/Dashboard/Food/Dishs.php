<?php

namespace App\Http\Livewire\Dashboard\Food;

use Livewire\Component;
use App\Models\Dish;
use Livewire\WithPagination;
use RealRashid\SweetAlert\Facades\Alert;

class Dishs extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name;
    public $description;
    public $price;
    public $is_available = true;
    public $dishId;
    public $searchTerm;
    public $isEditing = false;

    protected $listeners = ['deleteConfirmed'];

    protected $rules = [
        'name' => 'required|min:3',
        'description' => 'required',
        'price' => 'required|numeric|min:0',
        'is_available' => 'boolean'
    ];

    protected $messages = [
        'name.required' => 'Le nom du plat est obligatoire',
        'name.min' => 'Le nom doit contenir au moins 3 caractères',
        'description.required' => 'La description est obligatoire',
        'price.required' => 'Le prix est obligatoire',
        'price.numeric' => 'Le prix doit être un nombre',
        'price.min' => 'Le prix doit être positif'
    ];

    public function store()
    {
        $this->validate();

        try {
            Dish::create([
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'is_available' => $this->is_available
            ]);

            $this->resetInputFields();
            $this->dispatchBrowserEvent('close-modal');
            Alert::success('Succès', 'Plat ajouté avec succès !');
        } catch (\Exception $e) {
            Alert::error('Erreur', "Une erreur est survenue lors de l'ajout du plat.");
        }

        return redirect()->route('dashboard.food.dish');
    }

    public function edit($id)
    {
        try {
            $dish = Dish::findOrFail($id);
            $this->dishId = $dish->id;
            $this->name = $dish->name;
            $this->description = $dish->description;
            $this->price = $dish->price;
            $this->is_available = $dish->is_available;
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
            $dish = Dish::findOrFail($this->dishId);
            $dish->update([
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'is_available' => $this->is_available
            ]);

            $this->resetInputFields();
            $this->dispatchBrowserEvent('close-modal');
            Alert::success('Succès', 'Plat mis à jour avec succès !');
        } catch (\Exception $e) {
            Alert::error('Erreur', "Une erreur est survenue lors de la mise à jour du plat.");
        }
        return redirect()->route('dashboard.food.dish');
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
            $dish = Dish::findOrFail($id);
            $dish->delete();
            Alert::success('Succès', 'Plat supprimé avec succès !');
        } catch (\Exception $e) {
            Alert::error('Erreur', "Une erreur est survenue lors de la suppression du plat.");
        }
        return redirect()->route('dashboard.food.dish');
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->description = '';
        $this->price = '';
        $this->is_available = true;
        $this->dishId = null;
        $this->isEditing = false;
    }

    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';
        $dishes = Dish::where('name', 'like', $searchTerm)
            ->orWhere('description', 'like', $searchTerm)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.dashboard.food.dishs', [
            'dishes' => $dishes
        ])->extends('layouts.base')
            ->section('content');
    }
}
