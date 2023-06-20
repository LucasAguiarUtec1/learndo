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
@extends('layouts.app')
@section('content')

	<!-- Cuerpo de la página -->
	<div class="container mx-auto my-5">
		<div class="row">
			<div class="col-md-4 text-center">
					<img src="{{ asset('storage/' . $usuario->foto) }}" alt="Foto de perfil" class="img-fluid rounded-circle"
                    style="width: 200px; height: 200px; object-fit: cover; border-radius: 50%;">
				<h4 style="padding-top: 10px; padding-bottom: 10px;"><strong>{{$usuario->nickname}}</strong></h4>
				<div>
					@if(Auth::check() && Auth::user()->nickname == $usuario->nickname)
						<!-- <button id="edit-button" class="btn btn-primary align-content-center text-center">Editar</button> -->
					@endif
					@if($usuario->userable_type == 'App\Models\Colaborador')
						@if( Auth::user()->userable_type == 'App\Models\Organizador')
							<button id="invite-button" class="btn btn-primary align-content-center text-center">Invitar a colaborar</button>
						@endif
					@endif
					@if(Auth::check() && Auth::user()->nickname != $usuario->nickname)
						<button id="mensaje-button" class="btn btn-primary align-content-center text-center" >
						<a href="{{route('chat', $usuario->id)}}" style="color: white;">Enviar Mensaje</a>
						</button>
					@endif
				</div>
			</div>
			<div class="col-md-8" style="padding: 30px;">
				<h4><strong>{{$usuario->nombrecompleto}}</strong></h4>
				<p>{{$usuario->biografia}}</p>
				@if($usuario->userable_type == 'App\Models\Organizador')
					<h4 style="padding-top: 10px; padding-bottom: 10px;"><strong>Profesor en los siguientes cursos:</strong></h4>
					@php
						$imprimioCurso = false;
					@endphp
					@php
						$imprimioSem = false;
					@endphp
					@foreach($cursos as $curso)
						@if($curso->claseable_type == 'App\Models\Curso')
							<a href="{{route('modulos', $curso->id)}}">{{$curso->nombre}}</a>
							<br>
							@php
								$imprimioCurso = true;
							@endphp
						@endif
					@endforeach
					@if(!$imprimioCurso)
						<p>Aún no es profesor de ningún curso</p>
					@endif
					<h4 style="padding-top: 10px; padding-bottom: 10px;"><strong>Profesor en los siguientes seminarios:</strong></h4>
					@foreach($cursos as $curso)
						@if($curso->claseable_type == 'App\Models\Seminario')
							<a href="{{route('modulos', $curso->id)}}">{{$curso->nombre}}</a>
							<br>
							@php
								$imprimioSem = true;
							@endphp
						@endif
					@endforeach
					@if(!$imprimioSem)
						<p>Aún no es profesor de ningún seminario</p>
					@endif
				@endif
					
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

				<!-- Modal -->
				<div class="modal fade" id="inviteModal" tabindex="-1" aria-labelledby="inviteModalLabel"
					aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="inviteModalLabel">Invitación a colaborar</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal"
									aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<form>
									<div class="mb-3">
										<label for="cursoSelect" class="form-label">Seleccione un curso:</label>
										<select class="form-select" id="cursoSelect" name="cursoSelect">
											@foreach($cursos_propios as $curso)
												<option value="{{ $curso->id }}">{{ $curso->nombre }}</option>
											@endforeach
										</select>
									</div>
								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
								<button type="button" class="btn btn-primary">Invitar</button>
							</div>
						</div>
					</div>
				</div>

				<script>
					document.getElementById("edit-button").addEventListener("click", function () {
						$('#editModal').modal('show');
					});
				</script>

				<script>
					document.getElementById("invite-button").addEventListener("click", function () {
						$('#inviteModal').modal('show');
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
@endsection
</body>




</html>