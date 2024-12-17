<div>
    <br><br>
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Approvisionnements Alimentaires</h3>
                                <div class="nk-block-des text-soft">
                                    <p>Vous avez au total {{ $supplies->total() }} approvisionnements.</p>
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
                                            <li class="nk-block-tools-opt">
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalForm">
                                                    <em class="icon ni ni-plus"></em><span>Ajouter un Approvisionnement</span>
                                                </button>
                                            </li>
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
                                            <div class="nk-tb-col"><span class="sub-text">Aliment</span></div>
                                            <div class="nk-tb-col tb-col-mb"><span class="sub-text">Catégorie</span></div>
                                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Quantité</span></div>
                                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Prix Unitaire</span></div>
                                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Coût Total</span></div>
                                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Date</span></div>
                                            <div class="nk-tb-col nk-tb-col-tools text-end">Actions</div>
                                        </div>
                                        @foreach($supplies as $supply)
                                        <div class="nk-tb-item">
                                            <div class="nk-tb-col">
                                                <span class="tb-lead">{{ $supply->food_name }}</span>
                                                <span class="tb-sub">{{ $supply->supplier_name }}</span>
                                            </div>
                                            <div class="nk-tb-col tb-col-mb">
                                                <span class="tb-lead">{{ $supply->category->name }}</span>
                                            </div>
                                            <div class="nk-tb-col tb-col-md">
                                                <span class="tb-lead">{{ $supply->quantity }} {{ $supply->unit }}</span>
                                            </div>
                                            <div class="nk-tb-col tb-col-md">
                                                <span class="tb-lead">{{ number_format($supply->unit_price, 2) }} FCFA</span>
                                            </div>
                                            <div class="nk-tb-col tb-col-md">
                                                <span class="tb-lead">{{ number_format($supply->total_cost, 2) }} FCFA</span>
                                            </div>
                                            <div class="nk-tb-col tb-col-md">
                                                <span class="tb-lead">{{ $supply->supply_date->format('d/m/Y') }}</span>
                                            </div>
                                            <div class="nk-tb-col nk-tb-col-tools">
                                                <ul class="nk-tb-actions gx-1">
                                                    <li>
                                                        <button class="btn btn-trigger btn-icon" wire:click="edit({{ $supply->id }})">
                                                            <em class="icon ni ni-edit"></em>
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button class="btn btn-trigger btn-icon" wire:click="delete({{ $supply->id }})">
                                                            <em class="icon ni ni-trash"></em>
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="card-inner">
                                    <div class="nk-block-between-md g-3">
                                        <div class="g">
                                            {{ $supplies->links() }}
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
                    <h5 class="modal-title">{{ $isEditing ? 'Modifier l\'Approvisionnement' : 'Nouvel Approvisionnement' }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="{{ $isEditing ? 'update' : 'store' }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label" for="category_id">Catégorie</label>
                            <div class="form-control-wrap">
                                <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" 
                                    wire:model.defer="category_id">
                                    <option value="">Sélectionner une catégorie</option>
                                    @foreach($categories as $key => $category)
                                        <option value="{{ $category->id }}">{{ $key + 1 }}. {{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="food_name">Nom de l'aliment</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control @error('food_name') is-invalid @enderror" id="food_name" 
                                    wire:model.defer="food_name" placeholder="Nom de l'aliment">
                                @error('food_name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="unit">Unité de mesure</label>
                            <div class="form-control-wrap">
                                <select class="form-control @error('unit') is-invalid @enderror" id="unit" 
                                    wire:model.defer="unit">
                                    <option value="">Sélectionner une unité de mesure</option>
                                    <option value="casiers">1. Casiers</option>
                                    <option value="cartons">2. cartons</option>
                                    <option value="pièces">3. pièces</option>
                                    <option value="litre">4. litre</option>
                                    <option value="kg">5. kg</option>
                                    <option value="aucun">6. Aucun</option>
                                </select>
                                @error('unit')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="supplier_name">Fournisseur</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control @error('supplier_name') is-invalid @enderror" id="supplier_name" 
                                    wire:model.defer="supplier_name" placeholder="Nom du fournisseur">
                                @error('supplier_name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label" for="quantity">Quantité</label>
                                    <div class="form-control-wrap">
                                        <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" 
                                            wire:model.defer="quantity" min="1">
                                        @error('quantity')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label" for="unit_price">Prix unitaire</label>
                                    <div class="form-control-wrap">
                                        <input type="number" class="form-control @error('unit_price') is-invalid @enderror" id="unit_price" 
                                            wire:model.defer="unit_price" min="0" step="0.01">
                                        @error('unit_price')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="supply_date">Date d'approvisionnement</label>
                            <div class="form-control-wrap">
                                <input type="date" class="form-control @error('supply_date') is-invalid @enderror" id="supply_date" 
                                    wire:model.defer="supply_date">
                                @error('supply_date')
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