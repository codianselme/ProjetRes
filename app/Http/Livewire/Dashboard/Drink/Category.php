<?php

namespace App\Http\Livewire\Dashboard\Drink;

use Livewire\Component;
use App\Models\DrinkCategory;
use Livewire\WithPagination;
use RealRashid\SweetAlert\Facades\Alert;

class Category extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name;
    public $description;
    public $is_active = true;
    public $categoryId;
    public $searchTerm;
    public $isEditing = false;

    protected $rules = [
        'name' => 'required|min:3',
        'description' => 'required',
        'is_active' => 'boolean'
    ];

    protected $messages = [
        'name.required' => 'Le nom de la catégorie est obligatoire',
        'name.min' => 'Le nom doit contenir au moins 3 caractères',
        'description.required' => 'La description est obligatoire',
    ];

    protected $listeners = ['deleteConfirmed'];

    public function store()
    {
        $this->validate();

        try {
            DrinkCategory::create([
                'name' => $this->name,
                'description' => $this->description,
                'is_active' => $this->is_active
            ]);

            $this->resetInputFields();
            $this->dispatchBrowserEvent('close-modal');
            Alert::success('Succès', 'Catégorie créée avec succès !');
        } catch (\Exception $e) {
            Alert::error('Erreur', "Une erreur est survenue lors de la création de la catégorie.");
        }
    }

    public function edit($id)
    {
        try {
            $category = DrinkCategory::findOrFail($id);
            $this->categoryId = $category->id;
            $this->name = $category->name;
            $this->description = $category->description;
            $this->is_active = $category->is_active;
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
            $category = DrinkCategory::findOrFail($this->categoryId);
            $category->update([
                'name' => $this->name,
                'description' => $this->description,
                'is_active' => $this->is_active
            ]);

            $this->resetInputFields();
            $this->dispatchBrowserEvent('close-modal');
            Alert::success('Succès', 'Catégorie mise à jour avec succès !');
        } catch (\Exception $e) {
            Alert::error('Erreur', "Une erreur est survenue lors de la mise à jour de la catégorie.");
        }
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
            $category = DrinkCategory::findOrFail($id);
            $category->delete();
            Alert::success('Succès', 'Catégorie supprimée avec succès !');
        } catch (\Exception $e) {
            Alert::error('Erreur', "Une erreur est survenue lors de la suppression de la catégorie.");
        }
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->description = '';
        $this->is_active = true;
        $this->categoryId = null;
        $this->isEditing = false;
    }

    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';
        $categories = DrinkCategory::where('name', 'like', $searchTerm)
            ->orWhere('description', 'like', $searchTerm)
            ->paginate(10);

        return view('livewire.dashboard.drink.category', [
            'categories' => $categories
        ])->extends('layouts.base')->section('content');
    }
}
