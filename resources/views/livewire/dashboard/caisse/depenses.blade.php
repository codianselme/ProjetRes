<div>
    <br><br>
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">

                    <!-- Carte pour le formulaire d'enregistrement de dépense -->
                    <div class="card card-bordered">
                        <div class="card-inner">
                            <h3 class="nk-block-title">Enregistrer une Dépense</h3>
                            <form wire:submit.prevent="store">

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="date">Date</label>
                                            <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" wire:model="date">
                                            @error('date')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="montant">Montant</label>
                                            <input type="number" class="form-control @error('montant') is-invalid @enderror" id="montant" wire:model="montant" min="1">
                                            @error('montant')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nature">Nature</label>
                                            <select class="form-select @error('nature') is-invalid @enderror" id="nature" wire:model="nature">
                                                <option value="">Sélectionnez une nature</option>
                                                <option value="mobile_money">1. Mobile Money</option>
                                                <option value="cash">2. Espèce</option>
                                                {{-- <option value="services">3. Services</option>
                                                <option value="deplacement">4. Déplacement</option>
                                                <option value="autres">5. Autres</option> --}}
                                            </select>
                                            @error('nature')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="motif">Motif</label>
                                    <textarea class="form-control @error('motif') is-invalid @enderror" id="motif" wire:model="motif"></textarea>
                                    @error('motif')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                            </form>
                        </div>
                    </div>

                    <!-- Carte pour la liste des dépenses -->
                    <div class="card card-bordered card-stretch mt-4">
                        <div class="card-inner">
                            <div class="nk-block-head nk-block-head-sm">
                                <div class="nk-block-between">
                                    <div class="nk-block-head-content">
                                        <h3 class="nk-block-title page-title">Liste des Dépenses</h3>
                                        <div class="nk-block-des text-soft">
                                            <p>Vous avez au total {{ $depenses->total() }} dépenses.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="nk-tb-list nk-tb-ulist">
                                <div class="nk-tb-item nk-tb-head">
                                    <div class="nk-tb-col"><span class="sub-text">Auteur</span></div>
                                    <div class="nk-tb-col tb-col-mb"><span class="sub-text">Date</span></div>
                                    <div class="nk-tb-col tb-col-md"><span class="sub-text">Nature</span></div>
                                    <div class="nk-tb-col tb-col-md"><span class="sub-text">Montant</span></div>
                                </div>
                                @foreach($depenses as $depense)
                                    <div class="nk-tb-item">
                                        <div class="nk-tb-col">
                                            <span class="tb-lead">{{ $depense->operateur }}</span>
                                        </div>
                                        <div class="nk-tb-col tb-col-mb">
                                            <span class="tb-lead">{{ $depense->date }}</span>
                                        </div>
                                        <div class="nk-tb-col tb-col-md">
                                            <span class="tb-lead">
                                                @if ($depense->nature == "cash")
                                                    Espèces
                                                @elseif ($depense->nature == "mobile_money")
                                                    Mobile Money
                                                @endif
                                            </span>
                                        </div>
                                        <div class="nk-tb-col tb-col-md">
                                            <span class="tb-lead">{{ number_format($depense->montant, 2) }} FCFA</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="card-inner">
                                <div class="nk-block-between-md g-3">
                                    <div class="g">
                                        {{ $depenses->links() }}
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

@endsection
