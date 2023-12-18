<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <link rel="shortcut icon" href="./img/svg/logo.svg" type="image/x-icon">
    <!-- Custom styles -->
    <title>{{ config('app.name', 'Dhollandia') }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/dataTables/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
    @yield('style')

</head>

<body>
    <div class="layer"></div>
    <main class="page-center">
        <article class="sign-up">
            <h1 class="sign-up__title"><img style="width: 250px" src="{{ asset('img/png.png') }}" alt="" srcset=""></h1>
            <p class="sign-up__subtitle">Connectez-vous à votre compte pour continuer</p>
            <form style="width: 420px" class="sign-up-form form" action="{{ route('login') }}" method="POST">
                @csrf
                <label class="form-label-wrapper">
                    <p class="form-label">Email</p>
                    <input class="form-input @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" type="email" placeholder="Enter your email" autocomplete=""
                        required>
                    @error('email')
                        <span style="color: red;font-size:10px" class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </label>
                <label class="form-label-wrapper">
                    <p class="form-label">Mot de Passe</p>
                    <input class="form-input @error('password') is-invalid @enderror" name="password" type="password"
                        placeholder="Enter your password" required>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </label>
                {{-- <a class="link-info forget-link" href="##">Forgot your password?</a> --}}
                <label class="form-checkbox-wrapper">
                    <input class="form-checkbox"  type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} >
                    <span class="form-checkbox-label">Se Souvenir de moi</span>
                </label>
                <button type="submit" class="form-btn primary-default-btn transparent-btn">Sign in</button>
            </form>
        </article>
    </main>
</body>

</html>
