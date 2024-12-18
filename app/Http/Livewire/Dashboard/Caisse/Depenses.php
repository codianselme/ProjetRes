<?php

namespace App\Http\Livewire\Dashboard\Caisse;

use App\Models\Depense;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class Depenses extends Component
{
    public $date;
    public $montant;
    public $nature;
    public $motif;
    public $operateur;
    public $searchTerm;

    protected $rules = [
        'date' => 'required|date',
        'montant' => 'required|numeric|min:1',
        'nature' => 'required|string|max:255',
        'motif' => 'required|string',
    ];

    protected $messages = [
        'date.required' => 'La date est obligatoire.',
        'date.date' => 'Veuillez entrer une date valide.',
        'montant.required' => 'Le montant est obligatoire.',
        'montant.numeric' => 'Le montant doit être un nombre.',
        'montant.min' => 'Le montant doit être supérieur à zéro.',
        'nature.required' => 'La nature de la dépense est obligatoire.',
        'nature.string' => 'La nature doit être une chaîne de caractères.',
        'nature.max' => 'La nature ne peut pas dépasser 255 caractères.',
        'motif.required' => 'Le motif est obligatoire.',
        'motif.string' => 'Le motif doit être une chaîne de caractères.',
    ];

    public function store()
    {

        $this->validate();

        try {
            Depense::create([
                'date' => $this->date,
                'montant' => $this->montant,
                'nature' => $this->nature,
                'motif' => $this->motif,
                'user_id' => Auth::user()->id, // Assurez-vous que l'utilisateur est authentifié
                'operateur' => Auth::user()->first_name . ' ' . Auth::user()->last_name,
            ]);

            $this->resetInputFields();
            Alert::success('Succès', 'Dépense enregistrée avec succès !');
        } catch (\Exception $e) {
            Alert::error('Erreur', "Une erreur est survenue lors de l'enregistrement de la dépense.");
        }

        return redirect()->route('dashboard.caisse.depenses');
    }

    private function resetInputFields()
    {
        $this->date = '';
        $this->montant = '';
        $this->nature = '';
        $this->motif = '';
        $this->operateur = '';
    }

    public function render()
    {
        $depenses = Depense::when($this->searchTerm, function($query) {
            $query->where('nature', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('motif', 'like', '%' . $this->searchTerm . '%');
        })->paginate(10);

        return view('livewire.dashboard.caisse.depenses', [
            'depenses' => $depenses,
        ])->extends('layouts.base')->section('content');
    }
}
