<div>
    <br><br>
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">

                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Inscrire une ancienne Ventes</h3>
                                {{-- <div class="nk-block-des text-soft">
                                    <p>Vous avez au total {{ $sales->total() }} ventes enrégistrées.</p>
                                </div> --}}
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->

                    <!-- Nouvelle Vente -->
                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <div class="row g-3">
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <div class="row g-2">
                                                <div class="col-md-6">
                                                    <label class="form-label">Sélectionner un Plat</label>
                                                    <select class="form-select" wire:change="addItem('dish', $event.target.value)">
                                                        <option value="">Sélectionner un plat</option>
                                                        @foreach($categories as $category)
                                                            <optgroup label="{{ $category->name }}">
                                                                @foreach($category->dishes as $dish)
                                                                    <option value="{{ $dish->id }}">{{ $dish->name }} - {{ number_format($dish->price, 0) }} FCFA</option>
                                                                @endforeach
                                                            </optgroup>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Sélectionner une Boisson</label>
                                                    <select class="form-select" wire:change="addItem('drink', $event.target.value)">
                                                        <option value="">Sélectionner une boisson</option>
                                                        @foreach($drinkCategories as $drinkCategory)
                                                            <optgroup label="{{ $drinkCategory->name }}">
                                                                @foreach($drinkCategory->drinks as $drink)
                                                                    <option value="{{ $drink->id }}">{{ $drink->drink_name }} - {{ number_format($drink->unit_price, 0) }} FCFA</option>
                                                                @endforeach
                                                            </optgroup>
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
                                                            <input type="number" class="form-control form-control-sm @error('items.' . $index . '.quantity') is-invalid @enderror" 
                                                                wire:change="updateQuantity({{ $index }}, $event.target.value)"
                                                                value="{{ $item['quantity'] }}" min="1">
                                                            @error('items.' . $index . '.quantity')
                                                                <span class="invalid-feedback">{{ $message }}</span>
                                                            @enderror
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
                                                    <tr>
                                                        <th colspan="3">Reliquat</th>
                                                        <th>{{ $paid_amount - $this->getTotal() }} FCFA</th>
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
                                            <label class="form-label">Date de la Vente</label>
                                            <input type="date" class="form-control" wire:model="sale_date" value="{{ date('Y-m-d') }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Mode de paiement</label>
                                            <select class="form-select" wire:model="payment_method">
                                                <option value="">Sélectionnez un Moyen</option>
                                                <option value="ESPECES">1. Espèce</option>
                                                <option value="MOBILEMONEY">2. Mobile Money</option>
                                                <option value="CHEQUES">3. Chèque</option>
                                                <option value="VIREMENT">4. Virement</option>
                                                <option value="CARTEBANCAIRE">5. Carte Bancaire</option>
                                            </select>
                                            @error('payment_method') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Montant payé</label>
                                            <input type="number" class="form-control @error('paid_amount') is-invalid @enderror" wire:model="paid_amount">
                                            @error('paid_amount') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                        </div>
                                        @if($payment_method == "MOBILEMONEY")
                                            <div class="form-group">
                                                <label class="form-label">Référence de la Transaction Mobile</label>
                                                <input type="text" class="form-control @error('identify_of_mobile_transaction') is-invalid @enderror" wire:model="identify_of_mobile_transaction">
                                                @error('identify_of_mobile_transaction') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                            </div>
                                        @endif
                                        @if($payment_method == "CHEQUES")
                                            <div class="form-group">
                                                <label class="form-label">Nom de la Banque du Chèque</label>
                                                <input type="text" class="form-control @error('name_banque_of_cheque') is-invalid @enderror" wire:model="name_banque_of_cheque">
                                                @error('name_banque_of_cheque') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Référence du Chèque</label>
                                                <input type="text" class="form-control @error('reference_of_cheque') is-invalid @enderror" wire:model="reference_of_cheque">
                                                @error('reference_of_cheque') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                            </div>
                                        @endif
                                        {{-- <div class="form-group">
                                            <label class="form-label">AIB Amount</label>
                                            <select class="form-select" wire:model="aib_amount">
                                                <option value="">Sélectionnez un AIB</option>
                                                <option value="0">1. 0%</option>
                                                <option value="1">2. 1%</option>
                                                <option value="5">3. 5%</option>
                                            </select>
                                            @error('aib_amount') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                        </div> --}}

                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label class="form-label">Nom Complet du Client</label>
                                                <input type="text" class="form-control @error('client_fullname') is-invalid @enderror" wire:model="client_fullname">
                                                @error('client_fullname') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Adresse du Client</label>
                                                <input type="text" class="form-control @error('client_address') is-invalid @enderror" wire:model="client_address">
                                                @error('client_address') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label class="form-label">Téléphone Client</label>
                                                <input type="text" class="form-control @error('phone_client') is-invalid @enderror" wire:model="phone_client">
                                                @error('phone_client') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Client IFU</label>
                                                <input type="text" class="form-control @error('client_ifu') is-invalid @enderror" wire:model="client_ifu">
                                                @error('client_ifu') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="form-label">Notes</label>
                                            <textarea class="form-control" wire:model="notes" rows="2"></textarea>
                                            @error('notes') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                        </div>

                                        <!-- Champs supplémentaires -->
                                        
                                        {{-- <div class="form-group">
                                            <label class="form-label">Tax Group</label>
                                            <input type="text" class="form-control" wire:model="tax_group">
                                        </div> --}}
                                        
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
                    {{-- <div class="nk-block">
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
                                            <th>Normalisé</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($sales as $sale)
                                        
                                            @php
                                                $invoice = App\Models\Invoice::where('invoice_number', $sale->invoice_number)
                                                    ->where("securityElementsDto", "!=", null)
                                                    ->first();
                                            @endphp

                                        <tr>
                                            <td>{{ $sale->invoice_number }}</td>
                                            <td>{{ \Carbon\Carbon::parse($sale->date)->format('d/m/Y H:i:s') }}</td>
                                            {{-- <td>{{ $sale->created_at->format('d/m/Y H:i') }}</td> --}}
                                            {{-- <td>{{ number_format($sale->total_amount, 0) }} FCFA</td>
                                            <td>{{ number_format($sale->paid_amount, 0) }} FCFA</td>
                                            <td>{{ ucfirst( str_replace('_', ' ', $sale->payment_method)) }}</td>
                                            <td>
                                                @if (!empty($invoice->securityElementsDto) && is_array($invoice->securityElementsDto) && isset($invoice->securityElementsDto['nim']) && !empty($invoice->securityElementsDto['nim']))
                                                    <span class="badge bg-success">Oui</span>
                                                @else
                                                    <span class="badge bg-warning">Non</span>
                                                @endif
                                            </td>
                                            <td>

                                                @php
                                                    $invoices_exist = App\Models\Invoice::where('invoice_number', $sale->invoice_number)
                                                        ->where('securityElementsDto', "!=", null)
                                                        ->exists();
                                                @endphp

                                                <div class="drodown">
                                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown">
                                                        <em class="icon ni ni-more-h"></em>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li>
                                                                <button class="btn btn-link" wire:click="showInvoice({{ $sale->id }})">
                                                                    <em class="icon ni ni-eye"></em>
                                                                    <span>Détails Vente</span>
                                                                </button>
                                                            </li>
                                                            <li>
                                                                <button class="btn btn-link" wire:click="genererFacture('{{ $sale->invoice_number }}')">
                                                                    <em class="icon ni ni-edit"></em>
                                                                    <span>{{ $invoices_exist == true ? 'Consulter Facture' : 'Générer Qr Code' }}</span>
                                                                </button>
                                                            </li>
                                                            
                                                            @if (!empty($invoice->securityElementsDto) && is_array($invoice->securityElementsDto) && isset($invoice->securityElementsDto['nim']) && !empty($invoice->securityElementsDto['nim']))
                                                                <li>
                                                                    <button class="btn btn-link" wire:click="confirmAvoirFacture('{{ $sale->invoice_number }}')">
                                                                        <em class="icon ni ni-trash"></em>
                                                                        <span>Annuler Facture</span>
                                                                    </button>
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
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
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Facture -->
    @if($showInvoice && $currentSale)
    <div class="modal fade show" tabindex="-1" style="display: block;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Facture {{ $currentSale->invoice_number }}</h5>
                    <button type="button" class="btn-close" wire:click="$set('showInvoice', false)"></button>
                </div>
                <div class="modal-body bg-light" id="printableArea">
                    <div class="invoice bg-white shadow-sm rounded p-4">
                        <div class="invoice-header text-center mb-4">
                            <h1 class="h5 fw-bold text-primary mb-2">{{ $parametres->type }} {{ $parametres->name }}</h1>
                            <div class="contact-info text-muted">
                                <p class="mb-1">{{ $parametres->address ?? "123 Rue de la Gastronomie, Cotonou, Bénin"}}</p>
                                <p class="mb-1">Tél : {{ $parametres->contact_phone_1 }}</p>
                                <p class="mb-0 text-muted">{{ now()->format('d/m/Y à H:i:s') }}</p>
                            </div>
                        </div>

                        <div class="invoice-details row mb-4">
                            <div class="col-6">
                                <small class="text-muted">Date : {{ $currentSale->created_at->format('d/m/Y à H:i:s') }} </small>
                            </div>
                            <div class="col-6 text-end">
                                <small class="text-muted">Caissière : {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</small>
                            </div>
                        </div>

                        <div class="invoice-items">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 50%">Article</th>
                                        <th style="width: 10%" class="text-center">Qte</th>
                                        <th style="width: 25%" class="text-end">Prix unitaire</th>
                                        <th style="width: 15%" class="text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($currentSale->items as $item)
                                    <tr>
                                        <td>{{ $item->itemable->name ?? $item->itemable->drink_name }}</td>
                                        <td class="text-center">{{ $item->quantity }}</td>
                                        <td class="text-end">{{ number_format($item->unit_price, 0, ',', ' ') }}</td>
                                        <td class="text-end">{{ number_format($item->total_price, 0, ',', ' ') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="table-active">
                                        <th colspan="2" class="text-end">{{-- Total --}}</th>
                                        <th colspan="2" class="text-end">{{ number_format($currentSale->total_amount, 0, ',', ' ') }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        {{-- <div class="qr-code-section text-center mb-4">
                            <img 
                                src="{{ asset('https://fiches-pratiques.e-marketing.fr/Assets/Img/FICHEPRATIQUE/2021/10/365359/Comment-generer-facilement-code--F.jpg') }}" 
                                alt="QR Code" 
                                class="img-fluid rounded shadow" 
                                style="max-width: 120px;"
                            >
                        </div> --}}

                        {{-- <div class="invoice-footer text-center mt-4">
                            <small class="text-muted">Merci pour votre visite</small>
                        </div> --}}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="$set('showInvoice', false)">Fermer</button>
                    <button type="button" class="btn btn-primary" onclick="printDiv('printableArea')">Imprimer</button>
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

    window.addEventListener('swal:confirm', event => {
        Swal.fire({
            title: event.detail.title,
            text: event.detail.text,
            icon: event.detail.icon,
            showCancelButton: true,
            confirmButtonText: event.detail.confirmButtonText,
            cancelButtonText: event.detail.cancelButtonText,
        }).then((result) => {
            if (result.isConfirmed) {
                @this.avoirFacture(event.detail.invoiceNumber);
            }
        });
    });

    function printDiv(divId) {
        var printContents = document.getElementById(divId).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>
@endsection
