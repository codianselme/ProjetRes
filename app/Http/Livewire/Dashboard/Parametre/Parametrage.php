<?php

namespace App\Http\Livewire\Dashboard\Parametre;

use Livewire\Component;
use App\Models\Parametre;

class Parametrage extends Component
{
    public $type;
    public $name;
    public $address;
    public $contact_phone_1;
    public $contact_phone_2;
    public $contact_phone_3;
    public $email;
    public $website;
    public $description;
    public $facebook;
    public $twitter;
    public $instagram;
    public $youtube;
    
    public $parametre;

    public function mount()
    {
        // Récupérer le premier paramètre existant https://les-saveurs-du-corridor.yes.bj/
        $this->parametre = Parametre::first();

        if ($this->parametre) {
            $this->type = $this->parametre->type;
            $this->name = $this->parametre->name;
            $this->address = $this->parametre->address;
            $this->contact_phone_1 = $this->parametre->contact_phone_1;
            $this->contact_phone_2 = $this->parametre->contact_phone_2;
            $this->contact_phone_3 = $this->parametre->contact_phone_3;
            $this->email = $this->parametre->email;
            $this->website = $this->parametre->website;
            $this->description = $this->parametre->description;
            $this->facebook = $this->parametre->facebook;
            $this->twitter = $this->parametre->twitter;
            $this->instagram = $this->parametre->instagram;
            $this->youtube = $this->parametre->youtube;
        }
    }

    public function updateParametre()
    {
        $data = $this->validate([
            'type' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'contact_phone_1' => 'required|string|max:20',
            'contact_phone_2' => 'nullable|string|max:20',
            'contact_phone_3' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
            'description' => 'nullable|string',
            'facebook' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'youtube' => 'nullable|string|max:255',
        ]);

        // dd($data);

        $this->parametre->update($data);

        session()->flash('message', 'Paramètres mis à jour avec succès.');
        return redirect()->route('dashboard.Parametre.Parametrage');
    }

    public function render()
    {
        return view('livewire.dashboard.parametre.parametrage')->extends('layouts.base')->section('content');
    }
}
