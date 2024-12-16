<?php

namespace App\Http\Livewire\Dashboard\Permissions;

use Livewire\Component;

class Permissions extends Component
{
    public function render()
    {
        return view('livewire.dashboard.permissions.permissions')->extends('layouts.base')->section('content');
    }
}
