<?php

namespace App\Http\Livewire\Dashboard\Permissions;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;
use RealRashid\SweetAlert\Facades\Alert;


class Permissions extends Component
{
    use WithPagination;

    public $name;
    public $permissionId;
    public $searchTerm;
    public $isEditing = false;

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'name' => 'required|unique:permissions,name',
    ];

    protected $listeners = [
        'deleteConfirmed' => 'deletePermission',
    ];

    /**
     * Valide les propriétés mises à jour en temps réel.
     */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    /**
     * Stocke une nouvelle permission.
     */
    public function store()
    {
        $this->validate();

        try {
            Permission::create(['name' => $this->name]);
            Alert::success('Succès', 'Permission créée avec succès.');
            $this->resetInputFields();
            $this->dispatchBrowserEvent('close-modal');
        } catch (\Exception $e) {
            Alert::error('Erreur', "Une erreur est survenue lors de la création de la permission.");
        }
    }

    /**
     * Édite une permission existante.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        $this->permissionId = $permission->id;
        $this->name = $permission->name;
        $this->isEditing = true;

        $this->dispatchBrowserEvent('show-modal');
    }

    /**
     * Met à jour une permission existante.
     */
    public function update()
    {
        $this->validate([
            'name' => 'required|unique:permissions,name,' . $this->permissionId,
        ]);

        try {
            $permission = Permission::findOrFail($this->permissionId);
            $permission->update(['name' => $this->name]);
            Alert::success('Succès', 'Permission mise à jour avec succès.');
            $this->resetInputFields();
            $this->dispatchBrowserEvent('close-modal');
        } catch (\Exception $e) {
            Alert::error('Erreur', "Une erreur est survenue lors de la mise à jour de la permission.");
        }
    }

    /**
     * Déclenche la confirmation de suppression.
     *
     * @param  int  $id
     */
    public function delete($id)
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'title' => 'Êtes-vous sûr?',
            'text' => 'Cette action est irréversible!',
            'type' => 'warning',
            'id' => $id
        ]);
    }

    /**
     * Supprime la permission confirmée.
     *
     * @param  int  $id
     */
    public function deletePermission($id)
    {
        try {
            $permission = Permission::findOrFail($id);
            if($permission){
                $permission->delete();
            }
            Alert::success('Succès', 'Permission supprimée avec succès.');
        } catch (\Exception $e) {
            dd($e);
            Alert::error('Erreur', "Une erreur est survenue lors de la suppression de la permission.");
        }
    }

    /**
     * Réinitialise les champs du formulaire.
     */
    private function resetInputFields()
    {
        $this->name = '';
        $this->permissionId = null;
        $this->isEditing = false;
    }

    /**
     * Rendu du composant.
     */
    public function render()
    {
        $search = '%' . $this->searchTerm . '%';
        $permissions = Permission::where('name', 'like', $search)->paginate(10);

        return view('livewire.dashboard.permissions.permissions', [
            'permissions' => $permissions,
        ])->extends('layouts.base')->section('content');
    }
}
