<div>
    <section id="banner-section">
        <div class="swiper">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                {{-- <div class="swiper-slide" style="background-image: url('{{ asset('home/banners/banner2.png') }}');"> --}}
                <div class="swiper-slide" style="background-image: url('{{ asset('home/banners/ban2.png') }}');">
                    <div class="row">
                        <div class="col-6">
                            <h1>Nous ne cuisinons pas, nous créons vos émotions !</h1>
                            <span class="d-block mb-4">Découvrez une expérience culinaire unique qui vous fera vivre des émotions inoubliables.</span>
                        </div>
                    </div>
                </div>
                {{-- <div class="swiper-slide" style="background-image: url('{{ asset('home/banners/banner1.png') }}');"> --}}
                <div class="swiper-slide" style="background-image: url('{{ asset('home/banners/ban1.png') }}');">
                    <div class="row">
                        <div class="col-6">
                            <h1>Créer votre expérience culinaire exceptionnelle</h1>
                            <span class="d-block mb-4">Découvrez une expérience culinaire unique qui vous fera vivre des émotions inoubliables.</span>
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
                    <h2 class="section-heading">Nos plats populaires</h2>
                    <h3 class="section-sub-heading">Notre catégorie</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 h-100">
                    <div class="category-box">
                        {{-- <img src="{{ asset('home/manage_category/ilya-mashkov-mkVa2hLJgnI-unsplash.jpg') }}" alt="image name"> --}}
                        <img src="{{ asset('home/pub/y.jpeg') }}" alt="image name">
                        <div class="content d-flex flex-row justify-content-between">
                            <h4 class="align-self-center m-0"><a href="category/Burger.html">Ignape Pilée</a></h4>
                            <a href="category/Burger.html" class="read-more"><i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 h-100">
                    <div class="category-box">
                        {{-- <img src="{{ asset('home/manage_category/lai-yuching-WxePxgrIJbQ-unsplash.jpg') }}" alt="image name"> --}}
                        <img src="{{ asset('home/pub/x.jpeg') }}" alt="image name">
                        <div class="content d-flex flex-row justify-content-between">
                            <h4 class="align-self-center m-0"><a href="category/Indian.html">Les steaks</a></h4>
                            <a href="category/Indian.html" class="read-more"><i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 h-100">
                    <div class="category-box">
                        {{-- <img src="{{ asset('home/manage_category/kelvin-t-AcA8moIiD3g-unsplash.jpg') }}" alt="image name"> --}}
                        <img src="{{ asset('home/pub/t.jpeg') }}" alt="image name">
                        <div class="content d-flex flex-row justify-content-between">
                            <h4 class="align-self-center m-0"><a href="category/Pizza.html">Nos sauces</a></h4>{{-- Burger --}}
                            <a href="category/Pizza.html" class="read-more"><i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 h-100">
                    <div class="category-box">
                        {{-- <img src="{{ asset('home/manage_category/bluebird-provisions-CjmlUpo3eAw-unsplash.jpg') }}" alt="image name"> --}}
                        <img src="{{ asset('home/pub/u.jpeg') }}" alt="image name">
                        <div class="content d-flex flex-row justify-content-between">
                            <h4 class="align-self-center m-0"><a href="category/Soups.html">Fast Food</a></h4>
                            <a href="category/Soups.html" class="read-more"><i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 h-100">
                    <div class="category-box">
                        {{-- <img src="{{ asset('home/manage_category/katherine-sousa-ln2R1wJ8TCM-unsplash.jpg') }}" alt="image name"> --}}
                        <img src="{{ asset('home/pub/w.jpeg') }}" alt="image name">
                        <div class="content d-flex flex-row justify-content-between">
                            <h4 class="align-self-center m-0"><a href="category/Drinks.html">Coocktail</a></h4>
                            <a href="category/Drinks.html" class="read-more"><i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 h-100">
                    <div class="category-box">
                        {{-- <img src="{{ asset('home/manage_category/david-holifield-kPxsqUGneXQ-unsplash.jpg') }}" alt="image name"> --}}
                        <img src="{{ asset('home/pub/v.png') }}" alt="image name">
                        <div class="content d-flex flex-row justify-content-between">
                            <h4 class="align-self-center m-0"><a href="category/Cake.html">Déserts</a></h4>
                            <a href="category/Cake.html" class="read-more"><i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-lg-4 col-md-6 h-100">
                    <div class="category-box">
                        <img src="{{ asset('home/pub/8.jpeg') }}" alt="image name" style="width: 100%; height: 40%; object-fit: cover; object-position: center; ">
                        <div class="content d-flex flex-row justify-content-between">
                            <h4 class="align-self-center m-0"><a href="#">IGNAME PILÉE</a></h4>
                            <a href="#" class="read-more"><i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 h-100">
                    <div class="category-box">
                        <img src="{{ asset('home/pub/2.png') }}" alt="image name">
                        <div class="content d-flex flex-row justify-content-between">
                            <h4 class="align-self-center m-0"><a href="#">Indien</a></h4>
                            <a href="#" class="read-more"><i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 h-100">
                    <div class="category-box">
                        <img src="{{ asset('home/manage_category/kelvin-t-AcA8moIiD3g-unsplash.jpg') }}" alt="image name">
                        <div class="content d-flex flex-row justify-content-between">
                            <h4 class="align-self-center m-0"><a href="#">Pizza</a></h4>
                            <a href="#" class="read-more"><i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 h-100">
                    <div class="category-box">
                        <img src="{{ asset('home/manage_category/bluebird-provisions-CjmlUpo3eAw-unsplash.jpg') }}" alt="image name">
                        <div class="content d-flex flex-row justify-content-between">
                            <h4 class="align-self-center m-0"><a href="#">Soupes</a></h4>
                            <a href="#" class="read-more"><i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 h-100">
                    <div class="category-box">
                        <img src="{{ asset('home/manage_category/katherine-sousa-ln2R1wJ8TCM-unsplash.jpg') }}" alt="image name">
                        <div class="content d-flex flex-row justify-content-between">
                            <h4 class="align-self-center m-0"><a href="#">Boissons</a></h4>
                            <a href="#" class="read-more"><i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 h-100">
                    <div class="category-box">
                        <img src="{{ asset('home/pub/5.jpeg') }}" alt="image name">
                        <div class="content d-flex flex-row justify-content-between">
                            <h4 class="align-self-center m-0"><a href="#">Gâteau</a></h4>
                            <a href="#" class="read-more"><i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div> --}}
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
                    <a href="menu/Breakfast.html" class="menu-box">
                        <img src="{{ asset('home/pub/30.jpeg') }}" alt="image name">
                        <h4>Riz au poisson frite</h4>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4">
                    <a href="menu/Italian.html" class="menu-box">
                        <img src="{{ asset('home/pub/8.jpeg') }}" alt="image name">
                        <h4>Igname pilée</h4>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4">
                    <a href="menu/Chinese.html" class="menu-box">
                        <img src="{{ asset('home/pub/20.jpeg') }}" alt="image name">
                        <h4>Êba et monyo au poisson</h4>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4">
                    <a href="menu/Mexican.html" class="menu-box">
                        <img src="{{ asset('home/pub/7.jpeg') }}" alt="image name">
                        <h4>Télibo</h4>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4">
                    <a href="menu/Desserts.html" class="menu-box">
                        <img src="{{ asset('home/pub/6.jpeg') }}" alt="image name">
                        <h4>Amiwo au poulet</h4>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4">
                    <a href="menu/Lunch.html" class="menu-box">
                        <img src="{{ asset('home/pub/29.jpeg') }}" alt="image name">
                        <h4>Salade</h4>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4">
                    <a href="menu/Dinner.html" class="menu-box">
                        <img src="{{ asset('home/pub/9.jpeg') }}" alt="image name">
                        <h4>Dîner</h4>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4">
                    <a href="menu/Juice.html" class="menu-box">
                    <img src="{{ asset('home/pub/32.png') }}" alt="image name">
                        {{-- <img src="{{ asset('home/menu_type/zlatko-duric-U4QkDQW84sg-unsplash.jpg') }}" alt="image name"> --}}
                        <h4>Riz blanc au poisson frite</h4>
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
                        <li>Ouvert le ......... 11:00</li>
                        <li>Fermé le ......... 00:00</li>
                        <li>Ouvert tous les jours</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</div>
