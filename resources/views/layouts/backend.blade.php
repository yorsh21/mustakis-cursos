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

<body>
    
	<div id="wrapper">

		@include('layouts.sidebar')

		<div id="page-wrapper" class="gray-bg">
		    <div class="row border-bottom">
		        <nav class="navbar navbar-static-top" style="margin-bottom: 0">
		            <div class="navbar-header">
		                <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" href="#"><i class="fa fa-bars"></i> </a>
		            </div>
		            <ul class="nav navbar-top-links navbar-right">
		                <li>
		                    <span class="m-r-sm text-muted welcome-message">Mustakis</span>
						</li>
						<li id="events" class="dropdown">
							<a class="dropdown-toggle count-info" data-toggle="dropdown" href="#" aria-expanded="false">
								<i class="fa fa-bell"></i>  
								<span class="label label-primary"></span>
							</a>
							<ul class="dropdown-menu dropdown-messages"></ul>
						</li>
						<li class="dropdown">
							<a class="nav-link" href="{{ route('help.index') }}">
								<i class="fa fa-question fa-lg"></i>  
								<span class="label label-primary"></span>
							</a>
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
	<script src="{{ asset('js/backend.js') }}"></script>
	<script>
		function add_event_dropdown_box() {
			$(".dropdown-events-box").click(function(e) {
				e.preventDefault();

				var id = $(this).data("id");
				var url = $(this).attr("href");
				
				$.ajax({
					type: "GET",
					url: "{{ route('event.viewed') }}/" + id,
					data: {},
					success: function(res) {
						window.location.href = url;
					}
				});
				
			});
		}
		event_template = (url, image, title, content, datetime, id, icon) => `
			<li>
				<a href="${url}" class="dropdown-events-box" data-id="${id}">
					<div class="pull-left">
						<img alt="image" class="img-circle" src="${image}">
					</div>
					
					<div class="media-body">
						<strong>${title}</strong> <br>
						${content}. <br>
						<small class="text-muted">${datetime}</small>
						<small class="float-right text-navy">${icon}</small>
					</div>
				</a>
			</li>
			<li class="divider-box"></li>
		`;
		
		var event_end = (count) => `
			<li>
				<div class="text-center link-block">
					<a href="{{ route('event.index') }}">
						<i class="fa fa-envelope"></i> <strong>Ver todas (${count} más)</strong>
					</a>
				</div>
			</li>
		`;
		
		var event_empty = `
			<li>
				<div class="text-center link-block">
					Sin notificaciones
				</div>
			</li>
		`;

		var events_counter = $("#events > a > span");
		var event_list = $("#events > ul");

		$.ajax({
			type: "GET",
			url: "{{ route('event.fetch') }}",
			data: {},
			success: function(res) {
				if(res.events.length == 0) {
					event_list.append(event_empty);
				}
				else {
					var len_events = 0;
					var total_events = 0;
					var showed_viewed = 0;

					res.events.forEach(event => {
						if (event.viewed == 0) {
							var icon = '';
							len_events++;
						}
						else {
							var icon = '<i class="fa fa-check"></i> Leido';
						}

						if(total_events < 5) {
							event_item = event_template(event.url, event.image, event.title, event.content, event.datetime.substring(0, event.datetime.length - 3), event.id, icon);
							event_list.append(event_item);
							total_events++;
							if (event.viewed == 0) showed_viewed++;
						}

						add_event_dropdown_box();
					});

					events_counter.text(len_events == 0 ? '' : len_events);
					event_list.append(event_end(Math.max(0, len_events - showed_viewed)));
				}
			},
			error: function(e) {
				event_list.append(event_empty);
			}
		});
	</script>

	@yield('scripts')

</body>
</html>
