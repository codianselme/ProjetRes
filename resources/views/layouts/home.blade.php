<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yb Restaurant</title>
    <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --main-color: #E45118;
        }
    </style>
    <link href="{{ asset('home/assets/public/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="{{ asset('home/assets/public/css/style.css') }}">
</head>
<body>
    <div id="wrapper">
        <header id="header">
            <div class="header-top d-flex flex-row justify-content-between">
                <ul>
                    <li><a href="https://www.facebook.com/yahooobaba/"><i class="fab fa-facebook"></i></a></li>
                    <li><a href="https://twitter.com/yahooobaba"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="https://www.instagram.com/yahoo_baba/"><i class="fab fa-instagram"></i></a></li>
                    <li><a href="https://www.youtube.com/yahoobaba"><i class="fab fa-youtube"></i></a></li>
                </ul>
                <ul>
                    <li><a href="login.html">Connexion</a></li>
                    <li><a href="signup.html">Inscription</a></li>
                </ul>
            </div>
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <a class="navbar-brand logo" href="https://project.yahoobaba.net/restaurant-management">
                        <img src="{{ asset('home/site-images/logo.png') }}" alt="Yb Restaurant" style="width: 50px;">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-burger"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-0 ms-lg-5">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="index.html#">Accueil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="https://project.yahoobaba.net/restaurant-management#menu-section">Menu</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="https://project.yahoobaba.net/restaurant-management#category-section">Repas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="about.html">À propos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="contact.html">Contact</a>
                            </li>
                        </ul>
                        <ul class="header-nav-right">
                            <li>
                                <a href="index.html"><i class="fa fa-phone"></i>1234567895</a>
                            </li>
                            <li>
                                <a href="reservation.html" class="link-button">Réserver une table</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        
        <section id="banner-section">
            <div class="swiper">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <div class="swiper-slide" style="background-image: url('{{ asset('home/banners/banner2.png') }}');">
                        <div class="row">
                            <div class="col-6">
                                <h1>Nous ne cuisinons pas, nous créons vos émotions !</h1>
                                <span class="d-block mb-4">Découvrez une expérience culinaire unique qui vous fera vivre des émotions inoubliables.</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide" style="background-image: url('{{ asset('home/banners/banner1.png') }}');">
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
                            <img src="{{ asset('home/manage_category/ilya-mashkov-mkVa2hLJgnI-unsplash.jpg') }}" alt="image name">
                            <div class="content d-flex flex-row justify-content-between">
                                <h4 class="align-self-center m-0"><a href="category/Burger.html">Burger</a></h4>
                                <a href="category/Burger.html" class="read-more"><i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 h-100">
                        <div class="category-box">
                            <img src="{{ asset('home/manage_category/lai-yuching-WxePxgrIJbQ-unsplash.jpg') }}" alt="image name">
                            <div class="content d-flex flex-row justify-content-between">
                                <h4 class="align-self-center m-0"><a href="category/Indian.html">Indien</a></h4>
                                <a href="category/Indian.html" class="read-more"><i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 h-100">
                        <div class="category-box">
                            <img src="{{ asset('home/manage_category/kelvin-t-AcA8moIiD3g-unsplash.jpg') }}" alt="image name">
                            <div class="content d-flex flex-row justify-content-between">
                                <h4 class="align-self-center m-0"><a href="category/Pizza.html">Pizza</a></h4>
                                <a href="category/Pizza.html" class="read-more"><i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 h-100">
                        <div class="category-box">
                            <img src="{{ asset('home/manage_category/bluebird-provisions-CjmlUpo3eAw-unsplash.jpg') }}" alt="image name">
                            <div class="content d-flex flex-row justify-content-between">
                                <h4 class="align-self-center m-0"><a href="category/Soups.html">Soupes</a></h4>
                                <a href="category/Soups.html" class="read-more"><i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 h-100">
                        <div class="category-box">
                            <img src="{{ asset('home/manage_category/katherine-sousa-ln2R1wJ8TCM-unsplash.jpg') }}" alt="image name">
                            <div class="content d-flex flex-row justify-content-between">
                                <h4 class="align-self-center m-0"><a href="category/Drinks.html">Boissons</a></h4>
                                <a href="category/Drinks.html" class="read-more"><i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 h-100">
                        <div class="category-box">
                            <img src="{{ asset('home/manage_category/david-holifield-kPxsqUGneXQ-unsplash.jpg') }}" alt="image name">
                            <div class="content d-flex flex-row justify-content-between">
                                <h4 class="align-self-center m-0"><a href="category/Cake.html">Gâteau</a></h4>
                                <a href="category/Cake.html" class="read-more"><i class="fa fa-angle-right"></i></a>
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
                        <a href="reservation.html" class="link-button">Réserver une table</a>
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
                            <img src="{{ asset('home/menu_type/brooke-lark-HlNcigvUi4Q-unsplash.jpg') }}" alt="image name">
                            <h4>Petit déjeuner</h4>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-4">
                        <a href="menu/Italian.html" class="menu-box">
                            <img src="{{ asset('home/menu_type/sorin-popa-XAxvKp0tdwU-unsplash.jpg') }}" alt="image name">
                            <h4>Italien</h4>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-4">
                        <a href="menu/Chinese.html" class="menu-box">
                            <img src="{{ asset('home/menu_type/orijit-chatterjee-wEBg_pYtynw-unsplash.jpg') }}" alt="image name">
                            <h4>Chinois</h4>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-4">
                        <a href="menu/Mexican.html" class="menu-box">
                            <img src="{{ asset('home/menu_type/roberto-carlos-roman-don-TS_g_856-CA-unsplash.jpg') }}" alt="image name">
                            <h4>Mexicain</h4>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-4">
                        <a href="menu/Desserts.html" class="menu-box">
                            <img src="{{ asset('home/menu_type/joyful-vT5xrj3z1OE-unsplash.jpg') }}" alt="image name">
                            <h4>Desserts</h4>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-4">
                        <a href="menu/Dinner.html" class="menu-box">
                            <img src="{{ asset('home/menu_type/juliette-f-fb0_wj2MZk4-unsplash.jpg') }}" alt="image name">
                            <h4>Dîner</h4>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-4">
                        <a href="menu/Lunch.html" class="menu-box">
                            <img src="{{ asset('home/menu_type/brooke-lark-jUPOXXRNdcA-unsplash.jpg') }}" alt="image name">
                            <h4>Déjeuner</h4>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-4">
                        <a href="menu/Juice.html" class="menu-box">
                            <img src="{{ asset('home/menu_type/zlatko-duric-U4QkDQW84sg-unsplash.jpg') }}" alt="image name">
                            <h4>Jus</h4>
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
                            <li>Ouvert le ......... 10:00</li>
                            <li>Fermé le ......... 23:00</li>
                            <li>Ouvert tous les jours</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <footer id="footer" class="pt-5">
            <div class="footer-content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-12">
                            <div class="footer-widget text-center text-lg-left">
                                <a href="index.html" class="logo">
                                    <img src="{{ asset('home/site-images/logo.png') }}" alt="Yb Restaurant">
                                </a>
                                <ul class="footer-social-links">
                                    <li><a href="https://www.facebook.com/yahooobaba/"><i class="fab fa-facebook"></i></a></li>
                                    <li><a href="https://twitter.com/yahooobaba"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="https://www.instagram.com/yahoo_baba/"><i class="fab fa-instagram"></i></a></li>
                                    <li><a href="https://www.youtube.com/yahoobaba"><i class="fab fa-youtube"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="footer-widget text-center">
                                <h4>Appel pour commande</h4>
                                <ul>
                                    <li><span>1234567895</span></li>
                                    <li>email@email.com</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="footer-widget text-center">
                                <h4>Emplacement</h4>
                                <ul>
                                    <li>New York, US</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom py-4">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 d-flex flex-row justify-content-between">
                            <span>Copyright 2023</span>
                            <ul class="">
                                <li><a href="about.html">À propos</a></li>
                                <li><a href="privacy-policy.html">Politique de confidentialité</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>        
        </footer>
        <input type="text" id="url" value="https://project.yahoobaba.net/restaurant-management" hidden>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="{{ asset('home/assets/public/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('home/assets/public/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('home/assets/public/js/jquery.validate.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="{{ asset('home/assets/public/js/action.js') }}"></script>
    <script>
        const swiper = new Swiper('.swiper', {
            direction: 'horizontal',
            loop: true,
            pagination: {
                el: '.swiper-pagination',
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            scrollbar: {
                el: '.swiper-scrollbar',
            },
        });
    </script>
</body>
</html>