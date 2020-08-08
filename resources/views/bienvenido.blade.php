    <!DOCTYPE html>
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


    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .grecaptcha-badge {
            z-index: 99999;
            display: block !important;
        }

        .logo {
            width: auto;
            max-width: 60%;
            height: auto;
        }


    </style>
</head>

<body>
    <div class="flex-center position-ref full-height">
        <div class="top-right links">
            
            <a href="{{ route('consultacliente') }}">Consulta cliente</a>
            
            @if (Route::has('login'))
        
                @auth
                <a href="{{ url('/admin') }}">Admin JIREH</a>
                @else
                <a href="{{ route('login') }}">Login</a>
                @endauth
        
            @endif
        </div>
        <div class="row">
            <div class="content">
                
                
            <a class="nav-link" href="{{ url('/') }}">
                            <img class="logo" src="{{ url('/') }}/Logo.svg" alt="JIREH">
                        </a>
                <br/>
                <div class="links">
                    <a href="https://forms.office.com/Pages/ResponsePage.aspx?id=DQSIkWdsW0yxEjajBLZtrQAAAAAAAAAAAAa__fXAvXFUNkRGRFNIRVQ3NTFMVVUwVVVZMVdVTDNCOC4u&inline=true" target="_blank">PQRS</a>
                </div>
            </div>
        </div>

        
    </div>
    <!-- Footer -->
    <div class="container" style="height: 120px; z-index: 1;">
        <div class="row">
            <footer class="bg-dark fixed-bottom">
                <!-- Copyright -->
                <div class="text-center text-light py-3">
                    <strong>Copyright &copy; {{ now()->year }} 
                        <a href="{{ ('/')}}./consultacliente">
                            {{ config('app.name')}}</a>.
                    </strong>
                    All rights reserved. <b>Version</b> 1.0.0
                </div>
                <p class="text-center text-light py-2">
                        Al usar este sitio, reconoces haber leído y entendido los <a href="#" data-toggle="modal" data-target="#terminos">términos de servicio</a> .
                    </p>
            </footer>
                
        </div>
    </div>

    @include('layouts.pqrs')
</body>

</html>