<div>
    <br><br>
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Liste des messages</h3>
                                <div class="nk-block-des text-soft">
                                    <p>Vous avez au total {{ count($contacts) }} messages.</p>
                                </div>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card-inner p-0">
                                    <div class="nk-tb-list nk-tb-ulist">
                                        <div class="nk-tb-item nk-tb-head">
                                            <div class="nk-tb-col"><span class="sub-text">Nom</span></div>
                                            <div class="nk-tb-col"><span class="sub-text">Email</span></div>
                                            <div class="nk-tb-col"><span class="sub-text">Téléphone</span></div>
                                            <div class="nk-tb-col"><span class="sub-text">Date</span></div>
                                            <div class="nk-tb-col"><span class="sub-text">Actions</span></div>
                                        </div>
                                        
                                        @foreach($contacts as $contact)
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col">
                                                    <span>{{ $contact->name }}</span>
                                                </div>
                                                <div class="nk-tb-col">
                                                    <span>{{ $contact->email }}</span>
                                                </div>
                                                <div class="nk-tb-col">
                                                    <span>{{ $contact->phone ?? 'N/A' }}</span>
                                                </div>
                                                <div class="nk-tb-col">
                                                    <span>{{ $contact->created_at->format('d/m/Y H:i') }}</span>
                                                </div>
                                                <div class="nk-tb-col">
                                                    <button class="btn btn-sm btn-primary" 
                                                            wire:click="showContactDetails({{ $contact->id }})">
                                                        Voir détails
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                
                                <div class="card-inner">
                                    {{ $contacts->links() }}
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
                        <h5 class="modal-title">Détails du message</h5>
                        <button wire:click="closeModal" class="close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label">Nom</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" value="{{ $selectedContact->name }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" value="{{ $selectedContact->email }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Téléphone</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" value="{{ $selectedContact->phone ?? 'N/A' }}" readonly>
                            </div>
                        </div>
                        {{-- <div class="form-group">
                            <label class="form-label">Site web</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" value="{{ $selectedContact->website ?? 'N/A' }}" readonly>
                            </div>
                        </div> --}}
                        <div class="form-group">
                            <label class="form-label">Message</label>
                            <div class="form-control-wrap">
                                <textarea class="form-control" rows="5" readonly>{{ $selectedContact->message }}</textarea>
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
