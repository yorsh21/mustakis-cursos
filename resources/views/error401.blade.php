<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Mustakis | Error 401</title>

    <link href="css/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/backend.css" rel="stylesheet" type="text/css">

</head>

<body class="gray-bg">


<div class="middle-box text-center animated fadeInDown">
    <h1>401</h1>
    <h3 class="font-bold">Autorización Requerida</h3>

    <div class="error-desc">
        No se ha podido acceder a los recursos solicitados porque no se cuenta con los permisos necesarios.
        <br/><a href="{{ route('sumary') }}" class="btn btn-primary m-t">Regresar</a>
    </div>
</div>

<!-- Mainly scripts -->
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>

</html>
