<?php

namespace App\Http\Livewire\Dashboard\Utilisateurs;

use Livewire\Component;
use Livewire\WithPagination;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;
use App\Models\User;

class Utilisateurs extends Component
{
    public $searchTerm;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $first_name, $last_name, $name, $email, $contact, $poste, $gender, $address, $role;
    public $userId;
    

    protected $rules = [
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email|unique:users,email',
        'contact' => 'nullable',
        'poste' => 'nullable',
        'gender' => 'required',
        'address' => 'nullable',
        //'password' => 'required|min:6',
    ];

    protected $messages = [
        'first_name.required' => 'Le prénom est obligatoire',
        'last_name.required' => 'Le nom est obligatoire',
        'email.required' => 'L\'adresse email est obligatoire',
        'email.email' => 'Veuillez entrer une adresse email valide',
        'email.unique' => 'Cette adresse email est déjà utilisée',
        'gender.required' => 'Le genre est obligatoire',
    ];

    protected $validationAttributes = [
        'first_name' => 'prénom',
        'last_name' => 'nom',
        'email' => 'adresse email',
        'contact' => 'numéro de téléphone',
        'poste' => 'poste',
        'gender' => 'genre',
        'address' => 'adresse',
    ];

    private function resetInputFields()
    {
        $this->first_name = '';
        $this->last_name = '';
        $this->email = '';
        $this->contact = '';
        $this->poste = '';
        $this->gender = '';
        $this->address = '';
        $this->password = '';
        $this->user_id = null;
        $this->isEditing = false;
    }
    

    public function store()
    {

        $this->validate();

        try {

            // Créer un nouvel utilisateur
            $user = User::create([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'name' => $this->first_name . ' ' . $this->last_name,
                'email' => $this->email,
                'contact' => $this->contact,
                'poste' => $this->poste,
                'gender' => $this->gender,
                'address' => $this->address,
                'password'  => bcrypt($this->email), 
            ]);

            if ($user) {
                // Associer le profil à l'utilisateur
                $user->assignRole($this->role);
            }

            $this->resetInputFields();
            $this->dispatchBrowserEvent('close-modal');
            // session()->flash('message', 'Utilisateur créé avec succès.');
            Alert::success('Message', 'Utilisateur créé avec succès !');
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e);
            if ($e->getCode() == 23000) {
                Alert::error('Nouvel Utilisateur', "Cet email est déjà utilisé par un autre utilisateur !!");
                $this->addError('email', 'Cet email est déjà utilisé par un autre utilisateur.');
            } else {
                Alert::error("Erreur lors de la création de l\'utilisateur.");
                $this->addError('create', 'Erreur lors de la création de l\'utilisateur.');
            }
        }

        // Rediriger vers la page des utilisateurs actifs
        return redirect()->route('dashboard.utilisateurs');
    }


    public function editUser($id)
    {
        try {
            $user = User::findOrFail($id);
            $this->user_id = $id;
            $this->first_name = $user->first_name;
            $this->last_name = $user->last_name;
            $this->email = $user->email;
            $this->contact = $user->contact;
            $this->poste = $user->poste;
            $this->gender = $user->gender;
            $this->address = $user->address;
            $this->role = $user->getRoleNames()->first();
            
            $this->dispatchBrowserEvent('show-modal', ['modal' => 'modalEditUser']);
        } catch (\Exception $e) {
            Alert::error('Erreur', "Une erreur est survenue lors de la récupération des données de l'utilisateur.");
        }
    }

    public function updateUser()
    {
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->user_id,
            'contact' => 'nullable',
            'poste' => 'nullable',
            'gender' => 'required',
            'address' => 'nullable',
            'role' => 'required'
        ]);

        try {
            $user = User::findOrFail($this->user_id);
            $user->update([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'name' => $this->first_name . ' ' . $this->last_name,
                'email' => $this->email,
                'contact' => $this->contact,
                'poste' => $this->poste,
                'gender' => $this->gender,
                'address' => $this->address,
            ]);

            // Mise à jour du rôle
            $user->syncRoles([$this->role]);

            $this->resetInputFields();
            $this->dispatchBrowserEvent('close-modal');
            Alert::success('Succès', "L'utilisateur a été modifié avec succès !");
        } catch (\Exception $e) {
            Alert::error('Erreur', "Une erreur est survenue lors de la modification de l'utilisateur.");
        }

        // Rediriger vers la page des utilisateurs actifs
        return redirect()->route('dashboard.utilisateurs');
    }


    public function deleteUser($id)
    {
        try {
            $user = User::findOrFail($id);
            
            // Vérification supplémentaire si nécessaire
            if ($user->id === auth()->id()) {
                Alert::warning('Attention', "Vous ne pouvez pas supprimer votre propre compte !");
                return;
            }

            $user->delete();
            Alert::success('Succès', "L'utilisateur a été supprimé avec succès !");
        } catch (\Exception $e) {
            Alert::error('Erreur', "Une erreur est survenue lors de la suppression de l'utilisateur.");
        }

        // Rediriger vers la page des utilisateurs actifs
        return redirect()->route('dashboard.utilisateurs');
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





    // public function editUser($id)
    // {
    //     $user = User::findOrFail($id);
    //     $this->userId = $user->id;
    //     $this->first_name = $user->first_name;
    //     $this->last_name = $user->last_name;
    //     $this->email = $user->email;
    //     $this->contact = $user->contact;
    //     $this->poste = $user->poste;
    //     $this->gender = $user->gender;
    //     $this->address = $user->address;
    //     $this->role = $user->getRoleNames()->first();
    // }

    // public function updateUser()
    // {
    //     $this->validate([
    //         'first_name' => 'required|string|max:255',
    //         'last_name' => 'required|string|max:255',
    //         'email' => 'required|email|unique:users,email,' . $this->userId,
    //         'contact' => 'nullable|string|max:255',
    //         'poste' => 'nullable|string|max:255',
    //         'gender' => 'required|string',
    //         'address' => 'nullable|string',
    //         'role' => 'required|string',
    //     ]);

    //     $user = User::findOrFail($this->userId);
    //     $user->update([
    //         'first_name' => $this->first_name,
    //         'last_name' => $this->last_name,
    //         'email' => $this->email,
    //         'contact' => $this->contact,
    //         'poste' => $this->poste,
    //         'gender' => $this->gender,
    //         'address' => $this->address,
    //     ]);

    //     $user->syncRoles($this->role);

    //     Alert::success('Succès', 'Utilisateur mis à jour avec succès.');
    //     $this->resetInputFields();
    // }

    public function suspendUser($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->status = !$user->status;
            $user->save();

            $message = $user->status ? 'Utilisateur réactivé avec succès.' : 'Utilisateur suspendu avec succès.';
            Alert::success('Succès', $message);
        } catch (\Exception $e) {
            Alert::error('Erreur', "Une erreur est survenue lors de la suspension de l'utilisateur.");
        }

            // Rediriger vers la page des utilisateurs actifs
            return redirect()->route('dashboard.utilisateurs');
    }


    public function render()
    {
        // Récupérer la liste des rôles
        $roles = Role::all();
        $searchTerm = '%'.$this->searchTerm.'%';

        return view('livewire.dashboard.utilisateurs.utilisateurs', [
            'users' => User::where('first_name', 'like', '%' . $searchTerm .'%')
                          ->orWhere('last_name', 'like', '%' . $searchTerm . '%')
                          ->orWhere('email', 'like', '%' . $searchTerm . '%')
                          ->orWhere('contact', 'like', '%' . $searchTerm . '%')
                          ->paginate(10), 
            'roles' => $roles,
        ])->extends('layouts.base')->section('content');
    }
}
