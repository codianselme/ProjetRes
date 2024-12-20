<div>
    <br><br>
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block">
                        <!-- Carte pour Préparer une Commande -->
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <h5 class="title">Préparer une Commande</h5>
                                <br>

                                @if (session()->has('message'))
                                    <div class="alert alert-success mt-3">{{ session('message') }}</div>
                                @endif
                                
                                <form wire:submit.prevent="prepareOrder">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="order_id" class="form-label">Sélectionner une commande</label>
                                            <select id="order_id" class="form-select" wire:model="order_id">
                                                <option value="">Sélectionner une commande</option>
                                                @foreach($orders as $k => $order)
                                                    <option value="{{ $order->id }}">{{ $k + 1 }}. {{ $order->dish->name }} - {{ $order->quantity > 1 ? $order->quantity . " Plats" : $order->quantity . ' Plat' }}</option>
                                                @endforeach
                                            </select>
                                            @error('order_id') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="quantity_used" class="form-label">Quantité de Plat</label>
                                            <input type="number" id="quantity_used" class="form-control" wire:model="quantity_used" placeholder="Quantité utilisée" min="1">
                                            @error('quantity_used') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="row" id="ingredients-container">
                                            <div class="col-md-6">
                                                <label for="selected_ingredient_id" class="form-label">Ingrédients utilisés</label>
                                                <select id="selected_ingredient_id" class="form-select" wire:model="selected_ingredient_id">
                                                    <option value="">Sélectionner un ingrédient</option>
                                                    @foreach($food_supplies as $l => $supply)
                                                        <option value="{{ $supply->id }}">{{ $l + 1 }}. {{ $supply->food_name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('selected_ingredient_id') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="col-md-3">
                                                <label for="quantity_used" class="form-label">Quantité</label>
                                                <input type="number" class="form-control" wire:model="ingredient_quantity" placeholder="Quantité" min="1">
                                                @error('ingredient_quantity') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            
                                            <div class="col-md-3">
                                                <label for="quantity_used" class="form-label">Unité</label>
                                                <select class="form-select" wire:model="selected_unit">
                                                    <option value="">Sélectionner une unité</option>
                                                    @foreach($units as $m => $unit)
                                                        <option value="{{ $unit }}">{{ $m + 1 }}. {{ $unit }}</option>
                                                    @endforeach
                                                </select>
                                                @error('selected_unit') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>

                                        <br>
                                        <button type="button" class="btn btn-secondary mt-2 float-end" wire:click="addIngredient">Ajouter Ingrédient</button>
                                    </div>
                                </div>
                            </div>

                        <!-- Carte pour Ingrédients ajoutés -->
                        <div class="card card-bordered mt-4">
                            <div class="card-inner">
                                    <div class="mb-3">
                                        <h6>Ingrédients ajoutés :</h6>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nom de l'ingrédient</th>
                                                    <th>Quantité</th>
                                                    <th>Unité</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($ingredients as $index => $ingredient)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $ingredient['name'] }}</td>
                                                        <td>{{ $ingredient['quantity'] }}</td>
                                                        <td>{{ $ingredient['unit'] }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <br><br>
                                    <button type="submit" class="btn btn-success float-end">Préparer Commande</button>
                                </form>
                            </div>
                        </div>

                        <!-- Carte pour Liste des Plats et Détails -->
                        <div class="card card-bordered mt-4">
                            <div class="card-inner">
                                <h5 class="mt-5">Liste des Plats et Détails</h5>
                                <table class="table mt-3">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Plat</th>
                                            <th>Détails des Ingrédients</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($preparations as $index => $preparation)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $preparation->order->dish->name }}</td>
                                                <td>
                                                    <table class="table">
                                                        <thead>
                                                            @if($preparation->ingredientsUtilises && $preparation->ingredientsUtilises->isNotEmpty())
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Nom de l'ingrédient</th>
                                                                    <th>Quantité</th>
                                                                    <th>Unité</th>
                                                                </tr>
                                                            @endif
                                                        </thead>
                                                        <tbody>
                                                            @if($preparation->ingredientsUtilises && $preparation->ingredientsUtilises->isNotEmpty())
                                                                @foreach($preparation->ingredientsUtilises as $index => $ingredient)
                                                                    <tr>
                                                                        <td>{{ $index + 1 }}</td>
                                                                        <td>{{ $ingredient->ingredient_name }}</td>
                                                                        <td>{{ $ingredient->quantity }}</td>
                                                                        <td>{{ $ingredient->unit }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            @else
                                                                <tr>
                                                                    <td colspan="4">Aucun ingrédient disponible</td>
                                                                </tr>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </td>
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
