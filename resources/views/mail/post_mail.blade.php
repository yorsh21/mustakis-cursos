<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Nuevo mensaje en el foro</title>
</head>
<body>
	<p>Hola {{ $data->user->name }}:  </p>
	<p>Hay nuevos mensajes en el foro de Programa Robótica.</p>
	<p>Inicia sesión <a href="{{ route('inicio') }}">aqui</a> para ver el mensaje</p>

	<br>
	<br>
	<img src="{{ asset('img/logo.png') }}">
	<footer style="margin-top: 20px;">
		<hr>
		<p style="text-align: center; margin: 0; color: #3E3E3E; font-size: 12px">© Fundación Mustakis 1996 - {{ date("Y") }}</p>
		<p style="text-align: center; margin: 0; color: #3E3E3E; font-size: 12px">Puma 1180, Recoleta, Santiago - Teléfono +562 2820 8585 - Email contacto@fundacionmustakis.com</p>
	</footer>
</body>
</html>