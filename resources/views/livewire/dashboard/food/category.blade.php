<div>
    <br><br>
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Catégories d'Aliments</h3>
                                <div class="nk-block-des text-soft">
                                    <p>Vous avez au total {{ $categories->total() }} catégories.</p>
                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li>
                                                <div class="form-control-wrap">
                                                    <div class="form-icon form-icon-right">
                                                        <em class="icon ni ni-search"></em>
                                                    </div>
                                                    <input type="text" class="form-control" id="search" wire:model="searchTerm" placeholder="Rechercher...">
                                                </div>
                                            </li>
                                            {{-- @can('nouveau_aliment') --}}
                                                <li class="nk-block-tools-opt">
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalForm">
                                                        <em class="icon ni ni-plus"></em><span>Ajouter une Catégorie</span>
                                                    </button>
                                                </li>
                                            {{-- @endcan --}}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nk-block">
                        <div class="card card-bordered card-stretch">
                            <div class="card-inner-group">
                                <div class="card-inner p-0">
                                    <div class="nk-tb-list nk-tb-ulist">
                                        <div class="nk-tb-item nk-tb-head">
                                            <div class="nk-tb-col" style="width: 20%;"><span class="sub-text">Nom</span></div>
                                            <div class="nk-tb-col tb-col-mb" style="width: 60%;"><span class="sub-text">Description</span></div>
                                            <div class="nk-tb-col tb-col-md" style="width: 10%;"><span class="sub-text">Statut</span></div>
                                            <div class="nk-tb-col nk-tb-col-tools text-end" style="width: 10%;">Actions</div>
                                        </div>
                                        @foreach($categories as $category)
                                        <div class="nk-tb-item">
                                            <div class="nk-tb-col">
                                                <span class="tb-lead">{{ $category->name }}</span>
                                            </div>
                                            <div class="nk-tb-col tb-col-mb">
                                                <span class="tb-lead">{{ $category->description }}</span>
                                            </div>
                                            <div class="nk-tb-col tb-col-md">
                                                <span class="badge badge-dot {{ $category->is_active ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $category->is_active ? 'Actif' : 'Inactif' }}
                                                </span>
                                            </div>
                                            <div class="nk-tb-col nk-tb-col-tools">
                                                <ul class="nk-tb-actions gx-1">
                                                    @can('modifier_aliment')
                                                        <li>
                                                            <button class="btn btn-trigger btn-icon" wire:click="edit({{ $category->id }})">
                                                                <em class="icon ni ni-edit"></em>
                                                            </button>
                                                        </li>
                                                    @endcan

                                                    @can('supprimer_aliment')
                                                        <li>
                                                            <button class="btn btn-trigger btn-icon" wire:click="delete({{ $category->id }})">
                                                                <em class="icon ni ni-trash"></em>
                                                            </button>
                                                        </li>
                                                    @endcan
                                                </ul>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="card-inner">
                                    <div class="nk-block-between-md g-3">
                                        <div class="g">
                                            {{ $categories->links() }}
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

    <!-- Modal Form -->
    <div wire:ignore.self class="modal fade" id="modalForm">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $isEditing ? 'Modifier la Catégorie' : 'Nouvelle Catégorie' }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="{{ $isEditing ? 'update' : 'store' }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label" for="name">Nom</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" 
                                    wire:model.defer="name" placeholder="Nom de la catégorie">
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="description">Description</label>
                            <div class="form-control-wrap">
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" 
                                    wire:model.defer="description" placeholder="Description de la catégorie"></textarea>
                                @error('description')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_active" 
                                    wire:model.defer="is_active">
                                <label class="custom-control-label" for="is_active">Actif</label>
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

    // Ajout de la confirmation de suppression
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
