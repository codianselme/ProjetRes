<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bar Restaurant Les Saveurs du Corridor</title>
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
    @livewireStyles
</head>
<body>
    <div id="wrapper">
        <header id="header">
            <div class="header-top d-flex flex-row justify-content-between">
                <ul>
                    <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                    <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                </ul>
                <ul>
                    <li><a href="{{ route('connexion.page') }}">Connexion</a></li>
                    {{-- <li><a href="#">Inscription</a></li> --}}
                </ul>
            </div>
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <a class="navbar-brand logo" href="{{ route('home.page') }}">
                        <img src="{{ asset('home/site-images/logo.png') }}" alt="Yb Restaurant" style="width: 50px;">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-burger"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-0 ms-lg-5">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{ route('home.page') }}">Accueil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#category-section">Menu</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#menu-section">Repas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('about.page') }}">À propos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('contact.page') }}">Contact</a>
                            </li>
                        </ul>
                        <ul class="header-nav-right">
                            <li>
                                <a href="{{ route('home.page') }}"><i class="fa fa-phone"></i>+2290151616130</a>
                            </li>
                            <li>
                                <a href="{{ route('reservation.page') }}" class="link-button">Réserver une table</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        
        @yield('content')

        <footer id="footer" class="pt-5">
            <div class="footer-content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-12">
                            <div class="footer-widget text-center text-lg-left">
                                <a href="{{ route('home.page') }}" class="logo">
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
                                    <li><span>+229 0151616130</span></li>
                                    <li>lessaveursducorridor@gmail.com</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="footer-widget text-center">
                                <h4>Emplacement</h4>
                                <ul>
                                    <li>Fidrossè, 100m à gauche de "Bénin Atlantic Beach Hotel" en allant vers le CEG Fiyegnon</li>
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
                            <span>Copyright &copy; {{ date('Y') }} KAVINA.</span>
                            <ul class="">
                                <li><a href="{{ route('about.page') }}">À propos de Nous</a></li>
                                {{-- <li><a href="#">Politique de confidentialité</a></li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>        
        </footer>
        {{-- <input type="text" id="url" value="#" hidden> --}}
    </div>
    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script> --}}
    {{-- <script src="{{ asset('home/assets/public/js/bootstrap.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('home/assets/public/js/jquery-3.4.1.min.js') }}"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script> --}}
    @livewireScripts
    
    <script>
        window.addEventListener('showToast', event => {
            Swal.fire({
                title: event.detail.message,
                icon: event.detail.type || 'success',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
        });
    </script>

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