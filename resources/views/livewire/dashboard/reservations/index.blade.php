<div>
    <br><br>
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Liste des reservations</h3>
                                <div class="nk-block-des text-soft">
                                    <p>Vous avez au total {{ count($reservations) }} reservations.</p>
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
                                            <div class="nk-tb-col"><span class="sub-text">Numero</span></div>
                                            <div class="nk-tb-col"><span class="sub-text">Date</span></div>
                                            <div class="nk-tb-col"><span class="sub-text">Personnes</span></div>
                                            <div class="nk-tb-col"><span class="sub-text">Statut</span></div>
                                            <div class="nk-tb-col"><span class="sub-text">Actions</span></div>
                                        </div>

                                        @foreach($reservations as $reservation)
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col">
                                                    <span class="tb-lead">{{ $reservation->customer_name }}</span>
                                                </div>
                                                <div class="nk-tb-col">
                                                    <span class="tb-sub">{{ $reservation->phone }}</span>
                                                </div>
                                                <div class="nk-tb-col">
                                                    <span>{{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y') }}</span>
                                                    <span class="tb-sub">{{ \Carbon\Carbon::parse($reservation->time)->format('H:i') }}</span>
                                                </div>
                                                <div class="nk-tb-col">
                                                    <span>{{ $reservation->persons }} personnes</span>
                                                </div>
                                                <div class="nk-tb-col">
                                                
                                                    @switch($reservation->status)
                                                        @case('pending')
                                                            <span class="badge badge-dim badge-warning d-none d-md-inline-flex">
                                                                <em class="icon ni ni-clock"></em>
                                                                <span>En attente</span>
                                                            </span>
                                                            @break
                                                        
                                                        @case('confirmed')
                                                            <span class="badge badge-dim badge-success d-none d-md-inline-flex">
                                                                <em class="icon ni ni-check-circle"></em>
                                                                <span>Confirmée</span>
                                                            </span>
                                                            @break
                                                            
                                                        @case('cancelled')
                                                            <span class="badge badge-dim badge-danger d-none d-md-inline-flex">
                                                                <em class="icon ni ni-cross-circle"></em>
                                                                <span>Annulée</span>
                                                            </span>
                                                            @break
                                                            
                                                        @default
                                                            <span class="badge badge-dim badge-secondary d-none d-md-inline-flex">
                                                                <span>{{ $reservation->status }}</span>
                                                            </span>
                                                    @endswitch
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-tools">
                                                    
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="card-inner">
                                    {{ $reservations->links() }}
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
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Détails de la réservation</h5>
                        <button wire:click="closeModal" class="close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Détails de la réservation -->
                        <div class="form-group">
                            <label class="form-label">Client</label>
                            <input type="text" class="form-control" value="{{ $selectedReservation->customer_name }}" readonly>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Téléphone</label>
                            <input type="text" class="form-control" value="{{ $selectedReservation->phone }}" readonly>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control" value="{{ $selectedReservation->email }}" readonly>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Date et Heure</label>
                            <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($selectedReservation->date)->format('d/m/Y') }} à {{ \Carbon\Carbon::parse($selectedReservation->time)->format('H:i') }}" readonly>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nombre de personnes</label>
                            <input type="text" class="form-control" value="{{ $selectedReservation->persons }}" readonly>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Demandes spéciales</label>
                            <textarea class="form-control" rows="3" readonly>{{ $selectedReservation->special_requests }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Statut</label>
                            <input type="text" class="form-control" value="{{ $selectedReservation->status }}" readonly>
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
