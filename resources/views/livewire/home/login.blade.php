<div>
    <article id="main-content">
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h2 class="section-sub-heading">Connexion</h2>
                        <nav aria-label="breadcrumb" class="breadcrumb-nav">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#{{ route('home.page') }}">Accueil</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Connexion</li>
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
                        <h2 class="section-heading text-center">Connexion</h2>
                        <h3 class="section-sub-heading text-center">Bienvenue </h3>
                    </div>
                </div>

                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <form class="row position-relative" method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group col-md-4 offset-md-4 mb-4">
                        <input type="email" class="form-control" name="email" :value="old('email')" placeholder="Adresse e-mail" required autofocus autocomplete="username">
                    </div>
                    <div class="form-group col-md-4 offset-md-4 mb-4">
                        <input type="password" class="form-control" placeholder="Mot de passe" required name="password" required autocomplete="current-password">
                    </div>
                    <div class="form-group col-md-4 offset-md-4 mb-3 d-flex flex-row justify-content-between">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="align-self-center">Mot de passe oublié ?</a>
                        @endif
                        <input type="submit" class="btn link-button" value="Connexion">
                    </div>
                    {{-- <div class="text-center">
                        <span>Vous n'avez pas de compte ? <a href="signup.html">Inscription</a></span>
                    </div> --}}
                </form>
            </div>
        </section>
    </article>
</div>
