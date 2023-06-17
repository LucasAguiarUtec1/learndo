<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Mi página con Bootstrap</title>
	
	<!--JAVASCRIPT-->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
	<!-- Agregamos los estilos de Bootstrap -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/styleEvaluacion.css')}}">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
@extends('layouts.app')
@section('content')

	<form method="POST" action="{{route('crearEvaluacion', $modulo->id)}}">
        @csrf
        <h2>Nueva Evaluacion</h2>
        <div class="form-group">
            <label for="pregunta">Nombre de la evaluación:</label>
            <input type="text" class="form-control" name="nombre">
        </div>

        <!-- Cuerpo de la página -->
    <div class="container">
        <div id="preguntas-container">
            <!-- Aquí se agregarán las tarjetas de preguntas dinámicamente -->
        </div>
        
        <button id="alta-evaluacion" class="btn btn-success">Aceptar</button>
        <button id="agregar-pregunta" class="btn btn-primary" type="button">Agregar Pregunta</button>
    </div>


    <!-- Plantilla de tarjeta de pregunta oculta -->
    
    <div id="plantilla-pregunta" style="display: none;">
        <div class="card mb-3">
            <div class="card-body">
                <div class="form-group">
                    <label for="pregunta">Pregunta:</label>
                    <input type="text" class="form-control" name="pregunta">
                </div>
                <div class="form-group">
                    <label>Opciones de respuesta:</label>
                    <div class="opciones-container">
                        <div class="opcion">
                            <div class="row align-items-center">
                            <div class="col-md-1">
                                <div class="form-check">
                                <input class="form-check-input d-block" type="checkbox" name="correcta">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="opcion" placeholder="Respuesta">
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-danger eliminar-opcion" style="padding top: 10px;" type="button">Eliminar</button>
                            </div>
                            </div>
                        </div>
                </div>
                <button class="btn btn-primary agregar-opcion" type="button">Agregar Respuesta</button>
                    <button class="btn btn-danger eliminar-pregunta" type="button">Eliminar Pregunta</button>
            </div>
        </div>
    </div>
</form>

<!-- Javascript -->
<script>
	$(document).ready(function() {
  // Manejador de evento para agregar una tarjeta de pregunta
  $("#agregar-pregunta").click(function() {
    // Clonar la plantilla de pregunta oculta y mostrarla
    var plantilla = $("#plantilla-pregunta").clone().removeAttr("id").removeAttr("style");
    $("#preguntas-container").append(plantilla);

    // Manejador de evento para eliminar una pregunta
    plantilla.find(".eliminar-pregunta").click(function() {
      $(this).closest(".card").remove();
    });

    // Manejador de evento para agregar una opción de respuesta
    plantilla.on("click", ".agregar-opcion", function() {
      var opcionesContainer = $(this).closest(".card-body").find(".opciones-container");
      var opciones = opcionesContainer.find(".opcion");

      if (opciones.length > 0) {
        var opcion = opciones.first().clone();
        opcion.find("input").val("");
        opcionesContainer.append(opcion);
      } else {
        var nuevaOpcionHTML = `
          <div class="opcion">
            <div class="row align-items-center">
              <div class="col-md-1">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="correcta">
                </div>
              </div>
              <div class="col-md-8">
                <input type="text" class="form-control" name="opcion" placeholder="Opción">
              </div>
              <div class="col-md-3">
                <button class="btn btn-danger eliminar-opcion">Eliminar</button>
              </div>
            </div>
          </div>
        `;
        opcionesContainer.append(nuevaOpcionHTML);
      }
    });

    // Manejador de evento para eliminar una opción de respuesta
    plantilla.on("click", ".eliminar-opcion", function() {
      $(this).closest(".opcion").remove();
    });
  });

  // Manejador de evento para eliminar una opción de respuesta
  $(document).on("click", ".eliminar-opcion", function() {
    $(this).closest(".opcion").remove();
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