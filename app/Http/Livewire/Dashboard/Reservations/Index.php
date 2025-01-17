<?php

namespace App\Http\Livewire\Dashboard\Reservations;

use App\Models\Reservation;
use Livewire\Component;
use Livewire\WithPagination;
use App\Mail\ReservationStatusChanged;
use Illuminate\Support\Facades\Mail;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $filterDate = '';
    public $filterStatus = '';
    public $selectedReservation = null;
    public $showModal = false;

    protected $queryString = ['search', 'filterDate', 'filterStatus'];

    public function showReservationDetails($id)
    {
        // dd($id);
        $this->selectedReservation = Reservation::find($id);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedReservation = null;
    }

    public function updateStatus($id, $status)
    {
        $reservation = Reservation::find($id);
        $reservation->status = $status;
        $reservation->save();

        // Envoyer l'email de notification
        if ($reservation->email) {
            Mail::to($reservation->email)->send(new ReservationStatusChanged($reservation));
        }

        $this->dispatchBrowserEvent('showToast', [
            'message' => 'Statut mis à jour avec succès!',
            'type' => 'success'
        ]);

        return redirect()->route('dashboard.reservations');
    }

    public function render()
    {
        $reservations = Reservation::query()
            ->when($this->search, function($query) {
                $query->where(function($q) {
                    $q->where('customer_name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%')
                      ->orWhere('phone', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->filterDate, function($query) {
                $query->whereDate('date', $this->filterDate);
            })
            ->when($this->filterStatus, function($query) {
                $query->where('status', $this->filterStatus);
            })
            ->orderBy('date', 'desc')
            ->paginate(10);

        return view('livewire.dashboard.reservations.index', [
            'reservations' => $reservations
        ])->extends('layouts.base')->section('content');
    }
}
