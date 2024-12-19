<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;

class FactureComponent extends Component
{

    public $invoices;
    public function mount()
    {
        $user = Auth::user();

        if ($user->structure === null) {
            // Si l'utilisateur n'a pas de structure, afficher toutes les factures
            $this->invoices = Invoice::all();
        } else {
            // Sinon, afficher les factures de la structure de l'utilisateur
            $this->invoices = Invoice::where('structure_id', $user->structure->id)->get();
        }
    }


    public function render()
    {
        $user = Auth::user();
        $user_role = $user->getRoleNames()[0];
        // dd($user_role);

        $view = match ($user_role) {
            'Viewer CBU', 'Viewer Finance','Viewer EBU','Viewer Marketing','Validator1-EBU-MTN','Validator General','Validator-Faghal' => 'livewire.facture-component',
            'Chef Agence', 'Backup Chef Agence' => 'livewire.facture-component',
            'Commercial','Super Admin', 'Admin', 'Responsable Device', 'Assistant Device' => 'livewire.facture-component',
            default => null
        };

        if ($view) {
            return view($view, ['invoices' => $this->invoices])
                ->extends(match ($user_role) {
                    'Viewer', 'Validator',"Validator1-EBU-MTN","Validator General" => 'layouts.mtn.base',
                    'Chef Agence', 'Backup Chef Agence' => 'layouts.agence.base',
                    'Commercial','Super Admin', 'Admin', 'Responsable Device', 'Assistant Device' => 'layouts.direction.base',
                })
                ->section('content');
        }

        // return view('livewire.facture-component');
    }
}
