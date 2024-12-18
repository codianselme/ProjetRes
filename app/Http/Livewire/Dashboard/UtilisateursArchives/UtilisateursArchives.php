<?php

namespace App\Http\Livewire\Dashboard\UtilisateursArchives;

use Livewire\Component;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

class UtilisateursArchives extends Component
{
    public $searchTerm;

    public function restoreUser($id)
    {

        try {
            $user = User::onlyTrashed()->findOrFail($id);
            $user->restore();
            Alert::success('Succès', "L'utilisateur a été restauré avec succès !");
        } catch (\Exception $e) {
            Alert::error('Erreur', "Une erreur est survenue lors de la restauration de l'utilisateur.");
        }
        return redirect()->route('dashboard.utilisateurs');
    }

    public function deleteUserPermanently($id)
    {

        try {
            $user = User::onlyTrashed()->findOrFail($id);
            $user->forceDelete();
            Alert::success('Succès', "L'utilisateur a été supprimé définitivement !");
        } catch (\Exception $e) {
            Alert::error('Erreur', "Une erreur est survenue lors de la suppression définitive de l'utilisateur.");
        }
        return redirect()->route('dashboard.utilisateurs');
    }

    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';

        $users = User::onlyTrashed()
            ->where(function ($query) use ($searchTerm) {
                $query->where('first_name', 'like', "%$searchTerm%")
                    ->orWhere('last_name', 'like', "%$searchTerm%")
                    ->orWhere('email', 'like', "%$searchTerm%");
            })->paginate(10);

        return view('livewire.dashboard.utilisateurs-archives.utilisateurs-archives', [
            'users' => $users,
        ])->extends('layouts.base')->section('content');
    }
}
