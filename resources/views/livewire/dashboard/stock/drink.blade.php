<div>
    <br><br>
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Stock des Boissons</h3>
                                <div class="nk-block-des text-soft">
                                    <p>Vue d'ensemble du stock actuel</p>
                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu">
                                        <em class="icon ni ni-more-v"></em>
                                    </a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            {{-- <li>
                                                <div class="form-control-wrap">
                                                    <select class="form-select" wire:model="filterCategory">
                                                        <option value="">Toutes les catégories</option>
                                                        @foreach($categories as $category)
                                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </li> --}}
                                            <li>
                                                <div class="form-control-wrap">
                                                    <div class="form-icon form-icon-right">
                                                        <em class="icon ni ni-search"></em>
                                                    </div>
                                                    <input type="text" class="form-control" wire:model="searchTerm" placeholder="Rechercher une boisson...">
                                                </div>
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
                                            <div class="nk-tb-col"><span class="sub-text">Nom de la Boisson</span></div>
                                            <div class="nk-tb-col tb-col-mb"><span class="sub-text">Catégorie de la Boisson</span></div>
                                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Stock Actuel</span></div>
                                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Prix Unitaire</span></div>
                                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Coût Total</span></div>
                                        </div>

                                        @foreach($stocks as $stock)
                                        <div class="nk-tb-item">
                                            <div class="nk-tb-col">
                                                <span class="tb-lead">{{ $stock->drink_name }}</span>
                                            </div>
                                            <div class="nk-tb-col tb-col-mb">
                                                <span>{{ \App\Models\DrinkSupply::where("drink_name", $stock->drink_name)->first()->category->name ?? "-" }}</span>
                                            </div>
                                            <div class="nk-tb-col tb-col-md">
                                                <span class="tb-amount">{{ number_format($stock->total_quantity, 0, ',', ' ') }}</span>
                                            </div>
                                            <div class="nk-tb-col tb-col-md">
                                                <span>{{ number_format($stock->unit_price, 0, ',', ' ') }}</span>
                                            </div>
                                            <div class="nk-tb-col tb-col-md">
                                                <span>{{ number_format($stock->total_quantity * $stock->unit_price, 0, ',', ' ') }} FCFA</span>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="card-inner">
                                    <div class="nk-block-between-md g-3">
                                        <div class="g">
                                            <ul class="pagination justify-content-center justify-content-md-start">
                                                {{ $stocks->links() }}
                                            </ul><!-- .pagination -->
                                        </div>
                                    </div><!-- .nk-block-between -->
                                </div><!-- .card-inner -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
