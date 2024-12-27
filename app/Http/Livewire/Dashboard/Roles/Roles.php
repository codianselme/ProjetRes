<?php

namespace App\Http\Livewire\Dashboard\Roles;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use RealRashid\SweetAlert\Facades\Alert;

class Roles extends Component
{
    use WithPagination;

    public $name;
    public $roleId;
    public $searchTerm;
    public $selectedPermissions = [];
    public $isEditing = false;

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'name' => 'required|unique:roles,name',
        'selectedPermissions' => 'required|array|min:1',
        'selectedPermissions.*' => 'exists:permissions,id',
    ];

    protected $listeners = [
        'deleteConfirmed' => 'deleteRole',
    ];

    /**
     * Valide les propriétés mises à jour en temps réel.
     */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    /**
     * Stocke un nouveau rôle et assigne les permissions sélectionnées.
     */
    public function store()
    {
        $this->validate();

        try {
            $role = Role::create([
                'name' => $this->name,
                'guard_name' => 'web',
            ]);

            // Récupérer les noms des permissions à partir des identifiants
            $permissionNames = Permission::whereIn('id', $this->selectedPermissions)->pluck('name');
            // dd($this->selectedPermissions, $permissionNames);

            // Synchroniser les permissions avec le rôle
            $role->syncPermissions($permissionNames);

            // Message de succès
            Alert::success('Succès', 'Rôle créé avec succès.');

            // Réinitialiser les champs et fermer le modal
            $this->resetInputFields();
            $this->dispatchBrowserEvent('close-modal');
        } catch (\Exception $e) {
            dd($e);
            // Gestion des erreurs
            Alert::error('Erreur', "Une erreur est survenue lors de la création du rôle.");
        }
        return redirect()->route('dashboard.roles');
    }

    /**
     * Édite un rôle existant et charge ses permissions associées.
     *
     * @param  int  $id
     */
    public function editRole($id)
    {
        try {
            $role = Role::findOrFail($id);
            $this->roleId = $role->id;
            $this->name = $role->name;
            $this->selectedPermissions = $role->permissions->pluck('id')->toArray();
            $this->isEditing = true;
            $this->dispatchBrowserEvent('show-modal', ['modal' => 'modalEditRole']);
        } catch (\Exception $e) {
            Alert::error('Erreur', "Une erreur est survenue lors de la récupération des données.");
        }
    }

    /**
     * Met à jour un rôle existant avec les nouvelles données et permissions.
     */
    public function updateRole()
    {
        $this->validate([
            'name' => 'required|unique:roles,name,' . $this->roleId,
            'selectedPermissions' => 'required|array|min:1',
            'selectedPermissions.*' => 'exists:permissions,id',
        ]);

        try {
            $role = Role::findOrFail($this->roleId);
            $role->update([
                'name' => $this->name,
            ]);

            $permissionNames = Permission::whereIn('id', $this->selectedPermissions)->pluck('name');
            // dd($this->selectedPermissions, $permissionNames);

            // Synchroniser les permissions avec le rôle
            $role->syncPermissions($permissionNames);

            // Message de succès
            Alert::success('Succès', 'Rôle mis à jour avec succès.');

            // Réinitialiser les champs et fermer le modal
            $this->resetInputFields();
            $this->dispatchBrowserEvent('close-modal');
        } catch (\Exception $e) {
            Alert::error('Erreur', "Une erreur est survenue lors de la mise à jour du rôle.");
        }
        return redirect()->route('dashboard.roles');
    }

    /**
     * Déclenche la confirmation de suppression.
     *
     * @param  int  $id
     */
    public function confirmDelete($id)
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'title' => 'Êtes-vous sûr ?',
            'text' => 'Cette action est irréversible !',
            'id' => $id
        ]);
    }

    /**
     * Supprime le rôle confirmé.
     *
     * @param  int  $id
     */
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

    /**
     * Réinitialise les champs du formulaire.
     */
    private function resetInputFields()
    {
        $this->name = '';
        $this->roleId = null;
        $this->selectedPermissions = [];
        $this->isEditing = false;
    }

    /**
     * Rendu du composant.
     */
    public function render()
    {
        $search = '%' . $this->searchTerm . '%';
        $roles = Role::where('name', 'like', $search)->paginate(10);
        $permissions = Permission::all();

        return view('livewire.dashboard.roles.roles', [
            'roles' => $roles,
            'permissions' => $permissions,
        ])->extends('layouts.base')->section('content');
    }
}
