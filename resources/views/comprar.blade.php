<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Mi página con Bootstrap</title>
	<!-- Agregamos los estilos de Bootstrap -->
	<link rel="stylesheet" type="text/css" href="{{asset('css/styleComprar.css')}}">


	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
		integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
					<a class="nav-link" href="{{route('mapa')}}">Mapa<span class="sr-only">(current)</span></a>
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

	<div id="overlay" style="display: none;"></div>

	<div>
		<h2>Comprar Cursos</h2>
		<div class="toggle-button">
			<label class="switch">
				<input type="checkbox" id="toggleButton">
				<span class="slider round">
					<span class="on-text">Seminarios</span>
					<span class="off-text">Cursos</span>
				</span>
			</label>
		</div>
	</div>

	

	<div id="modal" class="modal">
		<div class="modal-content">
			<span class="close">&times;</span>
			<h2>Detalles de compra</h2>
			<label for="precio">Precio:</label>
			<input type="text" id="precio" disabled>

			<label for="creditos">Créditos:</label>
			<input type="text" id="creditos">

			<label for="aplicarDescuento">Aplicar descuento con créditos:</label>
			<input type="checkbox" id="aplicarDescuento">

			<label for="precioFinal">Precio final:</label>
			<input type="text" id="precioFinal" disabled>

			<button id="paypalBtn">
				<img src="paypal.jpg" alt="PayPal">
			</button>
		</div>
	</div>


	<div class="container mt-5">

		<div class="row">
			<div class="col-md-4 offset-md-8">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Créditos</span>
					</div>
					<input type="text" class="form-control form-control-sm" value="{{Auth::user()->creditos}}" readonly>
					<div class="input-group-append">
						<span class="input-group-text">$</span>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container-center" id="cursosContainer" style="display: block;">
		<div class="containerCard mt-5">
			<div class="row">
				@foreach($cursos as $curso)
				<div class="col-md-2">
					<div class="card">
						@if($curso->foto != null)
						<img src="{{ asset($curso->foto) }}" class="card-img-top img-fluid border-bottom" alt="..." style="width: 100%; height: 200px;">
						@else
						<img src="{{asset('images/perfil.jpg')}}" class="card-img-top img-fluid border-bottom" alt="..." style="width: 100%; height: 200px;">
						@endif
						<div class="card-body border-top">
							<h5 class="card-title">{{$curso->nombre}}</h5>
							<p class="card-text">{{$curso->descripcion}}</p>
							<a href="#" class="btn btn-primary comprarBtn">Comprar</a>
						</div>
					</div>
				</div>
				@endforeach
			</div>
			
		</div>
		<div class="custom-pagination">
			{{ $cursos->links() }}
		</div>
	</div>

	<div class="container-center" id="seminariosContainer" style="display: none;">
		<div class="containerCard mt-5">
			<div class="row">
				@foreach($seminarios as $seminario)
				<div class="col-md-2">
					<div class="card">
						@if($seminario->foto != null)
						<img src="{{asset($seminario->foto)}}" class="card-img-top img-fluid border-bottom" alt="..."
							style="width: 100%; height: 200px;">
						@else
						<img src="{{asset('images/perfil.jpg')}}" class="card-img-top img-fluid border-bottom" alt="..."
							style="width: 100%; height: 200px;">
						@endif
						<div class="card-body border-top">
							<h5 class="card-title">{{$seminario->nombre}}</h5>
							<p class="card-text">{{$seminario->descripcion}}</p>
							<a href="#" class="btn btn-primary comprarBtn">Comprar</a>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
		<div class="custom-pagination">
			{{ $seminarios->links() }}
		</div>
	</div>




	<script>
		const modal = document.getElementById("modal");
		const closeBtn = document.querySelector(".close");
		var overlay = document.getElementById("overlay");

		// Evento de clic en el botón "close"
		closeBtn.addEventListener("click", function () {
			modal.style.display = "none"; // Oculta el modal al hacer clic en "close"
			overlay.style.display = "none";
		});

		const comprarButtons = document.querySelectorAll(".comprarBtn");
		

		comprarButtons.forEach(function (button) {
			button.addEventListener("click", function () {
				document.getElementById("modal").style.display = "block";
				overlay.style.display = "block";
			});
		});

		document.getElementById("aplicarDescuento").addEventListener("change", function () {
			updatePrecioFinal();
		});

		document.getElementById("creditos").addEventListener("input", function () {
			updatePrecioFinal();
		});

		function updatePrecioFinal() {
			const precio = 100; // Precio base
			const creditos = parseInt(document.getElementById("creditos").value);
			const aplicarDescuento = document.getElementById("aplicarDescuento").checked;

			let precioFinal = precio;

			if (aplicarDescuento && creditos > 0) {
				precioFinal -= creditos;
			}

			document.getElementById("precio").value = precio;
			document.getElementById("precioFinal").value = precioFinal;
		}
	</script>
	<script>
		// Obtener referencias a los elementos del DOM
		const toggleButton = document.getElementById('toggleButton');
		const seminariosContainer = document.getElementById('seminariosContainer');
		const cursosContainer = document.getElementById('cursosContainer');

		// Agregar un listener para el cambio de estado del botón
		toggleButton.addEventListener('change', function () {
			if (toggleButton.checked) {
				// Si el botón está marcado (Seminarios seleccionado), mostrar el contenedor de Seminarios y ocultar el contenedor de Cursos
				seminariosContainer.style.display = 'block';
				cursosContainer.style.display = 'none';
			} else {
				// Si el botón no está marcado (Cursos seleccionado), mostrar el contenedor de Cursos y ocultar el contenedor de Seminarios
				seminariosContainer.style.display = 'none';
				cursosContainer.style.display = 'block';
			}
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

</body>