<div>
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <h3 class="nk-block-title">Gestion de la Caisse</h3>

                    @if (session()->has('message'))
                        <div class="alert alert-success mt-4">
                            {{ session('message') }}
                        </div>
                    @endif

                    <!-- Récapitulatif de la veille -->
                    <div class="card card-bordered mt-4">
                        <div class="card-inner">
                            <h4 class="nk-block-title">Récapitulatif de la veille</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Date de la veille</th>
                                            <th>Solde final de la veille en Espèce</th>
                                            <th>Solde final de la veille en Mobile Money</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $caisse_last_day->date ?? "Non trouvé" }}</td>
                                            <td>{{ $caisse_last_day->solde_especes_final ?? 0 }}</td>
                                            <td>{{ $caisse_last_day->solde_momo_final ?? 0 }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Date du jour</th>
                                            <th>Solde final du jour</th>
                                            <th>Solde final du jour</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $caisse_last_day->date ?? "Non trouvé" }}</td>
                                            <td>{{ $caisse_last_day->solde_especes_final ?? 0 }}</td>
                                            <td>{{ $caisse_last_day->solde_momo_final ?? 0 }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Récapitulatif des ventes -->
                    <div class="card card-bordered mt-4">
                        <div class="card-inner">
                            <h4 class="nk-block-title">Récapitulatif des Ventes</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Méthode de Paiement</th>
                                            <th>Total des Ventes (FCFA)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($salesSummary as $sale)
                                            <tr>
                                                <td>{{ ucfirst($sale->payment_method) }}</td>
                                                <td>{{ number_format($sale->total_sales, 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Récapitulatif des dépenses -->
                    <div class="card card-bordered mt-4">
                        <div class="card-inner">
                            <h4 class="nk-block-title">Récapitulatif des Dépenses</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nature de la Dépense</th>
                                            <th>Total des Dépenses (FCFA)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($expensesSummary as $expense)
                                            <tr>
                                                <td>{{ ucfirst($expense->nature) }}</td>
                                                <td>{{ number_format($expense->total_expenses, 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <br>
                    <!-- Bouton pour ouvrir la caisse -->
                    <div class="text-right" style="text-align: right;">
                        <button class="btn btn-success mt-2" wire:click="openCaisse">Ouvrir la Caisse</button>
                    </div>

                    <!-- Afficher le formulaire pour clôturer la caisse -->
                    {{-- @if($caisse and $caisse_today) --}}
                    @if($caisse_today)
                        
                        <div class="card card-bordered mt-4">
                            <div class="card-inner">
                                <h4>Clôturer la Caisse</h4>
                                <div class="form-group">
                                    <label for="apport_espece">Apport Espèce</label>
                                    <input type="number" class="form-control" id="apport_espece" wire:model="apport_espece" min="0">
                                </div>

                                <div class="form-group">
                                    <label for="apport_momo">Apport Momo</label>
                                    <input type="number" class="form-control" id="apport_momo" wire:model="apport_momo" min="0">
                                </div>

                                @if($caisse_today_data->status)
                                    <button class="btn btn-primary" wire:click="closeCaisse">Clôturer la Caisse</button>
                                @endif
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
