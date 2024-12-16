<?php

namespace App\Http\Livewire\Dashboard\Roles;

use Livewire\Component;

class Roles extends Component
{
    public function render()
    {
        return view('livewire.dashboard.roles.roles')->extends('layouts.base')->section('content');
    }
}
