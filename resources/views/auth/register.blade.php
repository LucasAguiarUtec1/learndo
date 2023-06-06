<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Mi página con Bootstrap</title>
	<!-- Agregamos los estilos de Bootstrap -->
    <link rel="stylesheet" type="text/css" href="{{asset('images/stylesAltaUsuario.css')}}">
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
			</ul>
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="{{route('login')}}">Iniciar Sesión</a>
				</li>
			</ul>
		</div>
	</nav>

	<!-- Cuerpo de la página -->
<div class="container rounded border border-secondary p-4 mt-4">
	<h2>Registrarse</h2>
	<form method="POST" action="{{route('register')}}" enctype="multipart/form-data">
    @csrf
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="nickname">Nickname</label>
					<input type="text" class="form-control" id="nickname" placeholder="Ingrese su nickname" name="nickname" value="{{old('nickname')}}">
					@error('nickname')
						<br>
							<small>*{{$message}}</small>
						<br>
					@enderror
				</div>
				<div class="form-group">
					<label for="nombre">Nombre Completo</label>
					<input type="text" class="form-control" id="nombre" placeholder="Ingrese su nombre completo" name="name" value="{{old('name')}}">
					@error('name')
						<br>
							<small>*{{$message}}</small>
						<br>
					@enderror
				</div>
				<div class="form-group">
					<label for="email">Email</label>
					<input type="text" class="form-control" id="email" placeholder="Ingrese su email" name="email" value="{{old('email')}}">
					@error('email')
						<br>
							<small>*{{$message}}</small>
						<br>
					@enderror
				</div>
				<div class="form-group">
					<label for="telefono">Teléfono</label>
					<input type="text" class="form-control" id="telefono" placeholder="Ingrese su teléfono" name="phone" value="{{old('phone')}}">
					@error('phone')
						<br>
							<small>*{{$message}}</small>
						<br>
					@enderror
				</div>
				<div class="form-group">
					<label for="biografia">Biografía</label>
					<textarea class="form-control" id="biografia" rows="3" placeholder="Ingrese su biografía" name="biography" value="{{old('biography')}}"></textarea>
					@error('biography')
						<br>
							<small>*{{$message}}</small>
						<br>
					@enderror
				</div>
				
			</div>
			<div class="col-md-6">
				
				<div class="form-group">
					<label for="contrasena">Contraseña</label>
					<input type="password" class="form-control" id="contrasena" placeholder="Ingrese su contraseña" name="password" value="{{old('password')}}">
					@error('password')
						<br>
							<small>*{{$message}}</small>
						<br>
					@enderror
				</div>
					<div class="form-group">
					<label for="repetirContrasena">Repetir Contraseña</label>
					<input type="password" class="form-control" id="repetirContrasena" placeholder="Repita su contraseña" name="password_confirmation" value="{{old('password_confirmation')}}">
					@error('password_confirmation')
						<br>
							<small>*{{$message}}</small>
						<br>
					@enderror
				</div>
				<div class="form-group">
					<label for="rol">Rol</label>
					<select class="form-control" id="rol" name="rol" value="{{old('rol')}}">
						<option>Estudiante</option>
						<option>Colaborador</option>
						<option>Organizador</option>
					</select>
					@error('rol')
						<br>
							<small>*{{$message}}</small>
						<br>
					@enderror
				</div>
				 <div class="form-group">
					<label for="imagen">Imagen de perfil</label>
					<input type="file" class="form-control-file" id="imagen" name="image">
				</div> 
			</div>
		</div>
		<div class="registrarse"> 
		<button type="submit" class="btn btn-primary">Registrarse</button>
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