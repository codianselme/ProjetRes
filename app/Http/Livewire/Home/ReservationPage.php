<?php

namespace App\Http\Livewire\Home;

use Livewire\Component;
use App\Models\Reservation;
use RealRashid\SweetAlert\Facades\Alert;

class ReservationPage extends Component
{
    public $persons;
    public $date;
    public $time;

    protected $rules = [
        'persons' => 'required|integer|min:1',
        'date' => 'required|date',
        'time' => 'required|date_format:H:i',
    ];

    protected $messages = [
        'persons.required' => 'Le nombre de personnes est requis.',
        'persons.integer' => 'Le nombre de personnes doit être un entier.',
        'persons.min' => 'Le nombre de personnes doit être au moins 1.',
        'date.required' => 'La date est requise.',
        'date.date' => 'La date doit être une date valide.',
        'time.required' => 'L\'heure est requise.',
        'time.date_format' => 'L\'heure doit être au format HH:MM.',
    ];

    public function submit()
    {
        try {
            $this->validate();

            // Enregistrement des données dans la base de données
            Reservation::create([
                'persons' => $this->persons,
                'date' => $this->date,
                'time' => $this->time,
            ]);

            // Réinitialiser le formulaire
            $this->reset();

            // Optionnel : ajouter un message de succès
            // session()->flash('success', 'Votre réservation a été effectuée avec succès !');
            Alert::success('Succès', 'Votre réservation a été effectuée avec succès !');
        } catch (\Exception $e) {
            dd($e);
            // Gérer l'erreur
            Alert::error('Erreur', "Une erreur est survenue lors de la réservation : " . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.home.reservation-page')->extends('layouts.home')->section('content');
    }
}
