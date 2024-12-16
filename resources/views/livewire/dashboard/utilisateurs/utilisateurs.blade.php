<div>
    <br><br>
    <!-- content @s -->
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Liste des Utilisateurs</h3>
                                <div class="nk-block-des text-soft">
                                    <p>Vous avez au total {{ $users->total() }} utilisateurs.</p>
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li><a href="#" class="btn btn-white btn-outline-light"><em class="icon ni ni-download-cloud"></em><span>Export</span></a></li>
                                            <li class="nk-block-tools-opt">
                                                <div class="drodown">
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNewUser">
                                                        <em class="icon ni ni-plus"></em>
                                                        <span>Ajouter un Utilisateur</span>
                                                    </button>

                                                    <!-- Modal de nouvelle Utilisateur -->
                                                    <div wire:ignore.self class="modal fade" id="modalNewUser">
                                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Enregistrer un nouvel utilisateur</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form wire:submit.prevent="store">
                                                                    <div class="modal-body">
                                                                        <div class="container-fluid">
                                                                            <div class="row g-3">

                                                                                <!-- Prénom et Nom -->
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label class="form-label" for="first_name">Nom</label>
                                                                                        <div class="form-control-wrap">
                                                                                            <input type="text" class="form-control @error('first_name') is-invalid @enderror" 
                                                                                                id="first_name" wire:model.defer="first_name" required placeholder="Entrez le nom">
                                                                                            @error('first_name')
                                                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                                            @enderror
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label class="form-label" for="last_name">Prénom</label>
                                                                                        <div class="form-control-wrap">
                                                                                            <input type="text" class="form-control @error('last_name') is-invalid @enderror" 
                                                                                                id="last_name" wire:model.defer="last_name" required placeholder="Entrez le prénom">
                                                                                            @error('last_name')
                                                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                                            @enderror
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <!-- Email et Contact -->
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label class="form-label" for="email">Email</label>
                                                                                        <div class="form-control-wrap">
                                                                                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                                                                                id="email" wire:model.defer="email" required placeholder="Entrez l'email">
                                                                                            @error('email')
                                                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                                            @enderror
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label class="form-label" for="contact">Contact</label>
                                                                                        <div class="form-control-wrap">
                                                                                            <input type="text" class="form-control @error('contact') is-invalid @enderror" 
                                                                                                id="contact" wire:model.defer="contact" placeholder="Entrez le contact">
                                                                                            @error('contact')
                                                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                                            @enderror
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <!-- Poste et Genre -->
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label class="form-label" for="poste">Poste</label>
                                                                                        <div class="form-control-wrap">
                                                                                            <input type="text" class="form-control @error('poste') is-invalid @enderror" 
                                                                                                id="poste" wire:model.defer="poste" placeholder="Entrez le poste">
                                                                                            @error('poste')
                                                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                                            @enderror
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label class="form-label" for="gender">Genre</label>
                                                                                        <div class="form-control-wrap">
                                                                                            <select class="form-select @error('gender') is-invalid @enderror" 
                                                                                                wire:model.defer="gender" id="gender" required>
                                                                                                <option value="">Sélectionner le genre</option>
                                                                                                <option value="Masculin">1. Masculin</option>
                                                                                                <option value="Féminin">2. Féminin</option>
                                                                                            </select>
                                                                                            @error('gender')
                                                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                                            @enderror
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label class="form-label" for="role">Genre</label>
                                                                                        <div class="form-control-wrap">
                                                                                            <select class="form-select @error('role') is-invalid @enderror" 
                                                                                                wire:model.defer="role" id="role" required>
                                                                                                <option>Sélectionnez un profile</option>
                                                                                                @foreach ($roles as $k => $role)
                                                                                                    <option value="{{ $role->name }}">{{ $k+1 }}. {{ $role->name }}</option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                            @error('role')
                                                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                                            @enderror
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <!-- Adresse -->
                                                                                <div class="col-12">
                                                                                    <div class="form-group">
                                                                                        <label class="form-label" for="address">Adresse</label>
                                                                                        <div class="form-control-wrap">
                                                                                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                                                                                id="address" wire:model="address" placeholder="Entrez l'adresse"></textarea>
                                                                                            @error('address')
                                                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                                            @enderror
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
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
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div><!-- .toggle-wrap -->
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="card card-bordered card-stretch">
                            <div class="card-inner-group">
                                <div class="card-inner position-relative card-tools-toggle">
                                    <div class="card-title-group">
                                        <div class="card-tools">
                                            <div class="form-inline flex-nowrap gx-3">
                                                <div class="form-wrap w-150px">
                                                    <select class="form-select js-select2" data-search="off" data-placeholder="Bulk Action">
                                                        <option value="">Bulk Action</option>
                                                        <option value="email">Send Email</option>
                                                        <option value="group">Change Group</option>
                                                        <option value="suspend">Suspend User</option>
                                                        <option value="delete">Delete User</option>
                                                    </select>
                                                </div>
                                                <div class="btn-wrap">
                                                    <span class="d-none d-md-block"><button class="btn btn-dim btn-outline-light disabled">Apply</button></span>
                                                    <span class="d-md-none"><button class="btn btn-dim btn-outline-light btn-icon disabled"><em class="icon ni ni-arrow-right"></em></button></span>
                                                </div>
                                            </div><!-- .form-inline -->
                                        </div><!-- .card-tools -->
                                        <div class="card-tools me-n1">
                                            <ul class="btn-toolbar gx-1">
                                                <li>
                                                    <a href="#" class="btn btn-icon search-toggle toggle-search" data-target="search"><em class="icon ni ni-search"></em></a>
                                                </li><!-- li -->
                                                <li class="btn-toolbar-sep"></li><!-- li -->
                                                <li>
                                                    <div class="toggle-wrap">
                                                        <a href="#" class="btn btn-icon btn-trigger toggle" data-target="cardTools"><em class="icon ni ni-menu-right"></em></a>
                                                        <div class="toggle-content" data-content="cardTools">
                                                            <ul class="btn-toolbar gx-1">
                                                                <li class="toggle-close">
                                                                    <a href="#" class="btn btn-icon btn-trigger toggle" data-target="cardTools"><em class="icon ni ni-arrow-left"></em></a>
                                                                </li><!-- li -->
                                                                <li>
                                                                    <div class="dropdown">
                                                                        <a href="#" class="btn btn-trigger btn-icon dropdown-toggle" data-bs-toggle="dropdown">
                                                                            <div class="dot dot-primary"></div>
                                                                            <em class="icon ni ni-filter-alt"></em>
                                                                        </a>
                                                                        <div class="filter-wg dropdown-menu dropdown-menu-xl dropdown-menu-end">
                                                                            <div class="dropdown-head">
                                                                                <span class="sub-title dropdown-title">Filter Users</span>
                                                                            </div>
                                                                            <div class="dropdown-body dropdown-body-rg">
                                                                                <div class="row gx-6 gy-3">
                                                                                    <div class="col-6">
                                                                                        <div class="custom-control custom-control-sm custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="hasBalance">
                                                                                            <label class="custom-control-label" for="hasBalance"> Have Balance</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <div class="custom-control custom-control-sm custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="hasKYC">
                                                                                            <label class="custom-control-label" for="hasKYC"> KYC Verified</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <div class="form-group">
                                                                                            <label class="overline-title overline-title-alt">Role</label>
                                                                                            <select class="form-select js-select2">
                                                                                                <option value="any">Any Role</option>
                                                                                                <option value="investor">Investor</option>
                                                                                                <option value="seller">Seller</option>
                                                                                                <option value="buyer">Buyer</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <div class="form-group">
                                                                                            <label class="overline-title overline-title-alt">Status</label>
                                                                                            <select class="form-select js-select2">
                                                                                                <option value="any">Any Status</option>
                                                                                                <option value="active">Active</option>
                                                                                                <option value="pending">Pending</option>
                                                                                                <option value="suspend">Suspend</option>
                                                                                                <option value="deleted">Deleted</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-12">
                                                                                        <div class="form-group">
                                                                                            <button type="button" class="btn btn-secondary">Filter</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="dropdown-foot between">
                                                                                <a class="clickable" href="#">Reset Filter</a>
                                                                                <a href="#">Save Filter</a>
                                                                            </div>
                                                                        </div><!-- .filter-wg -->
                                                                    </div><!-- .dropdown -->
                                                                </li><!-- li -->
                                                                <li>
                                                                    <div class="dropdown">
                                                                        <a href="#" class="btn btn-trigger btn-icon dropdown-toggle" data-bs-toggle="dropdown">
                                                                            <em class="icon ni ni-setting"></em>
                                                                        </a>
                                                                        <div class="dropdown-menu dropdown-menu-xs dropdown-menu-end">
                                                                            <ul class="link-check">
                                                                                <li><span>Show</span></li>
                                                                                <li class="active"><a href="#">10</a></li>
                                                                                <li><a href="#">20</a></li>
                                                                                <li><a href="#">50</a></li>
                                                                            </ul>
                                                                            <ul class="link-check">
                                                                                <li><span>Order</span></li>
                                                                                <li class="active"><a href="#">DESC</a></li>
                                                                                <li><a href="#">ASC</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div><!-- .dropdown -->
                                                                </li><!-- li -->
                                                            </ul><!-- .btn-toolbar -->
                                                        </div><!-- .toggle-content -->
                                                    </div><!-- .toggle-wrap -->
                                                </li><!-- li -->
                                            </ul><!-- .btn-toolbar -->
                                        </div><!-- .card-tools -->
                                    </div><!-- .card-title-group -->
                                    <div class="card-search search-wrap" data-search="search">
                                        <div class="card-body">
                                            <div class="search-content">
                                                <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                                                <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search by user or email">
                                                <button class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
                                            </div>
                                        </div>
                                    </div><!-- .card-search -->
                                </div><!-- .card-inner -->
                                <div class="card-inner p-0">
                                    <div class="nk-tb-list nk-tb-ulist">
                                        <div class="nk-tb-item nk-tb-head">
                                            <div class="nk-tb-col nk-tb-col-check">
                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                    <input type="checkbox" class="custom-control-input" id="uid">
                                                    <label class="custom-control-label" for="uid"></label>
                                                </div>
                                            </div>
                                            <div class="nk-tb-col"><span class="sub-text">Utilisateur</span></div>
                                            <div class="nk-tb-col tb-col-mb"><span class="sub-text">Contact</span></div>
                                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Poste</span></div>
                                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Profile</span></div>
                                            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Genre</span></div>
                                            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Adresse</span></div>
                                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></div>
                                            <div class="nk-tb-col nk-tb-col-tools text-end">
                                                <div class="dropdown">
                                                    <a href="#" class="btn btn-xs btn-outline-light btn-icon dropdown-toggle" data-bs-toggle="dropdown" data-offset="0,5"><em class="icon ni ni-plus"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-xs dropdown-menu-end">
                                                        <ul class="link-tidy sm no-bdr">
                                                            <li>
                                                                <div class="custom-control custom-control-sm custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" checked="" id="bl">
                                                                    <label class="custom-control-label" for="bl">Balance</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-control custom-control-sm custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" checked="" id="ph">
                                                                    <label class="custom-control-label" for="ph">Phone</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-control custom-control-sm custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="vri">
                                                                    <label class="custom-control-label" for="vri">Verified</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-control custom-control-sm custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="st">
                                                                    <label class="custom-control-label" for="st">Status</label>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- .nk-tb-item -->
                                        @if (count($users) > 0)
                                            @foreach($users as $user)
                                                <div class="nk-tb-item">
                                                    <div class="nk-tb-col nk-tb-col-check">
                                                        <div class="custom-control custom-control-sm custom-checkbox notext">
                                                            <input type="checkbox" class="custom-control-input" id="uid1">
                                                            <label class="custom-control-label" for="uid1"></label>
                                                        </div>
                                                    </div>
                                                    <div class="nk-tb-col">
                                                        <a href="#">
                                                            <div class="user-card">
                                                                <div class="user-avatar bg-primary">
                                                                    <span>{{ substr($user->first_name, 0, 1) }}{{ substr($user->last_name, 0, 1) }}</span>
                                                                </div>
                                                                <div class="user-info">
                                                                    <span class="tb-lead">{{ $user->first_name }} {{ $user->last_name }} <span class="dot dot-success d-md-none ms-1"></span></span>
                                                                    <span>{{ $user->email }}</span>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-mb">
                                                        <span class="tb-amount">{{ $user->contact }} </span>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-md">
                                                        <span>{{ $user->poste }}</span>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-md">
                                                        <span>{{ $user->getRoleNames()[0] ?? "-"}}</span>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-lg">
                                                        <ul class="list-status">
                                                            <li> <span>{{ $user->gender }}</span></li>
                                                        </ul>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-lg">
                                                        <span>{{ $user->address ?? "-" }}</span>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-md">
                                                        <span class="tb-status text-{{ $user->statsus == false ? 'success' : 'danger' }}">{{ $user->status == 1 ? 'Actif' : 'Inactif' }}</span>
                                                    </div>
                                                    <div class="nk-tb-col nk-tb-col-tools">
                                                        <ul class="nk-tb-actions gx-1">
                                                            <li>
                                                                <div class="drodown">
                                                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <ul class="link-list-opt no-bdr">
                                                                            <li>
                                                                                <a href="#" wire:click.prevent="suspendUser({{ $user->id }})">
                                                                                    <em class="icon ni ni-na"></em>
                                                                                    <span>{{ $user->status == 0 ? 'Réactiver' : 'Suspendre' }}</span>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#" wire:click.prevent="editUser({{ $user->id }})">
                                                                                    <em class="icon ni ni-edit"></em>
                                                                                    <span>Modifier</span>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#" wire:click.prevent="confirmDelete({{ $user->id }})">
                                                                                    <em class="icon ni ni-trash"></em>
                                                                                    <span>Supprimer</span>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                    <!-- Modal de modification d'un Utilisateur -->
                                                    <div wire:ignore.self class="modal fade" id="modalEditUser">
                                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Mettre à jour un utilisateur</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form {{-- wire:submit.prevent="store" --}}>
                                                                    <div class="modal-body">
                                                                        <div class="container-fluid">
                                                                            <div class="row g-3">

                                                                                <!-- Prénom et Nom -->
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label class="form-label" for="first_name">Nom</label>
                                                                                        <div class="form-control-wrap">
                                                                                            <input type="text" class="form-control @error('first_name') is-invalid @enderror" 
                                                                                                id="first_name" wire:model.defer="first_name" required placeholder="Entrez le nom">
                                                                                            @error('first_name')
                                                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                                            @enderror
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label class="form-label" for="last_name">Prénom</label>
                                                                                        <div class="form-control-wrap">
                                                                                            <input type="text" class="form-control @error('last_name') is-invalid @enderror" 
                                                                                                id="last_name" wire:model.defer="last_name" required placeholder="Entrez le prénom">
                                                                                            @error('last_name')
                                                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                                            @enderror
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <!-- Email et Contact -->
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label class="form-label" for="email">Email</label>
                                                                                        <div class="form-control-wrap">
                                                                                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                                                                                id="email" wire:model.defer="email" required placeholder="Entrez l'email">
                                                                                            @error('email')
                                                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                                            @enderror
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label class="form-label" for="contact">Contact</label>
                                                                                        <div class="form-control-wrap">
                                                                                            <input type="text" class="form-control @error('contact') is-invalid @enderror" 
                                                                                                id="contact" wire:model.defer="contact" placeholder="Entrez le contact">
                                                                                            @error('contact')
                                                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                                            @enderror
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <!-- Poste et Genre -->
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label class="form-label" for="poste">Poste</label>
                                                                                        <div class="form-control-wrap">
                                                                                            <input type="text" class="form-control @error('poste') is-invalid @enderror" 
                                                                                                id="poste" wire:model.defer="poste" placeholder="Entrez le poste">
                                                                                            @error('poste')
                                                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                                            @enderror
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label class="form-label" for="gender">Genre</label>
                                                                                        <div class="form-control-wrap">
                                                                                            <select class="form-select @error('gender') is-invalid @enderror" 
                                                                                                wire:model.defer="gender" id="gender" required>
                                                                                                <option value="">Sélectionner le genre</option>
                                                                                                <option value="Masculin">1. Masculin</option>
                                                                                                <option value="Féminin">2. Féminin</option>
                                                                                            </select>
                                                                                            @error('gender')
                                                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                                            @enderror
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label class="form-label" for="role">Genre</label>
                                                                                        <div class="form-control-wrap">
                                                                                            <select class="form-select @error('role') is-invalid @enderror" 
                                                                                                wire:model.defer="role" id="role" required>
                                                                                                <option>Sélectionnez un profile</option>
                                                                                                @foreach ($roles as $k => $role)
                                                                                                    <option value="{{ $role->name }}">{{ $k+1 }}. {{ $role->name }}</option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                            @error('role')
                                                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                                            @enderror
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <!-- Adresse -->
                                                                                <div class="col-12">
                                                                                    <div class="form-group">
                                                                                        <label class="form-label" for="address">Adresse</label>
                                                                                        <div class="form-control-wrap">
                                                                                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                                                                                id="address" wire:model.defer="address" placeholder="Entrez l'adresse"></textarea>
                                                                                            @error('address')
                                                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                                            @enderror
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer bg-light">
                                                                        <button type="button" wire:click="updateUser" class="btn btn-primary">Mettre à Jour</button>
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div><!-- .nk-tb-item -->
                                            @endforeach
                                        @endif
                                    </div><!-- .nk-tb-list -->
                                </div><!-- .card-inner -->
                                <div class="card-inner">
                                    <div class="nk-block-between-md g-3">
                                        <div class="g">
                                            <ul class="pagination justify-content-center justify-content-md-start">
                                                {{ $users->links() }}
                                            </ul><!-- .pagination -->
                                        </div>
                                    </div><!-- .nk-block-between -->
                                </div><!-- .card-inner -->
                            </div><!-- .card-inner-group -->
                        </div><!-- .card -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>
    <!-- content @e -->
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
                    @this.deleteUser(event.detail.id)
                }
            });
        });

        window.addEventListener('show-modal', event => {
            $('#' + event.detail.modal).modal('show');
        });
        
        window.addEventListener('close-modal', event => {
            $('#modalNewUser').modal('hide');
        });

        window.addEventListener('hide-modal', event => {
            $('#' + event.detail.modal).modal('hide');
        });
    </script>
@endsection