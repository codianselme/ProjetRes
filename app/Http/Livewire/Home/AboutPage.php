<?php

namespace App\Http\Livewire\Home;

use Livewire\Component;

class AboutPage extends Component
{
    public function render()
    {
        return view('livewire.home.about-page')->extends('layouts.home')->section('content');
    }
}
