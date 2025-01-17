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
                                                            <span class="badge text-bg-warning d-md-inline-flex">
                                                                <em class="icon ni ni-clock"></em>
                                                                <span>En attente</span>
                                                            </span>
                                                            @break
                                                        
                                                        @case('confirmed')
                                                            <span class="badge text-bg-success d-md-inline-flex">
                                                                <em class="icon ni ni-check-circle"></em>
                                                                <span>Confirmée</span>
                                                            </span>
                                                            @break
                                                            
                                                        @case('cancelled')
                                                            <span class="badge text-bg-danger d-md-inline-flex">
                                                                <em class="icon ni ni-cross-circle"></em>
                                                                <span>Annulée</span>
                                                            </span>
                                                            @break
                                                            
                                                        @default
                                                            <span class="badge text-bg-secondary d-md-inline-flex">
                                                                <span>{{ $reservation->status }}</span>
                                                            </span>
                                                    @endswitch
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-tools text-right">
                                                    <ul class="nk-tb-actions gx-1 justify-content-center">
                                                        <li>
                                                            <div class="drodown d-inline-block">
                                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown">
                                                                    <em class="icon ni ni-more-h"></em>
                                                                </a>
                                                                <div class="dropdown-menu">
                                                                    <ul class="link-list-opt no-bdr">
                                                                        <li>
                                                                            <a href="#" wire:click.prevent="showReservationDetails({{ $reservation->id }})">
                                                                                <em class="icon ni ni-eye"></em>
                                                                                <span>Voir détails</span>
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="#" wire:click.prevent="updateStatus({{ $reservation->id }}, 'confirmed')" 
                                                                               @if($reservation->status === 'confirmed') class="disabled" @endif>
                                                                                <em class="icon ni ni-check-circle"></em>
                                                                                <span>Confirmer</span>
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="#" wire:click.prevent="updateStatus({{ $reservation->id }}, 'cancelled')"
                                                                               @if($reservation->status === 'cancelled') class="disabled" @endif>
                                                                                <em class="icon ni ni-cross-circle"></em>
                                                                                <span>Annuler</span>
                                                                            </a>
                                                                        </li>
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
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white">Détails de la réservation</h5>
                        <button wire:click="closeModal" class="close text-white">
                            <em class="icon ni ni-cross"></em>
                        </button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="card card-bordered h-100">
                            <div class="card-inner">
                                <div class="card-title-group align-start mb-3">
                                    <div class="card-title">
                                        <h6 class="title">Informations de la réservation</h6>
                                        <p class="text-soft">
                                            Réservation #{{ $selectedReservation->id }}
                                        </p>
                                    </div>
                                    <div class="card-tools">
                                        @switch($selectedReservation->status)
                                            @case('pending')
                                                <span class="badge badge-dim badge-warning d-md-inline-flex">
                                                    <em class="icon ni ni-clock me-1"></em>
                                                    <span>En attente</span>
                                                </span>
                                                @break
                                            @case('confirmed')
                                                <span class="badge badge-dim badge-success d-md-inline-flex">
                                                    <em class="icon ni ni-check-circle me-1"></em>
                                                    <span>Confirmée</span>
                                                </span>
                                                @break
                                            @case('cancelled')
                                                <span class="badge badge-dim badge-danger d-md-inline-flex">
                                                    <em class="icon ni ni-cross-circle me-1"></em>
                                                    <span>Annulée</span>
                                                </span>
                                                @break
                                        @endswitch
                                    </div>
                                </div>
                                <div class="row g-4">
                                    <div class="col-sm-6">
                                        <div class="detail-group">
                                            <label class="overline-title text-primary-alt mb-2">
                                                <em class="icon ni ni-user me-2"></em>Client
                                            </label>
                                            <p class="fs-15px">{{ $selectedReservation->customer_name }}</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="detail-group">
                                            <label class="overline-title text-primary-alt mb-2">
                                                <em class="icon ni ni-call me-2"></em>Téléphone
                                            </label>
                                            <p class="fs-15px">{{ $selectedReservation->phone }}</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="detail-group">
                                            <label class="overline-title text-primary-alt mb-2">
                                                <em class="icon ni ni-mail me-2"></em>Email
                                            </label>
                                            <p class="fs-15px">{{ $selectedReservation->email }}</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="detail-group">
                                            <label class="overline-title text-primary-alt mb-2">
                                                <em class="icon ni ni-calendar me-2"></em>Date et Heure
                                            </label>
                                            <p class="fs-15px">
                                                {{ \Carbon\Carbon::parse($selectedReservation->date)->format('d/m/Y') }}
                                                à {{ \Carbon\Carbon::parse($selectedReservation->time)->format('H:i') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="detail-group">
                                            <label class="overline-title text-primary-alt mb-2">
                                                <em class="icon ni ni-users me-2"></em>Nombre de personnes
                                            </label>
                                            <p class="fs-15px">{{ $selectedReservation->persons }} personnes</p>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="detail-group">
                                            <label class="overline-title text-primary-alt mb-2">
                                                <em class="icon ni ni-notes me-2"></em>Demandes spéciales
                                            </label>
                                            <p class="fs-15px">{{ $selectedReservation->special_requests ?: 'Aucune demande spéciale' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button wire:click="closeModal" class="btn btn-outline-primary">
                            <em class="icon ni ni-cross me-1"></em>
                            <span>Fermer</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    @endif
</div>
