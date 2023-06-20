<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Mi página con Bootstrap</title>
	<!-- Agregamos los estilos de Bootstrap -->
	<link rel="stylesheet" type="text/css" href="{{asset('css/styleRegistroF.css')}}">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
		integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-light">
		<a class="navbar-brand" href="#">
			<img src="{{asset('images/1.png')}}" width="150" height="50" class="d-inline-block align-top" alt="Logo de Mi Página">
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
			aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav mr-auto">
			</ul>
			<ul class="navbar-nav">
			</ul>
		</div>
	</nav>

	<div class="container rounded border border-secondary p-4 mt-4">
		<h2 class="text-center">Registro con Facebook</h2>
		<div> <!-- Aumentado el tamaño del borde -->
			<div class="bordeContenedor">
			<img src="{{asset('images/perfil.jpg')}}" width="120" height="120" class="rounded-circle" alt="Foto de perfil">
		</div>
		<form method="POST" action="{{route('refreshinfo')}}" enctype="multipart/form-data">
			@csrf
			<input type="hidden" name="email_user" value="{{ $user->email }}">
		  <div class="form-group">
			<label for="nickname">Nickname</label>
			<input type="text" class="form-control shorter-input" id="nickname" placeholder="Ingrese su nickname" name="nick">
		  </div>
		  <div class="form-group">
			<label for="rol">Rol</label>
			<select class="form-control shorter-input" id="rol" name="rol">
			  <option>Estudiante</option>
			  <option>Organizador</option>
			</select>
		  </div>
		  <div class="form-group">
			<label for="imagen">Imagen de perfil</label>
			<input type="file" class="form-control-file" id="imagen" name="image">
		</div> 
		  <div class="registrarse text-center mt-4">
			<button type="submit" class="btn btn-primary shorter-button">Registrarse</button>
		  </div>  
		</form>
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