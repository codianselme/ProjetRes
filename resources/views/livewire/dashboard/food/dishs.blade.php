<div>
    <br><br>
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Gestion des Plats</h3>
                                <div class="nk-block-des text-soft">
                                    <p>Vous avez au total {{ $dishes->total() }} plats.</p>
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
                                            @can('nouveau_met')
                                                <li class="nk-block-tools-opt">
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalForm">
                                                        <em class="icon ni ni-plus"></em><span>Ajouter un Plat</span>
                                                    </button>
                                                </li>
                                            @endcan
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
                                            <div class="nk-tb-col"><span class="sub-text">Nom du Plat</span></div>
                                            <div class="nk-tb-col tb-col-mb"><span class="sub-text">Description</span></div>
                                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Categorie</span></div>
                                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Prix</span></div>
                                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Statut</span></div>
                                            <div class="nk-tb-col nk-tb-col-tools text-end">Actions</div>
                                        </div>
                                        @foreach($dishes as $dish)
                                        <div class="nk-tb-item">
                                            <div class="nk-tb-col">
                                                <span class="tb-lead">{{ $dish->name }}</span>
                                            </div>
                                            <div class="nk-tb-col tb-col-mb">
                                                <span class="tb-sub">{{ Str::limit($dish->description, 50) }}</span>
                                            </div>
                                            <div class="nk-tb-col tb-col-md">
                                                <span class="tb-lead">{{ $dish->category->name }}</span>
                                            </div>
                                            <div class="nk-tb-col tb-col-md">
                                                <span class="tb-lead">{{ number_format($dish->price, 0, ',', ' ') }} FCFA</span>
                                            </div>
                                            <div class="nk-tb-col tb-col-md">
                                                <span class="badge badge-dot {{ $dish->is_available ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $dish->is_available ? 'Disponible' : 'Indisponible' }}
                                                </span>
                                            </div>
                                            <div class="nk-tb-col nk-tb-col-tools">
                                                <ul class="nk-tb-actions gx-1">
                                                    @can('modifier_met')
                                                        <li>
                                                            <button class="btn btn-trigger btn-icon" wire:click="edit({{ $dish->id }})">
                                                                <em class="icon ni ni-edit"></em>
                                                            </button>
                                                        </li>
                                                    @endcan

                                                    @can('supprimer_met')
                                                        <li>
                                                            <button class="btn btn-trigger btn-icon" wire:click="delete({{ $dish->id }})">
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
                                            {{ $dishes->links() }}
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
    <div wire:ignore.self class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="modalFormLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $isEditing ? 'Modifier' : 'Ajouter' }} un Plat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="{{ $isEditing ? 'update' : 'store' }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label" for="category_id">Catégorie</label>
                            <div class="form-control-wrap">
                                <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" 
                                    wire:model="category_id">
                                    <option value="">Sélectionnez une catégorie</option>
                                    @foreach($categories as $k => $category)
                                        <option value="{{ $category->id }}">{{ $k + 1 }}. {{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="name">Nom du Plat</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" 
                                    wire:model="name" placeholder="Nom du plat">
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="description">Description</label>
                            <div class="form-control-wrap">
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" 
                                    wire:model="description" rows="3" placeholder="Description du plat"></textarea>
                                @error('description')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="price">Prix (FCFA)</label>
                            <div class="form-control-wrap">
                                <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" 
                                    wire:model="price" min="0">
                                @error('price')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_available" 
                                    wire:model="is_available">
                                <label class="custom-control-label" for="is_available">Disponible</label>
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
