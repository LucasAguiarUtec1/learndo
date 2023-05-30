<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>List of Users</title>
	<!-- Add your stylesheets here -->
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Perfil de {{$usuario->nickname}}</h1>
        <h1> </h1>
        <n>Nombre completo: {{$usuario->nombrecompleto}}</n>
        <h1> </h1>
        <n>E-Mail: {{$usuario->email}}</n>
        @if($usuario->telefono)
        <h1> </h1>
        <n>Teléfono: {{$usuario->telefono}}</n>
        @endif
        @if($usuario->biografia)
        <h1> </h1>
        <n>Biografía: {{$usuario->biografia}}</n>
        @endif
        <h1> </h1>
        @if($usuario->foto_fb)
        <n>¿Foto?:</n> <img src="{{$usuario->foto_fb}}" alt="My Facebook Photo">
        @endif
            

	<!-- Add your scripts here -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="./custom.js"></script>
</body>
</html>