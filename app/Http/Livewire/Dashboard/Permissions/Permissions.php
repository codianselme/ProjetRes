<?php

namespace App\Http\Livewire\Dashboard\Permissions;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use RealRashid\SweetAlert\Facades\Alert;

class Permissions extends Component
{
    public $name;
    public $permissionId;
    public $searchTerm;

    protected $rules = [
        'name' => 'required|unique:permissions,name',
    ];

    public function store()
    {
        $this->validate();

        try {
            Permission::create(['name' => $this->name]);
            Alert::success('Succès', 'Permission créée avec succès.');
            $this->resetInputFields();
        } catch (\Exception $e) {
            Alert::error('Erreur', "Une erreur est survenue lors de la création de la permission.");
        }

        return redirect()->route('dashboard.permissions');
    }

    public function editPermission($id)
    {
        try {
            $permission = Permission::findOrFail($id);
            $this->permissionId = $permission->id;
            $this->name = $permission->name;
            $this->dispatchBrowserEvent('show-modal', ['modal' => 'modalEditPermission']);
        } catch (\Exception $e) {
            Alert::error('Erreur', "Une erreur est survenue lors de la récupération des données.");
        }
    }

    public function updatePermission()
    {
        $this->validate([
            'name' => 'required|unique:permissions,name,' . $this->permissionId,
        ]);

        try {
            $permission = Permission::findOrFail($this->permissionId);
            $permission->update(['name' => $this->name]);
            Alert::success('Succès', 'Permission mise à jour avec succès.');
            $this->resetInputFields();
        } catch (\Exception $e) {
            Alert::error('Erreur', "Une erreur est survenue lors de la mise à jour de la permission.");
        }

        return redirect()->route('dashboard.permissions');
    }

    public function deletePermission($id)
    {
        try {
            $permission = Permission::findOrFail($id);
            $permission->delete();
            Alert::success('Succès', 'Permission supprimée avec succès.');
        } catch (\Exception $e) {
            Alert::error('Erreur', "Une erreur est survenue lors de la suppression de la permission.");
        }

        return redirect()->route('dashboard.permissions');
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->permissionId = null;
    }

    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';
        $permissions = Permission::where('name', 'like', $searchTerm)->get();

        return view('livewire.dashboard.permissions.permissions', [
            'permissions' => $permissions,
        ])->extends('layouts.base')->section('content');
    }
}
