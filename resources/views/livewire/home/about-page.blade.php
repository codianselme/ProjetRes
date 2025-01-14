<div>
    <article id="main-content">
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h2 class="section-sub-heading">À propos</h2>
                        <nav aria-label="breadcrumb" class="breadcrumb-nav">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home.page') }}">Accueil</a></li>
                                <li class="breadcrumb-item active" aria-current="page">À propos</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <h3 class="mb-4">Notre Histoire</h3>
                        <p>
                            Bienvenue au bar restaurant les saveurs du corridor, une destination culinaire unique où la tradition africaine rencontre l'innovation gastronomique. Fondé en 2024, notre établissement s'est donné pour mission de faire découvrir les saveurs authentiques de la cuisine béninoise et ouest-africaine dans un cadre moderne et chaleureux.
                        </p>
                        
                        <p>
                            Notre passion pour la gastronomie et notre engagement envers l'excellence nous poussent à sélectionner minutieusement les meilleurs ingrédients locaux pour créer des plats qui racontent une histoire, notre histoire.
                        </p>
                    </div>
                    
                    <div class="col-lg-6 mb-4">
                        <div class="gallery-container">
                            <!-- Image principale -->
                            <div class="main-image">
                                <img src="{{ asset('home/restaurant_images/img2.png') }}" alt="Notre Restaurant" class="img-fluid rounded" id="mainImage">
                            </div>
                            
                            <!-- Galerie miniature -->
                            <div class="thumbnail-gallery">
                                {{-- <div class="thumbnail active">
                                    <img src="{{ asset('home/restaurant_images/img1.jpg') }}" alt="Restaurant Vue 1" onclick="changeImage(this.src)">
                                </div> --}}
                                <div class="thumbnail">
                                    <img src="{{ asset('home/restaurant_images/img2.png') }}" alt="Restaurant Vue 2" onclick="changeImage(this.src)">
                                </div>
                                <div class="thumbnail">
                                    <img src="{{ asset('home/restaurant_images/img3.jpeg') }}" alt="Restaurant Vue 3" onclick="changeImage(this.src)">
                                </div>
                                <div class="thumbnail">
                                    <img src="{{ asset('home/restaurant_images/img4.jpeg') }}" alt="Restaurant Vue 4" onclick="changeImage(this.src)">
                                </div>
                                <div class="thumbnail active">
                                    <img src="{{ asset('home/restaurant_images/img5.jpeg') }}" alt="Restaurant Vue 5" onclick="changeImage(this.src)">
                                </div>
                                <div class="thumbnail">
                                    <img src="{{ asset('home/restaurant_images/img6.jpeg') }}" alt="Restaurant Vue 6" onclick="changeImage(this.src)">
                                </div>
                                <div class="thumbnail">
                                    <img src="{{ asset('home/restaurant_images/img7.jpeg') }}" alt="Restaurant Vue 7" onclick="changeImage(this.src)">
                                </div>
                                <div class="thumbnail">
                                    <img src="{{ asset('home/restaurant_images/img8.jpeg') }}" alt="Restaurant Vue 8" onclick="changeImage(this.src)">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-12 mb-5">
                        <h3 class="mb-4">Notre Philosophie</h3>
                        <p>Nous croyons que chaque repas devrait être une expérience mémorable. Notre philosophie repose sur trois piliers fondamentaux :</p>
                        <ul class="list-unstyled">
                            <li class="mb-3"><strong>🌟 Qualité Exceptionnelle</strong> - Nous ne compromettons jamais la qualité de nos ingrédients et de notre service.</li>
                            <li class="mb-3"><strong>🌍 Authenticité</strong> - Nos recettes respectent les traditions culinaires tout en y apportant une touche de modernité.</li>
                            <li class="mb-3"><strong>💝 Hospitalité</strong> - Nous accueillons chaque client comme un membre de notre famille.</li>
                        </ul>
                    </div>

                    <div class="col-lg-12 mb-5">
                        <h3 class="mb-4">Notre Équipe</h3>
                        <p>Notre équipe passionnée, dirigée par le Chef [Nom], combine expertise technique et créativité pour vous offrir une expérience culinaire inoubliable. De la cuisine au service en salle, chaque membre de notre équipe partage le même engagement envers l'excellence et la satisfaction de nos clients.</p>
                    </div>

                    <div class="col-lg-12">
                        <h3 class="mb-4">Notre Engagement</h3>
                        <p>Au-delà de la simple restauration, nous nous engageons à :</p>
                        <ul class="list-unstyled">
                            <li class="mb-3">✅ Soutenir les producteurs locaux</li>
                            <li class="mb-3">✅ Minimiser notre impact environnemental</li>
                            <li class="mb-3">✅ Promouvoir la richesse de la cuisine africaine</li>
                            <li class="mb-3">✅ Offrir un service personnalisé et attentionné</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </article>
</div>

<!-- Ajoutez ces styles CSS -->
<style>
    .gallery-container {
        position: relative;
    }

    .main-image {
        margin-bottom: 15px;
        overflow: hidden;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .main-image img {
        width: 100%;
        height: 400px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .main-image:hover img {
        transform: scale(1.05);
    }

    .thumbnail-gallery {
        display: flex;
        gap: 10px;
        overflow-x: auto;
        padding: 10px 0;
    }

    .thumbnail {
        flex: 0 0 auto;
        width: 80px;
        height: 80px;
        border-radius: 6px;
        overflow: hidden;
        cursor: pointer;
        opacity: 0.7;
        transition: all 0.3s ease;
    }

    .thumbnail.active {
        opacity: 1;
        border: 2px solid #2c3e50;
    }

    .thumbnail:hover {
        opacity: 1;
    }

    .thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Pour masquer la scrollbar tout en gardant la fonction de défilement */
    .thumbnail-gallery::-webkit-scrollbar {
        height: 6px;
    }

    .thumbnail-gallery::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
    }

    .thumbnail-gallery::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 3px;
    }

    .thumbnail-gallery::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>

<!-- Ajoutez ce script JavaScript -->
<script>
function changeImage(src) {
    const mainImage = document.getElementById('mainImage');
    mainImage.style.opacity = '0';
    
    setTimeout(() => {
        mainImage.src = src;
        mainImage.style.opacity = '1';
    }, 200);

    // Mise à jour de la miniature active
    document.querySelectorAll('.thumbnail').forEach(thumb => {
        thumb.classList.remove('active');
        if(thumb.querySelector('img').src === src) {
            thumb.classList.add('active');
        }
    });
}

// Animation de transition pour l'image principale
document.getElementById('mainImage').style.transition = 'opacity 0.2s ease';
</script>
