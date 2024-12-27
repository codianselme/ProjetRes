<div>

    <br><br>

    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Liste des Rôles</h3>
                                <div class="nk-block-des text-soft">
                                    <p>Vous avez au total {{ $roles->total() }} rôles.</p>
                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNewRole">
                                    <em class="icon ni ni-plus"></em>
                                    <span>Ajouter un Rôle</span>
                                </button>

                                <!-- Modal de nouveau Rôle -->
                                <div wire:ignore.self class="modal fade" id="modalNewRole">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Enregistrer un nouveau rôle</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form wire:submit.prevent="store">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label class="form-label" for="name">Nom du Rôle</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" wire:model.defer="name" required placeholder="Entrez le nom du rôle">
                                                            @error('name')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group mt-3">
                                                        <label class="form-label">Permissions</label>
                                                        <div class="form-control-wrap">
                                                            @foreach($permissions as $permission)
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" value="{{ $permission->id }}" wire:model.defer="selectedPermissions" id="permission{{ $permission->id }}">
                                                                    <label class="form-check-label" for="permission{{ $permission->id }}">
                                                                        {{ ucFirst(str_replace('_', ' ', $permission->name)) }}
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                            @error('selectedPermissions')
                                                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer bg-light">
                                                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal d'édition de Rôle -->
                                <div wire:ignore.self class="modal fade" id="modalEditRole">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Modifier le Rôle</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form wire:submit.prevent="updateRole">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label class="form-label" for="nameEdit">Nom du Rôle</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="nameEdit" wire:model.defer="name" required placeholder="Entrez le nom du rôle">
                                                            @error('name')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group mt-3">
                                                        <label class="form-label">Permissions</label>
                                                        <div class="form-control-wrap">
                                                            @foreach($permissions as $permission)
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" value="{{ $permission->id }}" wire:model.defer="selectedPermissions" id="permissionEdit{{ $permission->id }}">
                                                                    <label class="form-check-label" for="permissionEdit{{ $permission->id }}">
                                                                        {{ ucFirst(str_replace('_', ' ', $permission->name)) }}
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                            @error('selectedPermissions')
                                                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer bg-light">
                                                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

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
                                                    <input type="text" class="form-control" placeholder="Rechercher un rôle" wire:model="searchTerm">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Liste des Rôles -->
                                <div class="card-inner p-0">
                                    <div class="nk-tb-list nk-tb-ulist">
                                        <div class="nk-tb-item nk-tb-head">
                                            <div class="nk-tb-col"><span class="sub-text">Nom du Rôle</span></div>
                                            <div class="nk-tb-col"><span class="sub-text">Permissions</span></div>
                                            <div class="nk-tb-col nk-tb-col-tools text-end"><span class="sub-text">Actions</span></div>
                                        </div>
                                        @foreach($roles as $role)
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col">
                                                    <span class="tb-lead">{{ $role->name }}</span>
                                                </div>
                                                <div class="nk-tb-col">
                                                    @foreach($role->permissions as $permission)
                                                        <span class="badge bg-info text-white">{{ ucFirst(str_replace('_', ' ', $permission->name)) }}</span>
                                                    @endforeach
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-tools">
                                                    <ul class="nk-tb-actions gx-1">
                                                        <li>
                                                            <a href="#" wire:click.prevent="editRole({{ $role->id }})" class="btn btn-icon btn-trigger">
                                                                <em class="icon ni ni-edit"></em>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" wire:click.prevent="confirmDelete({{ $role->id }})" class="btn btn-icon btn-trigger">
                                                                <em class="icon ni ni-trash"></em>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <!-- Modal d'édition de Rôle (Déjà inclus ci-dessus) -->
                                            </div>
                                        @endforeach
                                    </div>
                                    <!-- Pagination -->
                                    <div class="card-inner">
                                        <div class="d-flex justify-content-center">
                                            {{ $roles->links() }}
                                        </div>
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
    <script>
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

        window.addEventListener('show-modal', event => {
            $('#' + event.detail.modal).modal('show');
        });
        
        window.addEventListener('close-modal', event => {
            $('#modalNewRole').modal('hide');
            $('#modalEditRole').modal('hide');
        });

        window.addEventListener('hide-modal', event => {
            $('#' + event.detail.modal).modal('hide');
        });
    </script>
    @endsection
</div>