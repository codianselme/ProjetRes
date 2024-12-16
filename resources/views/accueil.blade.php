<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('https://i0.wp.com/www.photo-paysage.com/albums/userpics/10001/Premiers_feuillages_du_printemps.jpg'); /* Remplacez par l'URL de votre image */
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .form-control {
            border-radius: 10px;
        }
        .btn-primary {
            border-radius: 10px;
        }
        .brand-logo {
            width: 80px;
            height: 80px;
            border-radius: 50%;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4">
                <div class="text-center mb-4">
                    <!-- Real Image -->
                    <img src="https://img.freepik.com/vecteurs-libre/illustration-du-concept-connexion_114360-739.jpg?t=st=1734190371~exp=1734193971~hmac=7b120ce21d7736db6991b9723f9f3b0d5720a05b80a74f8be6ad4f611082ecd8&w=740" 
                         alt="Brand Logo" 
                         class="brand-logo">
                    <h3 class="mt-3">Bienvenue ...</h3>
                    <p class="text-muted">Connectez-vous à votre compte</p>

                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Adresse e-mail</label>
                        <input type="email" class="form-control" id="email" name="email" :value="old('email')" placeholder="Enter your email" required autofocus autocomplete="username">
                    </div>
                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter your password" required name="password" required autocomplete="current-password">
                    </div>
                    <!-- Remember Me -->
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                        <label class="form-check-label" for="remember">Se souvenir de moi</label>
                    </div>
                    <!-- Submit Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Connexion</button>
                    </div>
                    <div class="text-center mt-3">
                        <small class="text-muted">Vous avez oublié votre mot de passe? &nbsp;&nbsp;&nbsp;&nbsp;
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-decoration-none">Mot de passe oublié</a>
                            @endif
                        </small>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>