<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Seminario</title>
    <!-- Agregamos los estilos de Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleSeminario.css') }}">
</head>
<body>
@extends('layouts.app')
@section('content')
    

    <div class="seminar-container">
        <div class="seminar-info">
            <img src="{{ asset($clase->foto) }}" alt="Foto de la clase">

            <h2>{{$clase->nombre}}</h2>
            <p>{{$clase->descripcion}}</p>
            <p>Precio: ${{$clase->precio}}</p>
            <p>Fecha: {{$clase->claseable->fecha}}</p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"></script>
    <script src="./custom.js"></script>
	@endsection
</body>
</html>
