<?php

namespace App\Http\Livewire\Dashboard\UtilisateursArchives;

use Livewire\Component;

class UtilisateursArchives extends Component
{
    public function render()
    {
        return view('livewire.dashboard.utilisateurs-archives.utilisateurs-archives')->extends('layouts.base')->section('content');
    }
}
