<div>
    <article id="main-content">
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h2 class="section-sub-heading">Contact</h2>
                        <nav aria-label="breadcrumb" class="breadcrumb-nav">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home.page') }}">Accueil</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Contact</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <section id="contact-form" class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h2 class="section-heading text-center">Message</h2>
                        <h3 class="section-sub-heading text-center">Envoyez-nous un message</h3>
                    </div>
                </div>

                @if (session()->has('success'))
                    <div class="alert alert-success mt-3">{{ session('success') }}</div>
                @endif

                <form class="row position-relative" wire:click="submit">
                    <div class="form-group col-md-12 mb-4">
                        <input type="text" class="form-control" wire:model="name" placeholder="Nom Complet">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group col-md-6 mb-4">
                        <input type="email" class="form-control" wire:model="email" placeholder="Adresse e-mail">
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group col-md-6 mb-4">
                        <input type="number" class="form-control" wire:model="phone" placeholder="Numéro de téléphone">
                        @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    {{-- <div class="form-group col-md-6 mb-4">
                        <input type="text" class="form-control" wire:model="website" placeholder="Site web">
                        @error('website') <span class="text-danger">{{ $message }}</span> @enderror
                    </div> --}}
                    <div class="form-group col-md-12 mb-4">
                        <textarea wire:model="message" rows="5" class="form-control" placeholder="Écrire un message"></textarea>
                        @error('message') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group col-md-12 mb-3 text-center">
                        <button type="submit" class="btn link-button">Envoyez-nous un message</button>
                    </div>
                </form>
            </div>
        </section>
    </article>
</div>
