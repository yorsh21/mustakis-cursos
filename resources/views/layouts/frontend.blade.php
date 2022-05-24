<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Fundación Mustakis">
    <meta name="author" content="Kuantum">

    <title>Programa de Robótica</title>
    
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.ico') }}" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/web.css') }}" rel="stylesheet" type="text/css">
</head>
<body id="page-top">
    <nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top"><img src="{{ asset('img/logo_mustakis.png') }}" alt="Mustakis"></a>
        <button class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            @postulations()
                <li class="nav-item mx-0 mx-lg-1">
                  <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="{{ route('registro') }}">Registrarse</a>
                </li>
                <li class="nav-item mx-0 mx-lg-1">
                  <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="{{ route('inicio') }}">Ingresar</a>
                </li>
            @endpostulations
          </ul>
        </div>
      </div>
    </nav>

    @yield('content')

    <div class="copyright py-2 text-center text-white">
      <div class="container">
        <p class="p1" style="font-size: 10px;"><b>© Fundación Mustakis {{ date("Y") }} <span class="Apple-converted-space">&nbsp; Recoleta 1169, Recoleta, Santiago -&nbsp;</span>Teléfono +562 2820 8585<span class="Apple-converted-space">&nbsp; &nbsp; &nbsp; </span>contacto@fundacionmustakis.com</b></p>
      </div>
    </div>

    <!-- JavaScript -->
    <script src="{{ asset('js/web.js') }}"></script>
</body>
</html>