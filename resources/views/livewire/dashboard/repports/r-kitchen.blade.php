<div>
    <br><br>
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Rapport des commandes reçues en cuisine</h3>
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
                                            <label class="form-label">Rechercher par Statut</label>
                                            <select wire:model="statusFilter" class="form-control mt-2">
                                                <option value="">Tous les statuts</option>
                                                <option value="completed">Complété</option>
                                                <option value="in_progress">En cours</option>
                                            </select>
                                        </div>
                                    </div>
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
                                            <label class="form-label">Rechercher</label>
                                            <input type="text" wire:model="ingredientFilter" placeholder="Filtrer par ingrédient" class="form-control mt-2" />
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
                                                    <h6 class="title">Total Commandes</h6>
                                                </div>
                                            </div>
                                            <div class="data">
                                                <div class="data-group">
                                                    <div class="amount">{{ $totalCommandes }}</div>
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
                                                    <h6 class="title">Ingrédients Total</h6>
                                                </div>
                                            </div>
                                            <div class="data">
                                                <div class="data-group">
                                                    <div class="amount">{{ $totalIngredients }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ingrédients les plus utilisés -->
                    <br>
                    @if (count($mostUsedIngredients) > 0)
                        <h5>Ingrédients les plus utilisés</h5>
                    @endif
                    
                    <div class="nk-block">
                        <div class="row g-gs">
                            @foreach($mostUsedIngredients as $ingredient => $quantity)
                                <div class="col-xxl-3 col-sm-6">
                                    <div class="card">
                                        <div class="nk-ecwg nk-ecwg6">
                                            <div class="card-inner">
                                                <div class="card-title-group">
                                                    <div class="card-title">
                                                        <h6 class="title">{{ $ingredient }}</h6>
                                                    </div>
                                                </div>
                                                <div class="data">
                                                    <div class="data-group">
                                                        <div class="amount">{{ $quantity }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Détails des ventes -->
                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <table class="table">
                                    <thead>
                                        <tr class="text-center">
                                            <th>#</th>
                                            <th>Plat Commandé</th>
                                            <th>Quantité de Plat</th>
                                            <th>Ingrédients</th>
                                            <th>Statut</th>
                                            <th>Opérateur</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($preparations as $k => $preparation)
                                            <tr>
                                                <td class="text-center">{{ $k + 1 }}</td>
                                                <td class="text-center">{{ $preparation->order->dish->name }}</td>
                                                <td class="text-center">{{ $preparation->quantity_used }}</td>
                                                <td class="text-left">
                                                    <ul>
                                                        @foreach($preparation->ingredientsUtilises as $ingredient)
                                                            <li>{{ $ingredient->ingredient_name }} [{{ $ingredient->quantity }} de {{ $ingredient->unit }}]</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td class="text-center">{{ $preparation->is_completed ? 'Complété' : 'En cours' }}</td>
                                                <td class="text-center">{{ $preparation->operateur ?? "-"}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-3">
                                    {{-- {{ $sales->links() }} --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('js')

@endsection
