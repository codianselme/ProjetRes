<?php

namespace App\Http\Livewire\Dashboard\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use RealRashid\SweetAlert\Facades\Alert;

class Roles extends Component
{
    public $name;
    public $roleId;
    public $searchTerm;

    protected $rules = [
        'name' => 'required|unique:roles,name',
    ];

    public function store()
    {
        $this->validate();

        try {
            Role::create(['name' => $this->name]);
            Alert::success('Succès', 'Rôle créé avec succès.');
            $this->resetInputFields();
        } catch (\Exception $e) {
            Alert::error('Erreur', "Une erreur est survenue lors de la création du rôle.");
        }

        return redirect()->route('dashboard.roles');
    }

    public function editRole($id)
    {
        try {
            $role = Role::findOrFail($id);
            $this->roleId = $role->id;
            $this->name = $role->name;
            $this->dispatchBrowserEvent('show-modal', ['modal' => 'modalEditRole']);
        } catch (\Exception $e) {
            Alert::error('Erreur', "Une erreur est survenue lors de la récupération des données.");
        }
    }

    public function updateRole()
    {
        $this->validate([
            'name' => 'required|unique:roles,name,' . $this->roleId,
        ]);

        try {
            $role = Role::findOrFail($this->roleId);
            $role->update(['name' => $this->name]);
            Alert::success('Succès', 'Rôle mis à jour avec succès.');
            $this->resetInputFields();
        } catch (\Exception $e) {
            Alert::error('Erreur', "Une erreur est survenue lors de la mise à jour du rôle.");
        }

        return redirect()->route('dashboard.roles');
    }

    public function confirmDelete($id)
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'title' => 'Êtes-vous sûr ?',
            'text' => 'Cette action est irréversible !',
            'id' => $id
        ]);
    }

    public function deleteRole($id)
    {
        try {
            $role = Role::findOrFail($id);

            // Vérifiez si l'utilisateur connecté a ce rôle
            if (auth()->user()->hasRole($role->name)) {
                Alert::warning('Attention', "Vous ne pouvez pas supprimer un rôle qui vous est assigné !");
                return;
            }

            $role->delete();
            Alert::success('Succès', 'Rôle supprimé avec succès.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Alert::error('Erreur', "Le rôle n'existe pas.");
        } catch (\Exception $e) {
            Alert::error('Erreur', "Une erreur est survenue lors de la suppression du rôle.");
        }

        return redirect()->route('dashboard.roles');
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->roleId = null;
    }

    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';
        $roles = Role::where('name', 'like', $searchTerm)->get();

        return view('livewire.dashboard.roles.roles', [
            'roles' => $roles,
        ])->extends('layouts.base')->section('content');
    }
}
