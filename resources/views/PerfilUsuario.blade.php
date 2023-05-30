<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Mi página con Bootstrap</title>
	<!-- Agregamos los estilos de Bootstrap -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/styleMisCursos.css')}}">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
		<a class="navbar-brand" href="{{route('inicio')}}">
			<img src="{{ asset('images/1.png')}}" width="150" height="50" class="d-inline-block align-top" alt="Logo de Mi Página">
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="{{route('inicio')}}">Inicio <span class="sr-only">(current)</span></a>
				</li>
				@if(Auth::check() && (Auth::user()->userable_type == 'App\Models\Estudiante' || Auth::user()->userable_type == 'App\Models\Organizador'))
				<li class="nav-item">
					<a class="nav-link" href="{{route('miscursos')}}">Mis Cursos</a>
				</li>
				@endif
			</ul>
			<ul class="navbar-nav">
				@if (Auth::check())
				<li class="nav-item">
					<a class="nav-link" href="{{route('logout')}}">Cerrar Sesión</a>
				</li>
				@else
				<li class="nav-item">
					<a class="nav-link" href="{{route('login')}}">Iniciar Sesión</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{route('registro')}}">Registrarse</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{route('maps')}}">Mapa</a>
				</li>
				@endif
				@if(Auth::check() && Auth::user()->userable_type == 'App\Models\Organizador')
				<li class="nav-item">
					<a class="nav-link" href="{{route('registrocurso')}}">Crear Curso</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{route('registroseminario')}}">Crear Seminario</a>
				</li>
				@endif
			</ul>
		</div>
	</nav>

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