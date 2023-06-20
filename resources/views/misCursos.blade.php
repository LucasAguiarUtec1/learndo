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
@extends('layouts.app')
@section('content')
	
	
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
							@endif
							<a href="{{route('eliminarcurso', $curso->id)}}" class="btn btn-danger float-right eliminarBtn">Eliminar</a>
							</li>
						@endif
					@endforeach
					@if(Auth::user()->userable_type=='App\Models\Colaborador')
						@foreach($cursos_colaborador as $curso_c)
							<li class="list-group-item">
							<img src="{{asset('images/cursos.png')}}" alt="Icono de libro" class="mr-3" width="30" height="30">
							<a href="{{route('modulos', $curso_c->id)}}">{{$curso_c->nombre}}</a>
						@endforeach
					@endif
					@if(Auth::user()->userable_type=='App\Models\Estudiante')
						@foreach($cursos_estudiante as $curso_e)
							<li class="list-group-item">
							<img src="{{asset('images/cursos.png')}}" alt="Icono de libro" class="mr-3" width="30" height="30">
							<a href="{{route('modulos', $curso_e->id)}}">{{$curso_e->nombre}}</a>
						@endforeach
					@endif
				</ul>
				
			</div>
	
			<button class="btn btn-secondary mt-2 text-center" onclick="toggleButtonContentCursos('modulo-1')">Mostrar Cursos</button>
			<div class="contenido-adicional" id="boton-adicional-cursos" style="display: none;"></div>
		</div>

		@if(Auth::check() && (Auth::user()->userable_type == 'App\Models\Estudiante' || Auth::user()->userable_type == 'App\Models\Organizador'))
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
		@endif
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
@endsection
</body>