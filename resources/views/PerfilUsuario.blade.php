<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Mi página con Bootstrap</title>
	<!-- Agregamos los estilos de Bootstrap -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/stylePerfilUsuario.css')}}">
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
	<!-- Cuerpo de la página -->
	<div class="container mx-auto my-5">
		<div class="row">
			<div class="col-md-4 text-center">
					<img src="{{ asset('storage/' . $usuario->foto) }}" alt="Foto de perfil" class="img-fluid rounded-circle"
                    style="width: 200px; height: 200px; object-fit: cover; border-radius: 50%;">
				<h4 style="padding-top: 10px; padding-bottom: 10px;"><strong>{{$usuario->nickname}}</strong></h4>
				<div>
					@if(Auth::check() && Auth::user()->nickname == $usuario->nickname)
					<button id="edit-button" class="btn btn-primary align-content-center text-center">Editar</button>
					@endif
					@if(Auth::check() && Auth::user()->nickname != $usuario->nickname)
					<button id="mensaje-button" class="btn btn-primary align-content-center text-center" >Enviar Mensaje</button>
					@endif
				</div>
			</div>
			<div class="col-md-8" style="padding: 30px;">
				<h4><strong>{{$usuario->nombrecompleto}}</strong></h4>
				<p>{{$usuario->biografia}}</p>
					
				<!-- Modal -->
				<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
					aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="editModalLabel">Editar Perfil</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal"
									aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<div class="mb-3">
									<label for="nameInput" class="form-label">Nombre</label>
									<input type="text" class="form-control" id="nameInput"
										placeholder="Ingrese su nombre">
								</div>
								<div class="mb-3">
									<label for="nicknameInput" class="form-label">Nickname</label>
									<input type="text" class="form-control" id="nicknameInput"
										placeholder="Ingrese su nickname">
								</div>
								<div class="mb-3">
									<label for="bioInput" class="form-label">Biografía</label>
									<textarea class="form-control" id="bioInput" rows="3"
										placeholder="Ingrese su biografía"></textarea>
								</div>
								<div class="mb-3">
									<label for="photoInput" class="form-label">Foto</label>
									<input type="file" class="form-control" id="photoInput">
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
								<button type="button" class="btn btn-primary">Guardar cambios</button>
							</div>
						</div>
					</div>
				</div>

				<script>
					document.getElementById("edit-button").addEventListener("click", function () {
						$('#editModal').modal('show');
					});
				</script>


				<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
				<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
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




</html>