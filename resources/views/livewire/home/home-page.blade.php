<div>

    <style>
        .menu-box {
            display: block;
            position: relative;
            margin-bottom: 20px;
            overflow: hidden;
        }

        .menu-box img {
            width: 100%;
            height: 250px; /* Hauteur fixe pour toutes les images */
            object-fit: cover; /* Garde les proportions en couvrant la zone */
            object-position: center; /* Centre l'image */
            transition: transform 0.3s ease; /* Animation au survol optionnelle */
        }

        /* Effet de zoom au survol (optionnel) */
        .menu-box:hover img {
            transform: scale(1.05);
        }

        /* Style pour le titre */
        .menu-box h4 {
            margin-top: 10px;
            text-align: center;
        }


        .category-box img {
            width: 100%;
            height: 250px; /* Hauteur fixe pour toutes les images */
            object-fit: cover; /* Garde les proportions en couvrant la zone */
            object-position: center; /* Centre l'image */
        }

        const swiper = new Swiper('.swiper', {
            // Autoplay toutes les 1 secondes
            autoplay: {
                delay: 1000, // Délai en millisecondes
                disableOnInteraction: false, // Continue l'autoplay même après interaction utilisateur
            },
            
            // Options additionnelles recommandées
            loop: true, // Boucle infinie
            effect: 'fade', // Effet de transition en fondu (optionnel)
            speed: 1000, // Vitesse de transition en millisecondes
            
            // Pagination (optionnel)
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            
            // Navigation buttons (optionnel)
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
        
    </style>

    <section id="banner-section">
        <div class="swiper">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                {{-- <div class="swiper-slide" style="background-image: url('{{ asset('home/banners/banner2.png') }}');"> --}}
                <div class="swiper-slide" style="background-image: url('{{ asset('home/banners/img1.png') }}');">
                    <div class="row">
                        <div class="col-6">
                            <h1>Nous ne cuisinons pas, nous créons vos émotions !</h1>
                            <span class="d-block mb-4">Découvrez une expérience culinaire unique qui vous fera vivre des émotions inoubliables.</span>
                        </div>
                    </div>
                </div>
                {{-- <div class="swiper-slide" style="background-image: url('{{ asset('home/banners/banner1.png') }}');"> --}}
                <div class="swiper-slide" style="background-image: url('{{ asset('home/banners/img2.png') }}');">
                    <div class="row">
                        <div class="col-6">
                            <h1>Créer votre expérience culinaire exceptionnelle</h1>
                            <span class="d-block mb-4">Découvrez une expérience culinaire unique qui vous fera vivre des émotions inoubliables.</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Pagination -->
            <div class="swiper-pagination"></div>
            
            <!-- Navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </section>

    <section id="category-section" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="section-heading">Nos plats populaires</h2>
                    <h3 class="section-sub-heading">Notre catégorie</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 h-100">
                    <div class="category-box">
                        <img src="{{ asset('home/pub/a9.jpeg') }}" alt="image name">
                        <div class="content d-flex flex-row justify-content-between">
                            <h4 class="align-self-center m-0"><a href="{{ route('details.menu.page', ['slug' => 'igname_pilee_sauce_claire_togo']) }}">Igname Pilée & Sauce Claire du Togo</a></h4>
                            <a href="{{ route('details.menu.page', ['slug' => 'igname_pilee_sauce_claire_togo']) }}" class="read-more"><i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 h-100">
                    <div class="category-box">
                        <img src="{{ asset('home/pub/d0/3.png') }}" alt="image name">
                        <div class="content d-flex flex-row justify-content-between">
                            <h4 class="align-self-center m-0"><a href="{{ route('details.menu.page', ['slug' => 'le_riz']) }}">Poisson & Poulet Braisé</a></h4>
                            <a href="{{ route('details.menu.page', ['slug' => 'le_riz']) }}" class="read-more"><i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 h-100">
                    <div class="category-box">
                        <img src="{{ asset('home/pub/9.jpeg') }}" alt="image name">
                        <div class="content d-flex flex-row justify-content-between">
                            <h4 class="align-self-center m-0"><a href="{{ route('details.menu.page', ['slug' => 'nos_sauces']) }}">Nos sauces</a></h4>{{-- Burger --}}
                            <a href="{{ route('details.menu.page', ['slug' => 'nos_sauces']) }}" class="read-more"><i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 h-100">
                    <div class="category-box">
                        <img src="{{ asset('home/pub/u.jpeg') }}" alt="image name">
                        <div class="content d-flex flex-row justify-content-between">
                            <h4 class="align-self-center m-0"><a href="{{ route('details.menu.page', ['slug' => 'fast_food']) }}">Fast Food</a></h4>
                            <a href="{{ route('details.menu.page', ['slug' => 'fast_food']) }}" class="read-more"><i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 h-100">
                    <div class="category-box">
                        <img src="{{ asset('home/pub/w.jpeg') }}" alt="image name">
                        <div class="content d-flex flex-row justify-content-between">
                            <h4 class="align-self-center m-0"><a href="{{ route('details.menu.page', ['slug' => 'coocktail']) }}">Coocktail</a></h4>
                            <a href="{{ route('details.menu.page', ['slug' => 'coocktail']) }}" class="read-more"><i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 h-100">
                    <div class="category-box">
                        <img src="{{ asset('home/pub/6.jpeg') }}" alt="image name">
                        <div class="content d-flex flex-row justify-content-between">
                            <h4 class="align-self-center m-0"><a href="{{ route('details.menu.page', ['slug' => 'autres']) }}">Autres</a></h4>
                            <a href="{{ route('details.menu.page', ['slug' => 'autres']) }}" class="read-more"><i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="category-section" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="section-heading">Notre Menu 2</h2>
                    <h3 class="section-sub-heading">Nos catégories 2</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 h-100">
                    <div class="category-box">
                        <img src="{{ asset('home/pub/a90.jpeg') }}" alt="Igname Pilée">
                        <div class="content d-flex flex-row justify-content-between">
                            <h4 class="align-self-center m-0">
                                <a href="{{ route('details.menu.page', ['slug' => 'igname_pilee']) }}">Igname Pilée</a>
                            </h4>
                            <a href="{{ route('details.menu.page', ['slug' => 'igname_pilee']) }}" class="read-more">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 h-100">
                    <div class="category-box">
                        <img src="{{ asset('home/pub/90.jpeg') }}" alt="Sauces">
                        <div class="content d-flex flex-row justify-content-between">
                            <h4 class="align-self-center m-0">
                                <a href="{{ route('details.menu.page', ['slug' => 'sauces_feuilles']) }}">Sauces Feuilles</a>
                            </h4>
                            <a href="{{ route('details.menu.page', ['slug' => 'sauces_feuilles']) }}" class="read-more">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 h-100">
                    <div class="category-box">
                        <img src="{{ asset('home/pub/d0/30.png') }}" alt="Riz">
                        <div class="content d-flex flex-row justify-content-between">
                            <h4 class="align-self-center m-0">
                                <a href="{{ route('details.menu.page', ['slug' => 'riz']) }}">Riz</a>
                            </h4>
                            <a href="{{ route('details.menu.page', ['slug' => 'riz']) }}" class="read-more">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 h-100">
                    <div class="category-box">
                        <img src="{{ asset('home/pub/60.jpeg') }}" alt="Autres Résistances">
                        <div class="content d-flex flex-row justify-content-between">
                            <h4 class="align-self-center m-0">
                                <a href="{{ route('details.menu.page', ['slug' => 'autres_resistances']) }}">Autres Résistances</a>
                            </h4>
                            <a href="{{ route('details.menu.page', ['slug' => 'autres_resistances']) }}" class="read-more">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 h-100">
                    <div class="category-box">
                        <img src="{{ asset('home/pub/d0/30.png') }}" alt="Viandes et Poissons">
                        <div class="content d-flex flex-row justify-content-between">
                            <h4 class="align-self-center m-0">
                                <a href="{{ route('details.menu.page', ['slug' => 'viandes_poissons']) }}">Viandes et Poissons</a>
                            </h4>
                            <a href="{{ route('details.menu.page', ['slug' => 'viandes_poissons']) }}" class="read-more">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 h-100">
                    <div class="category-box">
                        <img src="{{ asset('home/pub/290.jpeg') }}" alt="Salades">
                        <div class="content d-flex flex-row justify-content-between">
                            <h4 class="align-self-center m-0">
                                <a href="{{ route('details.menu.page', ['slug' => 'salades']) }}">Salades</a>
                            </h4>
                            <a href="{{ route('details.menu.page', ['slug' => 'salades']) }}" class="read-more">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 h-100">
                    <div class="category-box">
                        <img src="{{ asset('home/pub/u0.jpeg') }}" alt="Fast Food">
                        <div class="content d-flex flex-row justify-content-between">
                            <h4 class="align-self-center m-0">
                                <a href="{{ route('details.menu.page', ['slug' => 'fast_food']) }}">Fast Food</a>
                            </h4>
                            <a href="{{ route('details.menu.page', ['slug' => 'fast_food']) }}" class="read-more">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 h-100">
                    <div class="category-box">
                        <img src="{{ asset('home/pub/steaks0.jpeg') }}" alt="Les Steaks">
                        <div class="content d-flex flex-row justify-content-between">
                            <h4 class="align-self-center m-0">
                                <a href="{{ route('details.menu.page', ['slug' => 'steaks']) }}">Les Steaks</a>
                            </h4>
                            <a href="{{ route('details.menu.page', ['slug' => 'steaks']) }}" class="read-more">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 h-100">
                    <div class="category-box">
                        <img src="{{ asset('home/pub/w0.jpeg') }}" alt="Boissons">
                        <div class="content d-flex flex-row justify-content-between">
                            <h4 class="align-self-center m-0">
                                <a href="{{ route('details.menu.page', ['slug' => 'boissons']) }}">Boissons</a>
                            </h4>
                            <a href="{{ route('details.menu.page', ['slug' => 'boissons']) }}" class="read-more">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 h-100">
                    <div class="category-box">
                        <img src="{{ asset('home/pub/cocktails0.jpeg') }}" alt="Cocktails">
                        <div class="content d-flex flex-row justify-content-between">
                            <h4 class="align-self-center m-0">
                                <a href="{{ route('details.menu.page', ['slug' => 'cocktails']) }}">Cocktails</a>
                            </h4>
                            <a href="{{ route('details.menu.page', ['slug' => 'cocktails']) }}" class="read-more">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 h-100">
                    <div class="category-box">
                        <img src="{{ asset('home/pub/vins0.jpeg') }}" alt="Vins & Champagnes">
                        <div class="content d-flex flex-row justify-content-between">
                            <h4 class="align-self-center m-0">
                                <a href="{{ route('details.menu.page', ['slug' => 'vins_champagnes']) }}">Vins & Champagnes</a>
                            </h4>
                            <a href="{{ route('details.menu.page', ['slug' => 'vins_champagnes']) }}" class="read-more">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 h-100">
                    <div class="category-box">
                        <img src="{{ asset('home/pub/desserts0.jpeg') }}" alt="Desserts">
                        <div class="content d-flex flex-row justify-content-between">
                            <h4 class="align-self-center m-0">
                                <a href="{{ route('details.menu.page', ['slug' => 'desserts']) }}">Desserts</a>
                            </h4>
                            <a href="{{ route('details.menu.page', ['slug' => 'desserts']) }}" class="read-more">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    

    <section id="reservation-section">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="section-heading">Réserver une table</h2>
                    <h3 class="section-sub-heading">Faites une réservation</h3>
                    <a href="{{ route('reservation.page') }}" class="link-button">Réserver une table</a>
                </div>
            </div>
        </div>
    </section>

    <section id="menu-section">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="section-heading">Menu des plats</h2>
                    <h3 class="section-sub-heading">Choisissez vos meilleurs plats</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <a href="#" class="menu-box">
                        <img src="{{ asset('home/pub/a8.jpeg') }}" alt="image name">
                        <h4>Riz gras au poulet</h4>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4">
                    <a href="#" class="menu-box">
                        <img src="{{ asset('home/pub/8.jpeg') }}" alt="image name">
                        <h4>Igname pilée</h4>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4">
                    <a href="#" class="menu-box">
                        <img src="{{ asset('home/pub/20.jpeg') }}" alt="image name">
                        <h4>Êba et monyo au poisson</h4>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4">
                    <a href="#" class="menu-box">
                        <img src="{{ asset('home/pub/7.jpeg') }}" alt="image name">
                        <h4>Télibo</h4>
                    </a>
                </div>

                <div class="col-lg-3 col-md-4">
                    <a href="#" class="menu-box">
                        <img src="{{ asset('home/pub/6.jpeg') }}" alt="image name">
                        <h4>Amiwo au poulet</h4>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4">
                    <a href="#" class="menu-box">
                        <img src="{{ asset('home/pub/29.jpeg') }}" alt="image name">
                        <h4>Salade</h4>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4">
                    <a href="#" class="menu-box">
                    <img src="{{ asset('home/pub/32.png') }}" alt="image name">
                        <h4>Riz blanc au poisson frit</h4>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4">
                    <a href="#" class="menu-box">
                        <img src="{{ asset('home/pub/a1.jpeg') }}" alt="image name">
                        <h4>Atassi au poulet</h4>
                    </a>
                </div>

                <div class="col-lg-3 col-md-4">
                    <a href="#" class="menu-box">
                        <img src="{{ asset('home/pub/a2.jpeg') }}" alt="image name">
                        <h4>Bomiwo au poulet</h4>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4">
                    <a href="#" class="menu-box">
                        <img src="{{ asset('home/pub/a3.jpeg') }}" alt="image name">
                        <h4>Atiekè au poisson</h4>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4">
                    <a href="#" class="menu-box">
                        <img src="{{ asset('home/pub/a7.jpeg') }}" alt="image name">
                        <h4>Pomme sauté </h4>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4">
                    <a href="#" class="menu-box">
                    <img src="{{ asset('home/pub/a5.jpeg') }}" alt="image name">
                        <h4>Sauce d'arachide</h4>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="working-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12">
                    <h2 class="section-heading">Heures d'ouverture</h2>
                    <h3 class="section-sub-heading">Profitez de nos plats 7 jours sur 7</h3>
                </div>
                <div class="col-lg-5 d-lg-block d-md-none">
                    <ul class="text-md-center">
                        <li>Ouvre à ......... 11:00</li>
                        <li>Ferme à ......... 00:00</li>
                        <li>Ouvert tous les jours</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</div>
