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
                                <h5 class="title">Passer des Commandes</h5>
                                <br><br>

                                <form wire:submit.prevent="createOrders">
                                    @if (count($orders) > 0)
                                        @foreach($orders as $index => $order)
                                            <div class="row g-3 mb-3">
                                                <div class="col-md-6">
                                                    <select class="form-select" wire:model="orders.{{ $index }}.dish_id">
                                                        <option value="">Sélectionner un plat</option>
                                                        @foreach($dishes as $dish)
                                                            <option value="{{ $dish->id }}">{{ $dish->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('orders.'.$index.'.dish_id') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="number" class="form-control" wire:model="orders.{{ $index }}.quantity" placeholder="Quantité" min="1">
                                                    @error('orders.'.$index.'.quantity') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button" class="btn btn-danger" wire:click="removeOrder({{ $index }})">Supprimer</button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="alert alert-danger">Veuillez ajouter des commandes</div>
                                    @endif
                                    

                                    <div class="mb-3 d-flex justify-content-between">
                                        <button type="button" class="btn btn-primary" wire:click="addOrder">Ajouter une Commande</button>
                                        <button type="submit" class="btn btn-success">Créer Commandes</button>
                                    </div>
                                </form>

                                @if (session()->has('message'))
                                    <div class="alert alert-success">{{ session('message') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Liste des Ventes -->
                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <div class="card-title-group">
                                    <div class="card-title">
                                        <h5 class="title">Commandes en Attente</h5>
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
                                            <th>#</th>
                                            <th>Date de la commande</th>
                                            <th>Plat Commandé</th>
                                            <th>Quantité</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pendingOrders as $index => $order)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                            <td>{{ $order->dish->name }}</td>
                                            <td>{{ number_format($order->quantity, 0) }} Plat(s)</td>
                                            <td>{{ $order->status }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>








