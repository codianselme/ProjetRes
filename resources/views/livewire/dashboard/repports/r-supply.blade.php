<div>
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Rapport des Approvisionnements</h3>
                            </div>
                        </div>
                    </div>

                    <!-- Filtres -->
                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <div class="row g-3 align-center">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="form-label">Date de début</label>
                                            <input type="date" class="form-control" wire:model="startDate">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="form-label">Date de fin</label>
                                            <input type="date" class="form-control" wire:model="endDate">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="form-label">Type</label>
                                            <select class="form-select" wire:model="supplyType">
                                                <option value="all">Tous</option>
                                                <option value="food">Aliments</option>
                                                <option value="drink">Boissons</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="form-label">Rechercher</label>
                                            <input type="text" class="form-control" wire:model.debounce.300ms="searchTerm" placeholder="Rechercher...">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Résumé -->
                    <div class="nk-block">
                        <div class="row g-gs">
                            <div class="col-xxl-3 col-sm-6">
                                <div class="card">
                                    <div class="nk-ecwg nk-ecwg6">
                                        <div class="card-inner">
                                            <div class="card-title-group">
                                                <div class="card-title">
                                                    <h6 class="title">Total Approvisionnements</h6>
                                                </div>
                                            </div>
                                            <div class="data">
                                                <div class="data-group">
                                                    <div class="amount">{{ $totalSupplies }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-sm-6">
                                <div class="card">
                                    <div class="nk-ecwg nk-ecwg6">
                                        <div class="card-inner">
                                            <div class="card-title-group">
                                                <div class="card-title">
                                                    <h6 class="title">Coût Total</h6>
                                                </div>
                                            </div>
                                            <div class="data">
                                                <div class="data-group">
                                                    <div class="amount">{{ number_format($totalCost, 0) }} FCFA</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Détails -->
                    @if($detailedData->count() > 0)
                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Article</th>
                                            <th>Catégorie</th>
                                            <th>Quantité</th>
                                            <th>Prix Unitaire</th>
                                            <th>Coût Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($detailedData as $item)
                                        <tr>
                                            <td>{{ $item->supply_date->format('d/m/Y') }}</td>
                                            <td>{{ $item->food_name ?? $item->drink_name }}</td>
                                            <td>{{ $item->category->name }}</td>
                                            <td>{{ $item->quantity }} {{ $item->unit }}</td>
                                            <td>{{ number_format($item->unit_price, 0) }} FCFA</td>
                                            <td>{{ number_format($item->total_cost, 0) }} FCFA</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-3">
                                    {{ $detailedData->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Ajoutez ici le code pour les graphiques si nécessaire
</script>
@endsection
