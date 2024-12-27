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

    // public function openCaisse()
    // {
    //     // Récupérer la dernière caisse en triant par date croissante
    //     $lastCaisse = Caisse::orderBy('date', 'asc')->latest()->first();

    //     if ($lastCaisse) {
    //         $lastCaisseDate = Carbon::parse($lastCaisse->date);
    //         $yesterday = Carbon::now()->subDay(1)->format('Y-m-d');

    //         // Vérifier si la date de la dernière caisse est différente de celle de la veille
    //         if ($lastCaisseDate->format('Y-m-d') !== $yesterday) {
    //             // Boucle pour chaque date entre la dernière caisse et aujourd'hui
    //             $currentDate = $lastCaisseDate->addDay(); // Commencer à partir du jour suivant

    //             while ($currentDate->lte(now())) {
    //                 $data_veille = Caisse::where('date', $currentDate->subDay()->format('Y-m-d'))->first();

    //                 // Créer une nouvelle caisse pour la date actuelle
    //                 $this->caisse = Caisse::create([
    //                     'date' => $currentDate->format('Y-m-d'),
    //                     'solde_especes_initial' => $data_veille ? $data_veille->solde_especes_final : 0,
    //                     'solde_momo_initial' => $data_veille ? $data_veille->solde_momo_final : 0,
    //                     'apport_espece' => 0,
    //                     'apport_momo' => 0,
    //                     'vente_espece' => 0,
    //                     'vente_momo' => 0,
    //                     'decaissement_espece' => 0,
    //                     'decaissement_momo' => 0,
    //                     'solde_especes_final' => 0,
    //                     'solde_momo_final' => 0,
    //                     'operateur' => Auth::user()->first_name . ' ' . Auth::user()->last_name,
    //                 ]);

    //                 $currentDate->addDay(); // Passer au jour suivant
    //             }
    //         } else {
    //             // Si la date de la dernière caisse est celle de la veille, créer une caisse pour aujourd'hui
    //             $this->caisse = Caisse::create([
    //                 'date' => now()->toDateString(),
    //                 'solde_especes_initial' => 0,
    //                 'solde_momo_initial' => 0,
    //                 'apport_espece' => 0,
    //                 'apport_momo' => 0,
    //                 'vente_espece' => 0,
    //                 'vente_momo' => 0,
    //                 'decaissement_espece' => 0,
    //                 'decaissement_momo' => 0,
    //                 'solde_especes_final' => 0,
    //                 'solde_momo_final' => 0,
    //                 'operateur' => Auth::user()->first_name . ' ' . Auth::user()->last_name,
    //             ]);
    //         }
    //     } else {
    //         // Si aucune caisse n'existe, créer une caisse pour aujourd'hui
    //         $this->caisse = Caisse::create([
    //             'date' => now()->toDateString(),
    //             'solde_especes_initial' => 0,
    //             'solde_momo_initial' => 0,
    //             'apport_espece' => 0,
    //             'apport_momo' => 0,
    //             'vente_espece' => 0,
    //             'vente_momo' => 0,
    //             'decaissement_espece' => 0,
    //             'decaissement_momo' => 0,
    //             'solde_especes_final' => 0,
    //             'solde_momo_final' => 0,
    //             'operateur' => Auth::user()->first_name . ' ' . Auth::user()->last_name,
    //         ]);
    //     }

    //     session()->flash('message', 'Caisse ouverte avec succès.');
    //     return redirect()->route('dashboard.caisse.gestion-caisse');
    // }


    public function openCaisse()
    {
        // Récupérer la dernière caisse
        $lastCaisse = Caisse::orderBy('date', 'desc')->first();

        // Si une caisse existe, analyser les dates
        if ($lastCaisse) {
            $lastCaisseDate = Carbon::parse($lastCaisse->date);
            $yesterday = Carbon::yesterday();

            // Compléter les jours manquants si nécessaire
            while ($lastCaisseDate->lt($yesterday)) {
                $lastCaisseDate = $lastCaisseDate->addDay(); // Avancer au jour suivant
                $this->createCaisseForDate($lastCaisseDate);
            }
        }

        // Créer une caisse pour aujourd'hui
        $this->createCaisseForDate(Carbon::today());

        // Message de confirmation
        session()->flash('message', 'Caisse ouverte avec succès.');
        return redirect()->route('dashboard.caisse.gestion-caisse');
    }

    /**
     * Crée une caisse pour une date donnée
     */
    private function createCaisseForDate(Carbon $date)
    {
        // Récupérer la caisse de la veille
        $data_veille = Caisse::where('date', $date->copy()->subDay()->format('Y-m-d'))->first();

        // Définir les soldes initiaux à partir des soldes finaux de la veille
        $soldeEspecesInitial = $data_veille->solde_especes_final ?? 0;
        $soldeMomoInitial = $data_veille->solde_momo_final ?? 0;

        // Créer la caisse pour la date spécifiée
        Caisse::create([
            'date' => $date->toDateString(),
            'solde_especes_initial' => $soldeEspecesInitial,
            'solde_momo_initial' => $soldeMomoInitial,
            'apport_espece' => 0,
            'apport_momo' => 0,
            'vente_espece' => 0,
            'vente_momo' => 0,
            'decaissement_espece' => 0,
            'decaissement_momo' => 0,
            'solde_especes_final' => $soldeEspecesInitial, 
            'solde_momo_final' => $soldeMomoInitial, 
            'operateur' => Auth::user()->first_name . ' ' . Auth::user()->last_name,
        ]);
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
