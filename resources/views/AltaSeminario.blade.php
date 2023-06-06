<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Mi página con Bootstrap</title>
	<!-- Agregamos Api de google maps -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB4CBnz1IbIRqZQ-NULt4Ygcyh-R9D0Qu8&callback=initMap" async defer></script>
	<!-- Agregamos los estilos de Bootstrap -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/stylesSeminario.css')}}">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<!--JAVASCRIPT-->     <script> src="https://code.jquery.com/jquery-3.6.0.min.js%22%3E" </script>     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
	
</head>
<body>
	<script>
		function mostrarCamposAdicionales(tipo) {
			var presencialFields = document.getElementById("presencialFields");
			var virtualFields = document.getElementById("virtualFields");
	
			if (tipo === "Presencial") {
				presencialFields.style.display = "block";
				virtualFields.style.display = "none";
			} else if (tipo === "Virtual") {
            presencialFields.style.display = "none";
            virtualFields.style.display = "block";
        } else {
            presencialFields.style.display = "block";
            virtualFields.style.display = "none";
        }
    }</script>
	<nav class="navbar navbar-expand-lg navbar-light">
		<a class="navbar-brand" href="{{route('inicio')}}">
			<img src="{{asset('images/1.png')}}" width="150" height="50" class="d-inline-block align-top" alt="Logo de Mi Página">
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			</ul>
			</ul>
		</div>
	</nav>
	<div class="container rounded border border-secondary p-4 mt-4">
		<div class="row">
			<div class="col-md-6 offset-md-3">
				<h2>Alta Seminario</h2>
				<form method="POST" action="{{route('registrarseminario')}}" enctype="multipart/form-data">
					@csrf
					<div class="form-group">
						<label for="nombreSeminario">Nombre del Seminario</label>
						<input type="text" class="form-control" id="nombreCurso" placeholder="Ingrese el nombre del curso" name="name" value="{{old('name')}}">
						@error('name')
						<br>
							<small>*{{$message}}</small>
						<br>
					@enderror
					</div>
					<div class="form-group">
						<label for="descripcion">Descripción</label>
						<textarea class="form-control" id="descripcion" rows="4" placeholder="Ingrese la descripción del curso" name="descripcion" value="{{old('descripcion')}}"></textarea>
						@error('descripcion')
						<br>
							<small>*{{$message}}</small>
						<br>
					@enderror
					</div>
					<div class="form-group">
						<label for="fecha">Fecha</label>
						<input type="date" class="form-control" id="fecha" name="fecha" value="{{old('fecha')}}">
						@error('fecha')
						<br>
							<small>*{{$message}}</small>
						<br>
					@enderror
					</div>
					<div class="form-group">
						<label for="hora">Hora</label>
						<input type="time" class="form-control" id="hora" name="hora" value="{{old('hora')}}">
						@error('hora')
						<br>
							<small>*{{$message}}</small>
						<br>
					@enderror
					</div>
					<div class="form-group">
						<label for="tipo">Tipo</label>
						<select class="form-control" id="tipo" onchange="mostrarCamposAdicionales(this.value)" name="tipo">
							<option value="Presencial">Presencial</option>
							<option value="Virtual">Virtual</option>
						</select>
					</div>
					<div id="presencialFields" style="display: none;">
						<div class="form-group">
							<label for="ubicacion">Ubicación</label>
							<input type="text" class="form-control" id="ubicacion" placeholder="Ingrese la ubicación" name="ubi">
							<div id="mapa" style="width: 100%; height: 400px; margin-top: 10px;"></div>
						</div>
						<div class="form-group">
							<label for="maxParticipantes">Máximo de participantes</label>
							<input type="number" class="form-control" id="maxParticipantes" placeholder="Ingrese el máximo de participantes" name="participantes" value="{{old('participantes')}}">
							@error('participantes')
						<br>
							<small>*{{$message}}</small>
						<br>
					@enderror
						</div>
						
					</div>
					<div id="virtualFields" style="display: none;">
						<div class="form-group">
							<label for="plataforma">Plataforma</label>
							<input type="text" class="form-control" id="plataforma" placeholder="Ingrese la plataforma" name="plataforma" value="{{old('plataforma')}}">
							@error('plataforma')
						<br>
							<small>*{{$message}}</small>
						<br>
					@enderror
						</div>
						
					</div>
					<div class="form-group">
						<label for="precio">Precio</label>
						<input type="number" class="form-control" id="precio" placeholder="Ingrese el precio del curso" name="precio" value="{{old('precio')}}">
						@error('precio')
						<br>
							<small>*{{$message}}</small>
						<br>
					@enderror
					</div>
					<div class="form-group">
						<label for="imagen">Imagen de perfil</label>
						<input type="file" class="form-control-file" id="imagen" name="image" value="{{old('image')}}">
						@error('image')
						<br>
							<small>*{{$message}}</small>
						<br>
					@enderror
					</div> 
					<div class="text-center">
						<button type="submit" class="btn btn-primary">Crear Clase</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	
	
	<script>
		var map;
		var marker;

		function initMap() {
			var ubicacionInput = document.getElementById("ubicacion");
			var mapaDiv = document.getElementById("mapa");

			map = new google.maps.Map(mapaDiv, {
				center: { lat: 0, lng: 0 },
				zoom: 15
			});

			marker = new google.maps.Marker({
				map: map,
				draggable: true
			});

			google.maps.event.addListener(map, 'click', function(event) {
				marker.setPosition(event.latLng);
				ubicacionInput.value = event.latLng.lat() + ', ' + event.latLng.lng();
			});
}

// Llamada a la funciÃ³n initMap una vez que se haya cargado la API de Google Maps
window.addEventListener('load', initMap);
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
<!--	<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
	<script src="./custom.js"></script> -->

</body>