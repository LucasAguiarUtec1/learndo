<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Mi página con Bootstrap</title>
	<!-- Agregamos los estilos de Bootstrap -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/styleModuloProfesor.css')}}">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
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
					<a class="nav-link" href="{{route('inicio')}}">Inicio </a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{route('miscursos')}}">Mis Cursos <span class="sr-only">(current)</span></a>
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
		<div class="card mt-4 modulo" id="modulo-1">
			<div class="card-header" style="background-color: #c9c5c5;">
				<h5 class="mb-0">{{$clase->nombre}}</h5>
			</div>
		</div>
	
		<div class="row mt-4">
			<div class="col-sm-12 col-md-6">
				<button class="btn btn-success" data-toggle="modal" data-target="#modulo-modal">Añadir Módulo</button>
			</div>
		</div>
		@foreach($modulos as $modulo)
		<div class="card mt-4 modulo" id="modulo-1">
			<div class="card-header">
				<h5 class="mb-0">{{$modulo->nombre}}</h5>
			</div>
	
			<div class="card-body">
				<ul class="list-group">
					<li class="list-group-item">
						<img src="{{asset('images/libro.png')}}" alt="Icono de libro" class="mr-3" width="30" height="30">
						<a href="#">Lecciones</a>
						<button class="btn btn-danger float-right">Eliminar</button>
					</li>
					<li class="list-group-item">
						<img src="{{asset('images/multimedia.png')}}" alt="Icono de video" class="mr-3" width="30" height="30">
						<a href="#">Contenido Multimedia</a>
						<button class="btn btn-danger float-right">Eliminar</button>
					</li>
					<li class="list-group-item">
						<img src="{{asset('images/lapiz.png')}}" alt="Icono de lápiz" class="mr-3" width="30" height="30">
						<a href="#">Evaluaciones</a>
						<button class="btn btn-danger float-right">Eliminar</button>
					</li>
					<div class="card">
						<div class="card-body text-center">
							<button class="btn btn-success" data-toggle="modal" data-target="#leccion-modal" data-modulo-id="{{$modulo->id}}">
								<img src="{{asset('images/libro.png')}}" alt="Icono" class="mr-2" width="20" height="20">
								Añadir Lección
							</button>
	
							<button class="btn btn-success" data-toggle="modal" data-target="#multimedia-modal">
								<img src="{{asset('images/multimedia.png')}}" alt="Icono" class="mr-2" width="20" height="20">
								Añadir Contenido Multimedia
							</button>
	
							<button class="btn btn-success" data-toggle="modal" data-target="#evaluacion-modal">
								<img src="{{asset('images/lapiz.png')}}" alt="Icono" class="mr-2" width="20" height="20">
								Añadir Evaluación
							</button>
							<a href="{{route('eliminarModulo', ['id' => $clase->id, 'idMod' => $modulo->id])}}" class="btn btn-danger float-right mt-2">Eliminar Módulo</a>
						</div>
					</div>
				</ul>
			</div>
		</div>
		@endforeach
	</div>

	
	
	<!-- Modal para añadir lección -->
	<div class="modal fade" id="leccion-modal" tabindex="-1" role="dialog" aria-labelledby="leccion-modal-label"
		aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="leccion-modal-label">Añadir Lección</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="GET" action="{{route('uploadPDF')}}" enctype="multipart/form-data">
						@csrf
						<div class="form-group">
							<label for="nombre-leccion">Nombre de la Lección</label>
							<input type="text" class="form-control" id="nombre-leccion" placeholder="Ingrese el nombre de la lección" name="name">
						</div>
						<div class="form-group">
							<label for="pdf-leccion">Archivo PDF</label>
							<input type="file" class="form-control-file" id="pdf-leccion" name="pdf_file">
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
							<button type="submit" class="btn btn-primary">Guardar</button>
						</div>
					</form>
				</div>
			</div>
		</div>	
	</div>

	<!-- Modal para añadir Modulo -->
	<div class="modal fade" id="modulo-modal" tabindex="-1" role="dialog" aria-labelledby="modulo-modal-label"
		aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modulo-modal-label">Añadir Modulo</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="POST" action="{{route('crearModulo', $clase->id)}}">
						@csrf
						<div class="form-group">
							<label for="nombre-modulo">Nombre Del Modulo</label>
							<input type="text" class="form-control" id="nombre-modulo" placeholder="Ingrese el nombre del Modulo" name="name">
						</div>
						<div class="form-group">
							<label for="descripcion">Descripción:</label>
							<textarea class="form-control" id="descripcion" rows="5" name="descripcion"></textarea>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
							<button type="submit" class="btn btn-primary">Guardar</button>
						</div>
					</form>
				</div>
			</div>
		</div>	
	</div>

	<!-- Modal para añadir evaluación -->
	<!--
<div class="modal fade" id="evaluacion-modal" tabindex="-1" role="dialog" aria-labelledby="evaluacion-modal-label" aria-hidden="true">
	<div class="modal-dialog" role="document">
	  <div class="modal-content">
		<div class="modal-header">
		  <h5 class="modal-title" id="evaluacion-modal-label">Añadir Evaluación</h5>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body">
		  <form>
			<div class="form-group">
			  <label for="nombre-evaluacion">Nombre de la Evaluación</label>
			  <input type="text" class="form-control" id="nombre-evaluacion" placeholder="Ingrese el nombre de la evaluación">
			</div>
			<div class="form-group">
			  <label for="archivo-evaluacion">Archivo PDF</label>
			  <input type="file" class="form-control-file" id="archivo-evaluacion">
			</div>
		  </form>
		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
		  <button type="button" class="btn btn-primary">Guardar</button>
		</div>
	  </div>
	</div>
  </div>
-->
<!-- Modal para añadir contenido multimedia -->
<div class="modal fade" id="multimedia-modal" tabindex="-1" role="dialog" aria-labelledby="multimedia-modal-label" aria-hidden="true">
	<div class="modal-dialog" role="document">
	  <div class="modal-content">
		<div class="modal-header">
		  <h5 class="modal-title" id="multimedia-modal-label">Añadir Contenido Multimedia</h5>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body">
		  <form>
			<div class="form-group">
			  <label for="video-url">URL del video</label>
			  <input type="text" class="form-control" id="video-url" placeholder="Ingrese la URL del video">
			</div>
		  </form>
		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
		  <button type="button" class="btn btn-primary">Guardar</button>
		</div>
	  </div>
	</div>
  </div>
	
	<script>
		// Obtener todos los elementos con la clase "modulo"
		var modulos = document.querySelectorAll(".modulo");
	  
		// Agregar evento clic al título de cada módulo
		modulos.forEach(function (modulo) {
		  var cardHeader = modulo.querySelector(".card-header");
	  
		  cardHeader.addEventListener("click", function () {
			var cardBody = modulo.querySelector(".card-body");
			cardBody.classList.toggle("d-none");
		  });
		});
	</script>


<script>
  $('#leccion-modal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var moduloId = button.data('modulo-id');
    var form = $(this).find('form');
    var action = form.attr('action');
    action = action.replace('{modulo}', moduloId);
    form.attr('action', action);

    function agregarLeccion(moduloId) {
      var url = 'http://localhost/learndo/public/uploadPDF';
      var formData = new FormData(form[0]);
      formData.append('moduloId', moduloId);

      $.ajax({
        url: url,
        method: 'GET',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          alert(response.message);
          $('#leccion-modal').modal('hide');
          location.reload();
        },
        error: function(jqXHR, textStatus, errorThrown) {
			if (jqXHR.status === 422) {
        var errors = jqXHR.responseJSON.errors;
        // Mostrar los mensajes de error al usuario
        for (var key in errors) {
            if (errors.hasOwnProperty(key)) {
                var errorMessage = errors[key][0];
                alert(errorMessage);
            }
        }
    }
        }
      });
    }

    $('#leccion-modal').on('click', '.btn-primary', function(e) {
      e.preventDefault();
      agregarLeccion(moduloId);
      $('#leccion-modal').modal('hide');
    });
  });
</script>

  



	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>
	

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
	integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
	crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
	integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE"
	crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
	integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ"
	crossorigin="anonymous"></script>

	<!-- Agrega jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Agrega los archivos de Bootstrap: Popper.js y Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

	<!--JAVASCRIPT-->

	<script src="./custom.js"></script>

</body>