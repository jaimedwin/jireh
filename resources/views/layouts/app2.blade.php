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

    <!-- Fontawesome -->
    <script src="https://use.fontawesome.com/45512b559e.js"></script>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-info text-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links 
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li
                        -->
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <!-- Footer -->
        <div class="container" style="height: 120px;">
            <div class="row">
                <footer class="bg-dark fixed-bottom">
    
                    <!-- Copyright -->
                    
                    <div class="text-center text-light py-3" >
                        <strong>Copyright &copy; {{ now()->year }} <a href="{{ ('/')}}./consultacliente"> {{ config('app.name')}}</a>.</strong> 
                        All rights reserved.
                        <b>Version</b> 1.0.0
                    </div>
                    <!-- Copyright -->
                        <p class="text-center text-light py-2">
                       Al usar este sitio, reconoces haber leido y entendido la Política de Privacidad, y nuestros Términos de Servicio.
                        </p>
                    
                    <!--
                        Al usar este sitio, reconoces haber leido y entendido nuestra Política de Cookies, Política de Privacidad, y nuestros Términos de Servicio.
                    -->
                </footer>
                <!-- Footer -->
            </div>
        </div>
        
        
    </div>
</body>

</html>