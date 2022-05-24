<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <title>Programa de Robótica</title>

    <link rel="icon" type="image/png" href="{{ asset('img/favicon.ico') }}" />
    <link href="{{ asset('css/plugins.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/backend.css') }}" rel="stylesheet" type="text/css">
</head>

<body class=" pace-done">
    <div class="pace  pace-inactive">
        <div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
            <div class="pace-progress-inner"></div>
        </div>
        <div class="pace-activity"></div>
    </div>

	@include('layouts.sidebar')

		<div id="page-wrapper" class="gray-bg" style="min-height: 1391px;">
		    <div class="row border-bottom">
		        <nav class="navbar navbar-static-top" style="margin-bottom: 0">
		            <div class="navbar-header">
		                <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
		            </div>
		            <ul class="nav navbar-top-links navbar-right">
		                <li>
		                    <span class="m-r-sm text-muted welcome-message">Mustakis</span>
		                </li>
		                <li>
		                    <a class="nav-link text-success btn btn-outline-success" href="{{ route('logout') }}" onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
		                        <i class="fa fa-sign-out"></i>
		                        Salir
		                    </a>
		                </li>
		            </ul>
		            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
		                {{ csrf_field() }}
		            </form>
		        </nav>
		    </div>

			@yield('content')

						
			<div class="footer">
			    <div class="pull-right">
			        <strong>Sistema de Administración de Cursos</strong>
			    </div>
			    <div>
			        <strong>Copyright</strong> Mustakis © {{ date("Y") }}
			    </div>
			</div>
		</div>
	</div>

	<!-- App javascript -->
	<script src="{{ asset('js/survey.js') }}"></script>

	@yield('scripts')

</body>
</html>
