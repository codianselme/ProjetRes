<?php

namespace App\Http\Livewire\Dashboard\Commandes;

use App\Models\Command;
use Livewire\Component;
use Livewire\WithPagination;
use App\Mail\CommandStatusChanged;
use Illuminate\Support\Facades\Mail;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $filterDate = '';
    public $filterStatus = '';
    public $selectedCommand = null;
    public $showModal = false;

    protected $queryString = ['search', 'filterDate', 'filterStatus'];

    public function showCommandDetails($id)
    {
        $this->selectedCommand = Command::with('items')->find($id);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedCommand = null;
    }

    public function updateStatus($id, $status)
    {
        $command = Command::find($id);
        $command->status = $status;
        $command->save();

        if ($command->email) {
            Mail::to($command->email)->send(new CommandStatusChanged($command));
        }

        $this->dispatchBrowserEvent('showToast', [
            'message' => 'Statut mis à jour avec succès!',
            'type' => 'success'
        ]);
    }

    public function render()
    {
        $commands = Command::query()
            ->when($this->search, function($query) {
                $query->where(function($q) {
                    $q->where('customer_name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%')
                      ->orWhere('phone', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->filterDate, function($query) {
                $query->whereDate('created_at', $this->filterDate);
            })
            ->when($this->filterStatus, function($query) {
                $query->where('status', $this->filterStatus);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.dashboard.commandes.index', [
            'commands' => $commands
        ])->extends('layouts.base')->section('content');
    }
}
