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

<h2>{{$evaluacion->nombre}}</h2>
<br>
<br>
<form id="evaluacion-form" method="POST" action="{{route('ConfirmarEvaluacion')}}" enctype="multipart/form-data">
    @csrf
    <div class="container">
        @foreach($preguntas as $pregunta)
            <div class="card mb-3">
                <div class="card-body text-center">
                    <h5 class="card-title">{{$pregunta->pregunta}}</h5>
                    <br>
                    @foreach($respuestas as $respuesta)
                        @if($respuesta->pregunta_id == $pregunta->id)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="respuestas[{{$pregunta->id}}]" id="respuesta{{$respuesta->id}}" value="{{$respuesta->id}}">
                                <label class="form-check-label" for="respuesta{{$respuesta->id}}">
                                    {{$respuesta->respuesta}}
                                </label>
                            </div>
                            <br>
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach
        <input type="hidden" name="evaluacion_id" value="{{$evaluacion->id}}">
        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-lg" style="font-size: 24px;">Enviar</button>
        </div>
    </div>
</form>
</div>

<script>
    $(document).ready(function() {
        $('#evaluacion-form').submit(function(event) {
            // Obtener todas las preguntas del formulario
            var preguntas = $(this).find('input[type="radio"]');

            // Verificar si alguna pregunta no ha sido respondida
            var algunaPreguntaSinResponder = false;

            preguntas.each(function() {
                var nombrePregunta = $(this).attr('name');
                var respuestasSeleccionadas = $('input[name="' + nombrePregunta + '"]:checked').length;

                if (respuestasSeleccionadas === 0) {
                    algunaPreguntaSinResponder = true;
                    return false; // Detener el bucle each si una pregunta no ha sido respondida
                }
            });

            // Si hay alguna pregunta sin responder, mostrar un mensaje y detener el envío del formulario
            if (algunaPreguntaSinResponder) {
                alert('Por favor, responde todas las preguntas antes de enviar el formulario.');
                event.preventDefault();
            }
        });
    });
</script>

@endsection
</body>