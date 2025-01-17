<div>
    <br><br>
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Liste des commandes</h3>
                                <div class="nk-block-des text-soft">
                                    <p>Vous avez au total {{ count($commands) }} commandes.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="nk-block">
                        <div class="card card-bordered card-stretch">
                            <div class="card-inner-group">
                                <div class="card-inner position-relative">
                                    <div class="card-title-group">
                                        <div class="card-tools">
                                            <div class="form-inline flex-nowrap gx-3">
                                                <div class="form-wrap w-150px">
                                                    <input type="text" 
                                                           class="form-control" 
                                                           wire:model.debounce.300ms="search"
                                                           placeholder="Rechercher...">
                                                </div>
                                                <div class="form-wrap w-150px">
                                                    <input type="date" 
                                                           class="form-control" 
                                                           wire:model="filterDate">
                                                </div>
                                                <div class="form-wrap w-150px">
                                                    <select class="form-control" wire:model="filterStatus">
                                                        <option value="">Tous les statuts</option>
                                                        <option value="pending">En attente</option>
                                                        <option value="confirmed">Confirmée</option>
                                                        <option value="delivered">Livrée</option>
                                                        <option value="cancelled">Annulée</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-inner p-0">
                                    <div class="nk-tb-list nk-tb-ulist">
                                        <div class="nk-tb-item nk-tb-head">
                                            <div class="nk-tb-col"><span class="sub-text">Client</span></div>
                                            <div class="nk-tb-col"><span class="sub-text">Contact</span></div>
                                            <div class="nk-tb-col"><span class="sub-text">Montant</span></div>
                                            <div class="nk-tb-col"><span class="sub-text">Date Demande</span></div>
                                            <div class="nk-tb-col"><span class="sub-text">Statut</span></div>
                                            <div class="nk-tb-col"><span class="sub-text">Actions</span></div>
                                        </div>

                                        @foreach($commands as $command)
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col">
                                                    <span class="tb-lead">{{ $command->customer_name }}</span>
                                                </div>
                                                <div class="nk-tb-col">
                                                    <span class="tb-lead">{{ number_format($command->total_amount, 0, ',', ' ') }} FCFA</span>
                                                </div>
                                                <div class="nk-tb-col">
                                                    <span class="tb-lead">{{ $command->phone }}</span>
                                                </div>
                                                <div class="nk-tb-col">
                                                    <span>{{ $command->created_at->format('d/m/Y à H:i:s') }}</span>
                                                </div>
                                                <div class="nk-tb-col">
                                                    @switch($command->status)
                                                        @case('pending')
                                                            <span class="badge text-bg-warning d-md-inline-flex">
                                                                <em class="icon ni ni-clock"></em>
                                                                <span>En attente</span>
                                                            </span>
                                                            @break
                                                        @case('confirmed')
                                                            <span class="badge text-bg-info d-md-inline-flex">
                                                                <em class="icon ni ni-check-circle"></em>
                                                                <span>Confirmée</span>
                                                            </span>
                                                            @break
                                                        @case('delivered')
                                                            <span class="badge text-bg-success d-md-inline-flex">
                                                                <em class="icon ni ni-truck"></em>
                                                                <span>Livrée</span>
                                                            </span>
                                                            @break
                                                        @case('cancelled')
                                                            <span class="badge text-bg-danger d-md-inline-flex">">
                                                                <em class="icon ni ni-cross-circle"></em>
                                                                <span>Annulée</span>
                                                            </span>
                                                            @break
                                                    @endswitch
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-tools">
                                                    <ul class="nk-tb-actions gx-1 justify-content-center">
                                                        <li>
                                                            <div class="drodown d-inline-block">
                                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown">
                                                                    <em class="icon ni ni-more-h"></em>
                                                                </a>
                                                                <div class="dropdown-menu">
                                                                    <ul class="link-list-opt no-bdr">
                                                                        <li>
                                                                            <a href="#" wire:click.prevent="showCommandDetails({{ $command->id }})">
                                                                                <em class="icon ni ni-eye"></em>
                                                                                <span>Voir détails</span>
                                                                            </a>
                                                                        </li>
                                                                        @if($command->status === 'pending')
                                                                            <li>
                                                                                <a href="#" wire:click="updateStatus({{ $command->id }}, 'confirmed')">
                                                                                    <em class="icon ni ni-check-circle"></em>
                                                                                    <span>Confirmer</span>
                                                                                </a>
                                                                            </li>
                                                                        @endif
                                                                        @if($command->status === 'confirmed')
                                                                            <li>
                                                                                <a href="#" wire:click="updateStatus({{ $command->id }}, 'delivered')">
                                                                                    <em class="icon ni ni-truck"></em>
                                                                                    <span>Marquer comme livrée</span>
                                                                                </a>
                                                                            </li>
                                                                        @endif
                                                                        @if($command->status !== 'cancelled' && $command->status !== 'delivered')
                                                                            <li>
                                                                                <a href="#" wire:click="updateStatus({{ $command->id }}, 'cancelled')">
                                                                                    <em class="icon ni ni-cross-circle"></em>
                                                                                    <span>Annuler</span>
                                                                                </a>
                                                                            </li>
                                                                        @endif
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="card-inner">
                                    {{ $commands->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($showModal)
        <div class="modal fade show" style="display: block;">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Détails de la commande</h5>
                        <button wire:click="closeModal" class="close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Client</label>
                                    <input type="text" class="form-control" value="{{ $selectedCommand->customer_name }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Téléphone</label>
                                    <input type="text" class="form-control" value="{{ $selectedCommand->phone }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Email</label>
                                    <input type="text" class="form-control" value="{{ $selectedCommand->email }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Date de commande</label>
                                    <input type="text" class="form-control" value="{{ $selectedCommand->created_at->format('d/m/Y H:i') }}" readonly>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Adresse de livraison</label>
                                    <textarea class="form-control" rows="2" readonly>{{ $selectedCommand->delivery_address }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <h6 class="title">Articles commandés</h6>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width: 30%">Plat</th>
                                                <th style="width: 10%">Qté</th>
                                                <th style="width: 15%">Prix unitaire</th>
                                                <th style="width: 15%">Total</th>
                                                <th style="width: 20%">Notes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($selectedCommand->items as $item)
                                                <tr>
                                                    <td>{{ $item->dish_name }}</td>
                                                    <td>{{ $item->quantity }}</td>
                                                    <td>{{ number_format($item->price, 0, ',', ' ') }} FCFA</td>
                                                    <td>{{ number_format($item->price * $item->quantity, 0, ',', ' ') }} FCFA</td>
                                                    <td>{{ $item->notes }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="3" class="text-right"><strong>Total</strong></td>
                                                <td colspan="2"><strong>{{ number_format($selectedCommand->total_amount, 0, ',', ' ') }} FCFA</strong></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button wire:click="closeModal" class="btn btn-secondary">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    @endif
</div>
