<div>
    <br><br>
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Rapport des Ventes</h3>
                            </div>
                            <div class="nk-block-head-content">
                                <button class="btn btn-primary" wire:click="exportPDF">Exporter en PDF</button>
                                <button class="btn btn-success" wire:click="exportExcel">Exporter en Excel</button>
                                <button class="btn btn-info" wire:click="exportTXT">Exporter en TXT</button>
                            </div>
                        </div>
                    </div>

                    <!-- Filtres -->
                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <div class="row g-3 align-center">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="form-label">Date de début</label>
                                            <input type="date" class="form-control" wire:model="startDate">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="form-label">Date de fin</label>
                                            <input type="date" class="form-control" wire:model="endDate">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="form-label">Rechercher</label>
                                            <input type="text" class="form-control" wire:model.debounce.300ms="searchTerm" placeholder="Rechercher par numéro de facture...">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Résumé -->
                    <div class="nk-block">
                        <div class="row g-gs">
                            <div class="col-xxl-3 col-sm-6">
                                <div class="card">
                                    <div class="nk-ecwg nk-ecwg6">
                                        <div class="card-inner">
                                            <div class="card-title-group">
                                                <div class="card-title">
                                                    <h6 class="title">Total Ventes</h6>
                                                </div>
                                            </div>
                                            <div class="data">
                                                <div class="data-group">
                                                    <div class="amount">{{ $sales->total() }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-sm-6">
                                <div class="card">
                                    <div class="nk-ecwg nk-ecwg6">
                                        <div class="card-inner">
                                            <div class="card-title-group">
                                                <div class="card-title">
                                                    <h6 class="title">Montant Total</h6>
                                                </div>
                                            </div>
                                            <div class="data">
                                                <div class="data-group">
                                                    <div class="amount">{{ number_format($sales->sum('total_amount'), 0) }} FCFA</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Détails des ventes -->
                    @if($sales->count() > 0)
                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Numéro de Facture</th>
                                            <th>Date</th>
                                            <th>Montant Total</th>
                                            <th>Montant Payé</th>
                                            <th>Méthode de Paiement</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($sales as $sale)
                                        <tr>
                                            <td>{{ $sale->invoice_number }}</td>
                                            <td>{{ $sale->created_at->format('d/m/Y') }}</td>
                                            <td>{{ number_format($sale->total_amount, 0) }} FCFA</td>
                                            <td>{{ number_format($sale->paid_amount, 0) }} FCFA</td>
                                            <td>{{ ucfirst($sale->payment_method) }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-info" wire:click="showInvoice({{ $sale->id }})">
                                                    <em class="icon ni ni-eye"></em>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-3">
                                    {{ $sales->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Modal Détails de la Vente -->
                    @if($showInvoice && $currentSale)
                    <div class="modal fade show" tabindex="-1" style="display: block;">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Détails de la Vente - {{ $currentSale->invoice_number }}</h5>
                                    <button type="button" class="btn-close" wire:click="closeInvoice"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><strong>Date:</strong> {{ $currentSale->created_at->format('d/m/Y') }}</p>
                                            <p><strong>Montant Total:</strong> {{ number_format($currentSale->total_amount, 0) }} FCFA</p>
                                            <p><strong>Montant Payé:</strong> {{ number_format($currentSale->paid_amount, 0) }} FCFA</p>
                                            <p><strong>Méthode de Paiement:</strong> {{ ucfirst($currentSale->payment_method) }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong>Notes:</strong> {{ $currentSale->notes }}</p>
                                        </div>
                                    </div>

                                    <br><br>
                                    <h5>Articles de la Vente</h5>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Article</th>
                                                <th>Quantité</th>
                                                <th>Prix Unitaire</th>
                                                <th>Prix Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($currentSale->items as $item)
                                            <tr>
                                                <td>{{ $item->itemable->name ?? $item->itemable->drink_name }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ number_format($item->unit_price, 0) }} FCFA</td>
                                                <td>{{ number_format($item->total_price, 0) }} FCFA</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" wire:click="closeInvoice">Fermer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-backdrop fade show"></div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@section('js')
<script>
    window.addEventListener('swal:success', event => {
        Swal.fire({
            title: event.detail.title,
            text: event.detail.text,
            icon: 'success',
        });
    });

    window.addEventListener('swal:error', event => {
        Swal.fire({
            title: event.detail.title,
            text: event.detail.text,
            icon: 'error',
        });
    });
</script>
@endsection
