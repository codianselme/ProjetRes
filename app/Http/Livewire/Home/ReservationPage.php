<?php

namespace App\Http\Livewire\Home;

use Livewire\Component;

class ReservationPage extends Component
{
    public function render()
    {
        return view('livewire.home.reservation-page')->extends('layouts.home')->section('content');
    }
}
