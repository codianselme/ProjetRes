<?php

namespace App\Http\Livewire\Home;

use Livewire\Component;
use App\Models\Reservation;
use RealRashid\SweetAlert\Facades\Alert;
use App\Mail\ReservationMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class ReservationPage extends Component
{
    public $persons;
    public $date;
    public $time;
    public $customer_name;
    public $phone;
    public $email;
    public $special_requests;

    protected $rules = [
        'persons' => 'required|integer|min:1',
        'date' => 'required|date',
        'time' => 'required|date_format:H:i',
        'customer_name' => 'required|min:3',
        'phone' => 'required', //|regex:/^[0-9]{8,}$/',
        // 'email' => 'nullable|email',
        'special_requests' => 'nullable|string|max:500'
    ];

    protected $messages = [
        'customer_name.required' => 'Le nom est requis.',
        'customer_name.min' => 'Le nom doit contenir au moins 3 caractères.',
        'phone.required' => 'Le numéro de téléphone est requis.',
        'phone.regex' => 'Le format du numéro de téléphone est invalide.',
        'email.email' => 'L\'adresse email est invalide.',
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

            // Enregistrement de la réservation
            $reservation = Reservation::create([
                'customer_name' => $this->customer_name,
                'phone' => $this->phone,
                'email' => $this->email,
                'persons' => $this->persons,
                'date' => $this->date,
                'time' => $this->time,
                'special_requests' => $this->special_requests,
                'status' => 'pending'
            ]);

            // Envoi du mail aux administrateurs
            $adminUsers = User::whereHas('roles', function ($query) {
                $query->whereIn('name', ['Super Admin', 'Admin', 'Gérante']);
            })->get();

            foreach ($adminUsers as $adminUser) {
                Mail::to($adminUser->email)->send(new ReservationMail($reservation, 'admin'));
            }

            // Envoi du mail de confirmation au client s'il a fourni un email
            if ($this->email) {
                Mail::to($this->email)->send(new ReservationMail($reservation, 'client'));
            }

            $this->reset();
            Alert::success('Succès', 'Votre réservation a été effectuée avec succès !');
            
        } catch (\Exception $e) {
            Alert::error('Erreur', "Une erreur est survenue lors de la réservation : " . $e->getMessage());
        }

        return redirect()->route('home.page');
    }

    public function render()
    {
        return view('livewire.home.reservation-page')->extends('layouts.home')->section('content');
    }
}
