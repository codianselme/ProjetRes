<?php

namespace App\Http\Livewire\Dashboard\Commandes;

use App\Models\Command;
use Livewire\Component;
use Livewire\WithPagination;
use App\Mail\CommandStatusChanged;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $filterDate = '';
    public $filterStatus = '';
    public $filterDelivery = '';
    public $selectedCommand = null;
    public $showModal = false;

    protected $queryString = ['search', 'filterDate', 'filterStatus', 'filterDelivery'];

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
        // dd($id, $status);
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
        // Alert::success('Succès', 'Statut mis à jour avec succès !');
        // return redirect()->route('dashboard.commandes');
    }

    public function render()
    {
        $commands = Command::query()
            ->when($this->search, function($query) {
                $query->where(function($q) {
                    $q->where('customer_name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%')
                      ->orWhere('phone', 'like', '%' . $this->search . '%')
                      ->orWhere('delivery_address', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->filterDate, function($query) {
                $query->whereDate('created_at', $this->filterDate);
            })
            ->when($this->filterStatus, function($query) {
                $query->where('status', $this->filterStatus);
            })
            ->when($this->filterDelivery !== '', function($query) {
                $query->where('needs_delivery', $this->filterDelivery === 'delivery');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.dashboard.commandes.index', [
            'commands' => $commands,
            'totalAmount' => Command::sum('final_amount'),
            'deliveryCount' => Command::where('needs_delivery', true)->count(),
            'pickupCount' => Command::where('needs_delivery', false)->count(),
        ])->extends('layouts.base')->section('content');
    }

    public function getDeliveryStatusBadgeClass($command)
    {
        return $command->needs_delivery 
            ? 'badge bg-info' 
            : 'badge bg-secondary';
    }

    public function getDeliveryStatusText($command)
    {
        return $command->needs_delivery 
            ? 'Livraison à domicile' 
            : 'À emporter';
    }

    public function getFormattedAmount($command)
    {
        $amount = $command->final_amount;
        if ($command->needs_delivery) {
            return sprintf(
                '%s FCFA (dont %s FCFA de livraison)', 
                number_format($amount), 
                number_format($command->delivery_fee)
            );
        }
        return number_format($amount) . ' FCFA';
    }
}
