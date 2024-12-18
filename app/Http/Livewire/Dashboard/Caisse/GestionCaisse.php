<?php

namespace App\Http\Livewire\Dashboard\Caisse;

use Carbon\Carbon;
use App\Models\Sale;
use App\Models\Caisse;
use App\Models\Depense;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class GestionCaisse extends Component
{
    public $apport_espece = 0;
    public $apport_momo = 0;
    public $caisse;
    public $salesSummary = [];
    public $expensesSummary = [];
    public $caisse_today;
    public $caisse_last_day;
    public $caisse_today_data;

    public function mount()
    {
        $this->caisse_today = Caisse::whereDate('date', now()->toDateString())->exists();

        // Récupérer les ventes et les dépenses du jour
        $this->salesSummary = Sale::whereBetween('created_at', [Carbon::now()->format('Y-m-d')." 00:00:00", Carbon::now()->format('Y-m-d')." 23:59:59"])
            ->select('payment_method', \DB::raw('SUM(total_amount) as total_sales'))
            ->groupBy('payment_method')
            ->get();

        // Récupérer les ventes et les dépenses du jour
        $this->expensesSummary = Depense::whereDate('created_at', now()->toDateString())
            ->select('nature', \DB::raw('SUM(montant) as total_expenses'))
            ->groupBy('nature')
            ->get();

        $this->caisse_today_data = Caisse::whereDate('date', now()->toDateString())->first();
        $this->caisse_last_day = Caisse::whereDate('date', Carbon::now()->subDay(1)->format('Y-m-d'))->first();
    }

    public function openCaisse()
    {
        $this->caisse = Caisse::create([
            'date' => now()->toDateString(),
            'solde_especes_initial' => 0,
            'solde_momo_initial' => 0,
            'apport_espece' => 0,
            'apport_momo' => 0,
            'vente_espece' => 0,
            'vente_momo' => 0,
            'decaissement_espece' => 0,
            'decaissement_momo' => 0,
            'solde_especes_final' => 0,
            'solde_momo_final' => 0,
            'operateur' => Auth::user()->first_name . ' ' . Auth::user()->last_name,
        ]);

        session()->flash('message', 'Caisse ouverte avec succès.');
        return redirect()->route('dashboard.caisse.gestion-caisse');
    }

    public function closeCaisse()
    {

        if($this->caisse_today_data){

            $caisse_today = Caisse::whereDate('date', now()->toDateString())->first();
            $caisse_last_day = Caisse::whereDate('date', Carbon::now()->subDay(1)->format('Y-m-d'))->first();

            // Récupérer les ventes et les dépenses du jour
            $salesSummary = Sale::whereBetween('created_at', [Carbon::now()->format('Y-m-d')." 00:00:00", Carbon::now()->format('Y-m-d')." 23:59:59"])
                ->select('payment_method', \DB::raw('SUM(total_amount) as total_sales'))
                ->groupBy('payment_method')
                ->get();

            $vente_espece = $salesSummary->where('payment_method', 'cash')->sum('total_sales');
            $vente_momo = $salesSummary->where('payment_method', 'mobile_money')->sum('total_sales');

            // Récupérer les ventes et les dépenses du jour
            $expensesSummary = Depense::whereDate('created_at', now()->toDateString())
                ->select('nature', \DB::raw('SUM(montant) as total_expenses'))
                ->groupBy('nature')
                ->get();

            $decaissement_espece = $expensesSummary->where('nature', 'cash')->sum('total_expenses');
            $decaissement_momo = $expensesSummary->where('nature', 'mobile_money')->sum('total_expenses');
            

            $caisse_today->solde_especes_initial = $this->caisse_last_day->solde_especes_final ?? 0;
            $caisse_today->solde_momo_initial = $this->caisse_last_day->solde_momo_final ?? 0;

            $caisse_today->apport_espece = $this->apport_espece ?? 0;
            $caisse_today->apport_momo = $this->apport_momo ?? 0;

            $caisse_today->vente_espece = $vente_espece;
            $caisse_today->vente_momo = $vente_momo;

            $caisse_today->decaissement_espece = $decaissement_espece;
            $caisse_today->decaissement_momo = $decaissement_momo;

            $caisse_today->solde_especes_final = $caisse_last_day == null ? 0 : (($caisse_last_day->solde_especes_final ?? 0) + ($this->apport_espece ?? 0) + ($vente_espece ?? 0) - ($decaissement_espece ?? 0));
            $caisse_today->solde_momo_final = $caisse_last_day == null ? 0 : (($caisse_last_day->solde_momo_final ?? 0) + ($this->apport_momo ?? 0) + ($vente_momo ?? 0) - ($decaissement_momo ?? 0));
            
            $caisse_today->operateur = Auth::user()->first_name . ' ' . Auth::user()->last_name;
            $caisse_today->status = 1;

            // dd($this->salesSummary, $this->expensesSummary, $caisse_today, $caisse_last_day, $caisse_today);
            $caisse_today->update();
        }

        session()->flash('message', 'Caisse clôturée avec succès.');
        return redirect()->route('dashboard.caisse.gestion-caisse');
    }

    public function render()
    {
        return view('livewire.dashboard.caisse.gestion-caisse')->extends('layouts.base')->section('content');
    }
}
