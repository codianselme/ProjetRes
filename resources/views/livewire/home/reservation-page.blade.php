<div>
    <article id="main-content">
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h2 class="section-sub-heading">Réservation</h2>
                        <nav aria-label="breadcrumb" class="breadcrumb-nav">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home.page') }}">Accueil</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Réservation</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <section id="reservation-form" class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h3 class="section-heading text-center">Réserver une table</h3>
                        <h4 class="section-sub-heading text-center">Faites une réservation</h4>

                        @if (session()->has('success'))
                            <div class="alert alert-success mt-3">{{ session('success') }}</div>
                        @endif

                        <form class="row bg-white position-relative p-4" wire:submit.prevent="submit">
                            <div class="form-group col-md-6 mb-4">
                                <label class="form-label">Nom complet</label>
                                <input type="text" class="form-control" wire:model="customer_name" placeholder="Votre nom complet" required>
                                @error('customer_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group col-md-6 mb-4">
                                <label class="form-label">Téléphone</label>
                                <input type="tel" class="form-control" wire:model="phone" placeholder="Votre numéro de téléphone" required>
                                @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group col-md-6 mb-4">
                                <label class="form-label">Email (optionnel)</label>
                                <input type="email" class="form-control" wire:model="email" placeholder="Votre email">
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group col-md-6 mb-4">
                                <label class="form-label">Nombre de personnes</label>
                                <input type="number" class="form-control" wire:model="persons" placeholder="Nombre de personnes" required>
                                @error('persons') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group col-md-6 mb-4">
                                <label class="form-label">Date</label>
                                <input type="date" class="form-control" wire:model="date" required>
                                @error('date') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group col-md-6 mb-4">
                                <label class="form-label">Heure</label>
                                <input type="time" class="form-control" wire:model="time" required>
                                @error('time') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group col-12 mb-4">
                                <label class="form-label">Demandes spéciales (optionnel)</label>
                                <textarea class="form-control" wire:model="special_requests" rows="3" placeholder="Vos demandes spéciales"></textarea>
                                @error('special_requests') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group col-md-12 text-center">
                                <button type="submit" class="btn link-button">Réserver maintenant</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <div class="available-tables py-5 position-relative">
            <!-- Tables disponibles -->
        </div>
    </article>
</div>