<?php

namespace App\Http\Livewire\Dashboard\Contacts;

use App\Models\Contact;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedContact = null;
    public $showModal = false;
    public $filterDate = '';
    
    protected $queryString = ['search', 'filterDate'];

    public function showContactDetails($id)
    {
        $this->selectedContact = Contact::find($id);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedContact = null;
    }

    public function render()
    {
        $contacts = Contact::query()
            ->when($this->search, function($query) {
                $query->where(function($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%')
                      ->orWhere('phone', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->filterDate, function($query) {
                $query->whereDate('created_at', $this->filterDate);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.dashboard.contacts.index', [
            'contacts' => $contacts
        ])->extends('layouts.base')->section('content');
    }
}
