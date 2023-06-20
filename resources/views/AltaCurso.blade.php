<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Mi página con Bootstrap</title>
	<!-- Agregamos los estilos de Bootstrap -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/stylesAltaCurso.css')}}">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
@extends('layouts.app')
@section('content')
	<div class="container rounded border border-secondary p-4 mt-4">
		<div class="row">
			<div class="col-md-6 offset-md-3">
			  <h2>Alta Curso</h2>
			  <form method="POST" action="{{route('registrarcurso')}}">
				@csrf
				<div class="form-group">
				  <label for="nombreCurso">Nombre del Curso</label>
				  <input type="text" class="form-control" id="nombreCurso" placeholder="Ingrese el nombre del curso" name="name">
				</div>
				<div class="form-group">
				  <label for="descripcion">Descripción</label>
				  <textarea class="form-control" id="descripcion" rows="4" placeholder="Ingrese la descripción del curso" name="descripcion"></textarea>
				</div>
				<div class="form-group">
				  <label for="precio">Precio</label>
				  <input type="number" class="form-control" id="precio" placeholder="Ingrese el precio del curso" name="precio">
				</div>
				<input type="hidden" id="profesor" name="instructor" value="{{ Auth::user()->email }}">
				<div class="form-group">
					<label for="color">Color en el foro</label>
					<input type="color" id="color" name="color">
				</div>
				<div class="text-center">
				<button type="submit" class="btn btn-primary">Crear Clase</button>
				</div>
			  </form>
			</div>
		  </div>
		</div>
	</div>

	
	<script>
		$(document).ready(function() {
			$('form').on('submit', function(event) {
			event.preventDefault(); // Evita que el formulario se envíe normalmente

			// Obtiene el nombre del curso ingresado
			var formData = {
				title: $('#nombreCurso').val(),
				description: $('#descripcion').val(),
				color: $('#color').val(),
				accepts_threads: 1,
				is_private: 0,
				_token: '{{ csrf_token() }}'
			};

			// Realiza una solicitud AJAX al controlador del foro para crear la sección
			$.ajax({
				url: '{{ Forum::route('category.store') }}', // Reemplaza con la ruta adecuada para crear la sección del foro
				method: 'POST',
				data: formData,
				success: function(response) {
				// Sección creada exitosamente, puedes redirigir a otra página o realizar otras acciones
				$('form')[0].submit();
				// Aquí puedes agregar el código para redirigir a la página deseada o realizar otras acciones necesarias
				},
				error: function(xhr, status, error) {
				// Ocurrió un error al crear la sección del foro
				alert('Ocurrió un error al crear la sección del foro.');
				console.error(xhr.responseText);
				}
			});
			});
		});
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