<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{url('/')}}/adminlte/plugins/fontawesome-free/css/all.min.css">

    <!-- jQuery -->
    <script src="{{ url('/') }}/adminlte/plugins/jquery/jquery.min.js"></script>

    <style>
        .grecaptcha-badge {
            z-index: 99999;
            display: block !important;
        }

        .logo {
            width: auto;
            max-width: 25%;
            height: auto;
        }
    </style>

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-info text-white shadow-sm">
            <div class="container">
                <ul class="nav navbar-nav mx-auto justify-content-center text-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">
                            <img class="logo" src="{{ url('/') }}/Logo.svg" alt="JIREH">
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <!-- Footer -->
        <div class="container" style="height: 120px; z-index: 1;">
            <div class="row">
                <footer class="bg-dark fixed-bottom">

                    <!-- Copyright -->

                    <div class="text-center text-light py-3">
                        <strong>Copyright &copy; {{ now()->year }} <a href="{{ ('/')}}./consultacliente">
                                {{ config('app.name')}}</a>.</strong>
                        All rights reserved.
                        <b>Version</b> 1.0.0
                    </div>
                    <!-- Copyright -->
                    <p class="text-center text-light py-2">
                        Al usar este sitio, reconoces haber leído y entendido los <a href="#" data-toggle="modal" data-target="#terminos">términos de servicio</a> .
                    </p>
                </footer>
                <!-- Footer -->
            </div>
        </div>
    </div>
    @include('layouts.terminos')
</body>

</html>