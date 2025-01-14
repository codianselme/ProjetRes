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
        <section id="contact-info" class="py-5 bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 mb-4">
                        <div class="contact-info-box">
                            <i class="fas fa-map-marker-alt mb-3"></i>
                            <h4>Notre Adresse</h4>
                            <p>Fidrossè, 100m à gauche de "Bénin Atlantic Beach Hotel" en allant vers le CEG Fiyegnon</p>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 mb-4">
                        <div class="contact-info-box">
                            <i class="fas fa-phone mb-3"></i>
                            <h4>Téléphones</h4>
                            <p>+229 01 51 61 61 30	<br>
                               +229 01 97 91 82 28</p>
                            <p class="mt-2">WhatsApp: +229 01 90 08 58 07</p>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 mb-4">
                        <div class="contact-info-box">
                            <i class="fas fa-clock mb-3"></i>
                            <h4>Heures d'ouverture</h4>
                            <p>Lundi - Dimanche<br>
                               11h00 - 00h00</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="map-section" class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="section-sub-heading text-center mb-4">Notre Localisation</h3>
                        <div class="map-container">
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=..." 
                                width="100%" 
                                height="450" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </section>

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

                <form class="row position-relative" {{-- wire:click="submit" --}}>
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
                    <div class="form-group col-md-12 mb-4">
                        <textarea wire:model="message" rows="5" class="form-control" placeholder="Écrire un message"></textarea>
                        @error('message') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group col-md-12 mb-3 text-center">
                        <button type="button" wire:click="submit" class="btn link-button">Envoyez-nous un message</button>
                    </div>
                </form>
            </div>
        </section>
    </article>
</div>

<style>
.contact-info-box {
    text-align: center;
    padding: 2rem;
    background: white;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
    height: 100%;
}

.contact-info-box i {
    font-size: 2.5rem;
    color: #your-primary-color;
}

.contact-info-box h4 {
    margin-bottom: 1rem;
    color: #333;
}

.map-container {
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
}
</style>
