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
			<img src="{{asset('images/1.png')}}" width="150" height="50" class="d-inline-block align-top" alt="Logo de Mi Página">
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="{{route('inicio')}}">Inicio</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{route('miscursos')}}">Mis Cursos<span class="sr-only">(current)</span></a>
				</li>
			</ul>
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="{{route('logout')}}">Cerrar Sesión</a>
				</li>
			</ul>
		</div>
	</nav>
	
	<div class="container">
		<div class="d-flex justify-content-end">
			@if(Auth::user()->userable_type=='App\Models\Estudiante')
			<button class="btn btn-primary mt-2 text-center">Comprar Curso</button>
			<div class="contenido-adicional" id="contenido-adicional-cursos" style="display: none;"></div>
			<button class="btn btn-primary mt-2 ml-2 text-center">Comprar Seminario</button>
			<div class="contenido-adicional" id="contenido-adicional-seminarios" style="display: none;"></div>
			@endif
		  </div>

		<div class="card mt-4 modulo" id="modulo-1" >
			<div class="card-header">
				<h5 class="mb-0">Mis Cursos</h5>
			</div>
	
			<div class="card-body" style="display: none;">
				<ul class="list-group">
					@foreach($cursos as $curso)
					@if($curso->claseable_type == 'App\Models\Curso')
					<li class="list-group-item">
						<img src="{{asset('images/cursos.png')}}" alt="Icono de libro" class="mr-3" width="30" height="30">
						@if(Auth::user()->userable_type=='App\Models\Organizador')
						<a href="{{route('modulos', $curso->id)}}">{{$curso->nombre}}</a>
						@else
						<a href="#">{{$curso->nombre}}</a>
						@endif
						<a href="{{route('eliminarcurso', $curso->id)}}" class="btn btn-danger float-right eliminarBtn">Eliminar</a>
					</li>
					@endif
					@endforeach
				</ul>
				
			</div>
	
			<button class="btn btn-secondary mt-2 text-center" onclick="toggleButtonContentCursos('modulo-1')">Mostrar Cursos</button>
			<div class="contenido-adicional" id="boton-adicional-cursos" style="display: none;"></div>
		</div>
	
		<div class="card mt-4 modulo" id="modulo-2">
			<div class="card-header">
				<h5 class="mb-0">Mis seminarios</h5>
			</div>
	
			<div class="card-body" style="display: none;">
				<ul class="list-group">
					@foreach($cursos as $curso)
					@if($curso->claseable_type == 'App\Models\Seminario')
					<li class="list-group-item">
						<img src="{{asset('images/seminario.png')}}" alt="Icono de libro" class="mr-3" width="30" height="30">
						<a href="#">{{$curso->nombre}}</a>
						<a href="{{route('eliminarseminario', $curso->id)}}" class="btn btn-danger float-right eliminarBtn">Eliminar</a>

					</li>
					@endif
					@endforeach
				</ul>
				
			</div>
	
			<button class="btn btn-secondary mt-2" style="text-center;" onclick="toggleButtonContent('modulo-2')">Mostrar Seminarios</button>
			<div class="contenido-adicional" id="boton-adicional-seminarios" style="display: none;"></div>
		</div>
	</div>

	<script>
		function toggleButtonContent(elementId) {
			var button = document.getElementById(elementId).getElementsByClassName("btn-secondary")[0];
			var cardBody = document.getElementById(elementId).getElementsByClassName("card-body")[0];
			if (cardBody.style.display === "none") {
				button.innerHTML = "Ocultar Seminarios";
				cardBody.style.display = "block";
			} else {
				button.innerHTML = "Mostrar Seminarios";
				cardBody.style.display = "none";
			}
		}

		function toggleButtonContentCursos(elementId) {
	var button = document.getElementById(elementId).getElementsByClassName("btn-secondary")[0];
	var cardBody = document.getElementById(elementId).getElementsByClassName("card-body")[0];
	if (cardBody.style.display === "none") {
		button.innerHTML = "Ocultar Cursos";
		cardBody.style.display = "block";
	} else {
		button.innerHTML = "Mostrar Cursos";
		cardBody.style.display = "none";
	}
}
	</script>

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