<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('img/icon 1.png') }}" type="image/png" sizes="180x180" />

    {{-- Styles --}}
    <link rel="stylesheet" href="{{ asset('css/icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="authentication-bg" data-layout-config="{&quot;darkMode&quot;:false}" data-layout-color="light">

    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-lg-5">
                    <div class="card">
                        <!-- Logo -->
                        <div class="card-header pt-4 pb-4 text-center bg-primary">
                            <a href="index.html">
                                <span><img src="assets/images/logo.png" alt="" height="18"></span>
                            </a>
                        </div>

                        <div class="card-body p-4">
                            <div class="text-center">
                                <h1 class="text-error">4<i class="mdi mdi-emoticon-sad"></i>3</h1>
                                <h4 class="text-uppercase text-danger mt-3">UNAUTHORIZED</h4>
                                <p class="text-muted mt-3">Il semble que vous ayez pris un mauvais virage. Ne vous
                                    inquiétez pas...
                                    Cela arrive aux meilleurs d'entre nous. Voici un
                                    petite astuce qui pourrait vous aider à vous remettre sur la bonne voie.</p>

                                <a class="btn btn-info mt-3" href="{{ url()->previous() }}
                                    "><i class="mdi mdi-reply"></i>
                                    Retour à la page precedente</a>
                            </div>
                        </div> <!-- end card-body-->
                    </div>
                    <!-- end card -->
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <footer class="footer footer-alt">
        2018 -
        <script>
            document.write(new Date().getFullYear())
        </script>2022 © Is-Tech
    </footer>

    {{-- scripts --}}
    <script src="{{ asset('js/vendor.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

</html>
