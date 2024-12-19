<?php

namespace App\Http\Livewire\Home;

use Livewire\Component;

class ContactPage extends Component
{
    public function render()
    {
        return view('livewire.home.contact-page')->extends('layouts.home')->section('content');
    }
}
