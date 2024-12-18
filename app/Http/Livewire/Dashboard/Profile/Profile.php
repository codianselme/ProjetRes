<?php

namespace App\Http\Livewire\Dashboard\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class Profile extends Component
{
    public $first_name;
    public $last_name;
    public $email;
    public $contact;
    public $poste;
    public $gender;
    public $address;
    public $current_password;
    public $new_password;
    public $confirm_password;

    public function mount()
    {
        $user = Auth::user();
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->email = $user->email;
        $this->contact = $user->contact;
        $this->poste = $user->poste;
        $this->gender = $user->gender;
        $this->address = $user->address;
    }

    public function updateProfile()
    {
        $this->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contact' => 'nullable|string|max:255',
            'poste' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:10',
            'address' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();
        $user->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'contact' => $this->contact,
            'poste' => $this->poste,
            'gender' => $this->gender,
            'address' => $this->address,
        ]);

        session()->flash('message', 'Informations mises à jour avec succès.');
    }

    public function changePassword()
    {
        $this->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        if (!Hash::check($this->current_password, Auth::user()->password)) {
            throw ValidationException::withMessages(['current_password' => 'Le mot de passe actuel est incorrect.']);
        }

        $user = Auth::user();
        $user->password = Hash::make($this->new_password);
        $user->save();

        session()->flash('message', 'Mot de passe changé avec succès.');
    }

    public function render()
    {
        return view('livewire.dashboard.profile.profile')->extends('layouts.base')->section('content');
    }
}
