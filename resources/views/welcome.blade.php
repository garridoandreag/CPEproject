<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Fonts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery-3.5.1.js') }}" defer></script>
    <script src="https://kit.fontawesome.com/e4f410c930.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/bootstrap-multiselect.js') }}"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- <link rel="dns-prefetch" href="//fonts.gstatic.com">  -->
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/font-nunito.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-multiselect.css') }}" rel="stylesheet">

    <!-- Styles -->

    <title>Colegio Pequeñas Estrellas </title>
</head>

<body style="background-image: url('images/stars2.gif'); background-size: 35%; background-color: var(--navbar-color)">
    <!-- Header -->
    <nav id="header" class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#" style="color:yellow">
                <img src="images/CPE_logo.png" alt="Colegio Pequeñas Estrellas Logo"> Colegio Pequeñas Estrellas
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        @if (Route::has('login'))
                            <div class="top-right links">
                                @auth
                                    <a class="nav-link active" aria-current="page" href="{{ url('/home') }}">Home<span
                                            class="sr-only">(current)</span></a>
                                @else
                                    <a class="nav-link active text-important" aria-current="page"
                                        href="{{ route('login') }}">Iniciar Sesión</a>
                                @endauth
                            </div>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- main -->
    <section id="carouselmain">
        <div id="carousel" class="carousel slide" data-ride="carousel" data-pause="false">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images/carrusel1.jpg" class="d-block w-100" alt="Carrusel1">
                </div>
                <div class="carousel-item">
                    <img src="images/carrusel2.jpg" class="d-block w-100" alt="Carrusel2">
                </div>
                <div class="carousel-item">
                    <img src="images/carrusel3.jpg" class="d-block w-100" alt="Carrusel3">
                </div>
                <div class="overlay">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-6 offset-md-6 text-center text-md-right">
                                <h1> Colegio Pequeñas Estrellas </h1>
                                <p class="d-none d-md-block">Colegio Pequeñas Estrellas</p>
                                <a href="#" class="btn btn-outline-light">Más información</a>
                                <button type="button" class="btn btn-warning">Formulario de inscripción</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- footer -->
    <footer id="footer" class="pb-4 pt-4">
        <div class="container">
            <div class="row text-center">
                <div class="col-12 col-lg">
                    <a href="#">Preguntas frecuentes</a>
                </div>
                <div class="col-12 col-lg">
                    <a href="#">Contáctanos</a>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>
