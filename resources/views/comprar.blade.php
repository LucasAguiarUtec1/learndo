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
@extends('layouts.app')
@section('content')
	

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

	<form method="POST" action="{{route('paywithpaypal')}}">
	@csrf
	<div id="modal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Detalles de compra</h2>
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" disabled>
    <label for="precio">Precio:</label>
    <input type="int" id="precio" disabled>

    <label for="creditos">Créditos:</label>

    <label for="price">Seleccione cantidad de créditos a usar:</label>
    <input type="range" name="creditos" id="creditos" min="0" max="0" step="1" value="0">
    <input type="checkbox" id="aplicarDescuento">

    <label for="precioFinal">Precio final:</label>
    <input type="int" id="precioFinal" disabled>

    <button id="paypalBtn">
      <img src="paypal.jpg" alt="PayPal">
    </button>
  </div>
</div>
</form>


	<div class="container mt-5">

		<div class="row">
			<div class="col-md-4 offset-md-8">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Créditos</span>
					</div>
					@php
    $estudiante = app('App\Http\Controllers\UsuarioController')->obtenerEstudianteActual();
    $creditos = $estudiante ? $estudiante->creditos : 0;
@endphp
					<input type="number" id="creditosusu" class="form-control form-control-sm" value="{{ $creditos }}" readonly >
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
								Precio:	<h5 class="card-precio">{{$curso->precio}}</h5>
							<p class="card-text">Descripcion : {{$curso->descripcion}}</p>
							<a href="#" class="btn btn-primary comprarBtn" data-curso-id='{{$curso->id}}'>Comprar</a>
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




<!-- ...código anterior... -->

<div id="modal" class="modal">
<form method="POST" action="{{route('paywithpaypal')}}">
@csrf
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Detalles de compra</h2>
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" disabled>
    <label for="precio">Precio:</label>
    <input type="int" id="precio" disabled>

    <label for="creditos">Créditos:</label>

    <label for="price">Seleccione cantidad de créditos a usar:</label>
    <input type="range" name="creditos" id="creditos" min="0" max="0" step="1" value="0">
    <input type="checkbox" id="aplicarDescuento">

    <label for="precioFinal">Precio final:</label>
    <input type="int" id="precioFinal" disabled>

    <button id="paypalBtn">
      <img src="paypal.jpg" alt="PayPal">
    </button>
  </div>
</form>
</div>

<!-- ...código posterior... -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  const modal = document.getElementById("modal");
  const closeBtn = document.querySelector(".close");
  var overlay = document.getElementById("overlay");

  // Evento de clic en el botón "close"
  closeBtn.addEventListener("click", function () {
    modal.style.display = "none"; // Oculta el modal al hacer clic en "close"
    overlay.style.display = "none";
    updatePrecioFinal();
  });

  const comprarButtons = document.querySelectorAll(".comprarBtn");

  let button;
  comprarButtons.forEach(function (btn) {
    btn.addEventListener("click", function () {
      // Obtener los datos del curso/seminario correspondiente al botón "Comprar" clicado
      const precio = btn.closest(".card-body").querySelector(".card-precio").textContent;
      const nombre = btn.closest(".card-body").querySelector(".card-title").textContent;
      //id="creditosusu" class="form-control form-control-sm"
      // Establecer los valores en los campos del modal
      document.getElementById("precio").value = (precio);
      document.getElementById("nombre").value = nombre;
      if ({{ $creditos }}>precio) {
        document.getElementById("creditos").max = precio;
      } else document.getElementById("creditos").max = {{ $creditos }};

      // Asignar el valor a la variable button
      button = btn;

      // Mostrar el modal y el overlay
      document.getElementById("modal").style.display = "block";
      overlay.style.display = "block";

      // Actualizar el precio final
      updatePrecioFinal();
    });
  });

  document.getElementById("aplicarDescuento").addEventListener("change", function () {
    updatePrecioFinal();
  });

  document.getElementById("creditos").addEventListener("input", function () {
    updatePrecioFinal();
  });

  function updatePrecioFinal() {
    const precio = parseInt(button.closest(".card-body").querySelector(".card-precio").textContent);
    const creditos = parseInt(document.getElementById("creditos").value);
    const aplicarDescuento = document.getElementById("aplicarDescuento").checked;

    let precioFinal = precio;

    if (aplicarDescuento && creditos > 0) {
      precioFinal -= creditos;
    }

    document.getElementById("precioFinal").value = precioFinal;
  }
</script>

<!-- ...código posterior... -->
<script>
  // Agrega un listener de clic al botón de PayPal
  $('#paypalBtn').click(function() {
    // Obtén el total y la moneda desde algún lugar (por ejemplo, podrían ser variables en tu JavaScript)
	var total = document.getElementById('precioFinal').value; // Ejemplo: reemplaza 100 con la cantidad deseada
    var currency = 'USD'; // Ejemplo: reemplaza 'USD' con la moneda deseada

    // Realiza una solicitud AJAX al controlador de pagos
    $.ajax({
		url: 'http://localhost/learndo/public/paypal/pay',
  method: 'POST',
  data: {
    total: total,
    currency: currency
  },
  success: function(response) {
    // Redirige al usuario a la URL de aprobación de PayPal
    window.location.href = response.approvalUrl;
  },
  error: function(xhr, status, error) {
    // Maneja el error de conexión con PayPal
    console.error(error);
  }
});
  });
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
@endsection
</body>