<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Mi página con Bootstrap</title>
	<!-- Agregamos los estilos de Bootstrap -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/stylesInicio.css') }}">
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
					<a class="nav-link" href="{{route('inicio')}}">Inicio</a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="{{route('mapa')}}">Mapa</a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="{{route('mapa')}}">Mapa<span class="sr-only">(current)</span></a>
				</li>
				@if(Auth::check() && (Auth::user()->userable_type == 'App\Models\Estudiante' || Auth::user()->userable_type == 'App\Models\Organizador'))
				<li class="nav-item">
					<a class="nav-link" href="{{route('miscursos')}}">Mis Cursos</a>
				</li>
				@endif
			</ul>
			<ul class="navbar-nav">
			<li class="nav-item">
					<a class="nav-link" href="{{route('ListarUsuarios')}}">Usuarios</a>
				</li>
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

	<div class="frase">
		LearnDo el Aprendizaje en tus Manos
	</div>


	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
	integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
	crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
	integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE"
	crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
	integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ"
	crossorigin="anonymous"></script>



	<!--JAVASCRIPT-->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js%22%3E"></script>
	<script src="./custom.js"></script>

</body>