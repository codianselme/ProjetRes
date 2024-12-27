<div>
<br><br>
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Liste des Permissions</h3>
                                <div class="nk-block-des text-soft">
                                    <p>Vous avez au total {{ $permissions->total() }} permissions.</p>
                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalForm">
                                    <em class="icon ni ni-plus"></em><span>Ajouter une Permission</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="nk-block">
                        <div class="card card-bordered card-stretch">
                            <div class="card-inner-group">
                                <div class="card-inner">
                                    <div class="card-title-group">
                                        <div class="card-tools">
                                            <div class="form-inline flex-nowrap gx-3">
                                                <div class="form-wrap w-150px">
                                                    <input type="text" class="form-control" placeholder="Rechercher une permission" wire:model="searchTerm">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-inner p-0">
                                    <div class="nk-tb-list nk-tb-ulist">
                                        <div class="nk-tb-item nk-tb-head">
                                            <div class="nk-tb-col"><span class="sub-text">Nom de la Permission</span></div>
                                            <div class="nk-tb-col nk-tb-col-tools text-end">
                                                <div class="dropdown">
                                                    <a href="#" class="btn btn-xs btn-outline-light btn-icon dropdown-toggle" data-bs-toggle="dropdown" data-offset="0,5">
                                                        <em class="icon ni ni-more-h"></em>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#modalForm"><em class="icon ni ni-plus"></em><span>Ajouter une Permission</span></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @foreach($permissions as $permission)
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col">
                                                    <span class="tb-lead">{{ ucFirst(str_replace('_', ' ', $permission->name)) }}</span>
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-tools">
                                                    <ul class="nk-tb-actions gx-1">
                                                        <li>
                                                            <button class="btn btn-trigger btn-icon" wire:click="edit({{ $permission->id }})">
                                                                <em class="icon ni ni-edit"></em>
                                                            </button>
                                                        </li>
                                                        {{-- <li>
                                                            <button class="btn btn-trigger btn-icon" wire:click="delete({{ $permission->id }})">
                                                                <em class="icon ni ni-trash"></em>
                                                            </button>
                                                        </li> --}}
                                                    </ul>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-inner">
                            <div class="nk-block-between-md g-3">
                                <div class="g">
                                    {{ $permissions->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Modal Form -->
        <div wire:ignore.self class="modal fade" id="modalForm">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $isEditing ? 'Modifier la Permission' : 'Nouvelle Permission' }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form wire:submit.prevent="{{ $isEditing ? 'update' : 'store' }}">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="form-label" for="name">Nom de la Permission</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" wire:model.defer="name" placeholder="Nom de la permission">
                                    @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-light">
                            <button type="submit" class="btn btn-primary">{{ $isEditing ? 'Mettre à jour' : 'Enregistrer' }}</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    
    </div>
    
    @section('js')
    <script>
        window.addEventListener('close-modal', event => {
            $('#modalForm').modal('hide');
        });

        window.addEventListener('show-modal', event => {
            $('#modalForm').modal('show');
        });

        // Confirmation de suppression avec SweetAlert
        window.addEventListener('swal:confirm', event => {
            Swal.fire({
                title: event.detail.title,
                text: event.detail.text,
                icon: event.detail.type,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, supprimer!',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deleteConfirmed', event.detail.id);
                }
            });
        });
    </script>
    @endsection
</div>
