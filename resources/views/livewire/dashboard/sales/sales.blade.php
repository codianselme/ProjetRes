<div>
    <br><br>
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <!-- Nouvelle Vente -->
                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <div class="row g-3">
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <label class="form-label">Articles</label>
                                            <div class="row g-2">
                                                <div class="col-md-6">
                                                    <select class="form-select" wire:change="addItem('dish', $event.target.value)">
                                                        <option value="">Sélectionner un plat</option>
                                                        @foreach($dishes as $dish)
                                                            <option value="{{ $dish->id }}">{{ $dish->name }} - {{ number_format($dish->price, 0) }} FCFA</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <select class="form-select" wire:change="addItem('drink', $event.target.value)">
                                                        <option value="">Sélectionner une boisson</option>
                                                        @foreach($drinks as $drink)
                                                            <option value="{{ $drink->id }}">{{ $drink->drink_name }} - {{ number_format($drink->unit_price, 0) }} FCFA</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Article</th>
                                                        <th>Prix unitaire</th>
                                                        <th>Quantité</th>
                                                        <th>Total</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($items as $index => $item)
                                                    <tr>
                                                        <td>{{ $item['name'] }}</td>
                                                        <td>{{ number_format($item['price'], 0) }} FCFA</td>
                                                        <td>
                                                            <input type="number" class="form-control form-control-sm" 
                                                                wire:change="updateQuantity({{ $index }}, $event.target.value)"
                                                                value="{{ $item['quantity'] }}" min="1">
                                                        </td>
                                                        <td>{{ number_format($item['total'], 0) }} FCFA</td>
                                                        <td>
                                                            <button class="btn btn-icon btn-sm btn-danger" wire:click="removeItem({{ $index }})">
                                                                <em class="icon ni ni-trash"></em>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="3">Total</th>
                                                        <th>{{ number_format($this->getTotal(), 0) }} FCFA</th>
                                                        <th></th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label">N° Facture</label>
                                            <input type="text" class="form-control" value="{{ $invoice_number }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Mode de paiement</label>
                                            <select class="form-select" wire:model="payment_method">
                                                <option value="cash">Espèces</option>
                                                <option value="card">Carte bancaire</option>
                                                <option value="mobile_money">Mobile Money</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Montant payé</label>
                                            <input type="number" class="form-control" wire:model="paid_amount">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Notes</label>
                                            <textarea class="form-control" wire:model="notes" rows="2"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary btn-block" wire:click="saveSale">
                                                Enregistrer la vente
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Liste des Ventes -->
                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <div class="card-title-group">
                                    <div class="card-title">
                                        <h5 class="title">Historique des Ventes</h5>
                                    </div>
                                    <div class="card-tools">
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" wire:model="searchTerm" placeholder="Rechercher...">
                                        </div>
                                    </div>
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>N° Facture</th>
                                            <th>Date</th>
                                            <th>Total</th>
                                            <th>Payé</th>
                                            <th>Mode</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($sales as $sale)
                                        <tr>
                                            <td>{{ $sale->invoice_number }}</td>
                                            <td>{{ $sale->created_at->format('d/m/Y H:i') }}</td>
                                            <td>{{ number_format($sale->total_amount, 0) }} FCFA</td>
                                            <td>{{ number_format($sale->paid_amount, 0) }} FCFA</td>
                                            <td>{{ $sale->payment_method }}</td>
                                            <td>
                                                <button class="btn btn-icon btn-sm btn-primary" wire:click="showInvoice({{ $sale->id }})">
                                                    <em class="icon ni ni-file-text"></em>
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
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Facture -->
    @if($showInvoice && $currentSale)
    <div class="modal fade show" tabindex="-1" style="display: block;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Facture {{ $currentSale->invoice_number }}</h5>
                    <button type="button" class="btn-close" wire:click="$set('showInvoice', false)"></button>
                </div>
                <div class="modal-body">
                    <!-- Contenu de la facture -->
                    <div class="invoice">
                        <div class="invoice-head">
                            <h3>Restaurant XYZ</h3>
                            <p>Date: {{ $currentSale->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Article</th>
                                    <th>Quantité</th>
                                    <th>Prix unitaire</th>
                                    <th>Total</th>
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
                            <tfoot>
                                <tr>
                                    <th colspan="3">Total</th>
                                    <th>{{ number_format($currentSale->total_amount, 0) }} FCFA</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="$set('showInvoice', false)">Fermer</button>
                    <button type="button" class="btn btn-primary" onclick="window.print()">Imprimer</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
    @endif
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