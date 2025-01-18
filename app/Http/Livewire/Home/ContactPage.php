<?php

namespace App\Http\Livewire\Home;

use App\Models\User;
use App\Models\Contact;
use Livewire\Component;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class ContactPage extends Component
{
    public $name;
    public $email;
    public $phone;
    public $website;
    public $message;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'nullable|string|max:15',
        //'website' => 'nullable|string|max:255',
        'message' => 'required|string',
    ];

    protected $messages = [
        'name.required' => 'Le nom est requis.',
        'name.string' => 'Le nom doit être une chaîne de caractères.',
        'name.max' => 'Le nom ne peut pas dépasser 255 caractères.',
        'email.required' => 'L\'adresse e-mail est requise.',
        'email.email' => 'L\'adresse e-mail doit être valide.',
        'phone.max' => 'Le numéro de téléphone ne peut pas dépasser 15 caractères.',
        'website.max' => 'Le site web ne peut pas dépasser 255 caractères.',
        'message.required' => 'Le message est requis.',
        'message.string' => 'Le message doit être une chaîne de caractères.',
    ];

    public function submit()
    {
        // dd($this->name, $this->email, $this->phone, $this->website, $this->message);
        try {
            $this->validate();

            // Enregistrement des données dans la base de données
            Contact::create([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                //'website' => $this->website,
                'message' => $this->message,
            ]);

            // Envoi du mail aux administrateurs
            $adminUsers = User::whereHas('roles', function ($query) {
                $query->whereIn('name', ['Super Admin', 'Admin', 'Gestionnaire', 'Gérante']);
            })->get();

            if (!$adminUsers->isEmpty()) {
                foreach ($adminUsers as $adminUser) {
                    Mail::to($adminUser->email)->send(new ContactFormMail($this, 'admin'));
                }
            }

            // Envoi du mail de confirmation à l'expéditeur
            if ($this->email) {
                Mail::to($this->email)->send(new ContactFormMail($this, 'client'));
            }

            // Réinitialiser le formulaire
            $this->reset();

            Alert::success('Succès', 'Votre message a été envoyé avec succès !');
        } catch (\Exception $e) {
            // dd($e);
            Alert::error('Erreur', "Une erreur est survenue lors de l'envoi du message.");
        }

        return redirect()->route('home.page');
    }

    public function render()
    {
        return view('livewire.home.contact-page')->extends('layouts.home')->section('content');
    }
}
