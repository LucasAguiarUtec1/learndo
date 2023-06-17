<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Mi página con Bootstrap</title>
	<!-- Agregamos los estilos de Bootstrap -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/styleMisCursos.css')}}">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
@extends('layouts.app')
@section('content')
    

    <div class="container">
        <h1>Lista de Usuarios</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre de usuario</th>
                     <th>Email</th>
                     <th>Nombre completo</th>
                </tr>
             </thead>
            @foreach($usuarios as $usuario)
                <tbody>
                    <tr>
                        <td><a href="{{route('verperfil', $usuario->id)}}">{{$usuario->nickname}}</a></td>
                        <td>{{$usuario->email}}</td>
                        <td>{{$usuario->nombrecompleto}}</td>
                    </tr>
                </tbody>
            @endforeach
            </table>
        </div>
            

	<!-- Add your scripts here -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="./custom.js"></script>
@endsection
</body>
</html>