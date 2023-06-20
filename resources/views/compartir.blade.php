<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi página con Bootstrap</title>
    <!-- Agregamos los estilos de Bootstrap -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/styleMisCursos.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
        }

        body {
            background-image: linear-gradient(135deg, rgba(57, 62, 70, 1) 0%, rgba(78, 204, 163, 1) 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            padding-top: 50px;
        }

        h1 {
            color: #fff;
            text-align: center;
            margin-bottom: 30px;
        }

        .table {
            background-color: #fff;
            border-radius: 4px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .table thead th {
            background-color: #343a40;
            color: #fff;
            font-weight: bold;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .table thead th:hover {
            background-color: #212529;
        }

        .table tbody td {
            border-top: none;
            color: #343a40;
        }

        .table tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .table tbody a {
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .table tbody a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Lista de Usuarios</h1>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nombre de usuario</th>
                        <th>Email</th>
                        <th>Nombre completo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($estudiantes as $usuario)
                        @if($usuario->id == Auth::user()->id)
                            @continue
                        @endif
                        <tr>
                            <td>
                                <img src="{{ asset('storage/' . $usuario->foto) }}" alt="Foto de perfil" class="img-fluid rounded-circle"
                                style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;">
                                <a href="{{route('compartir', ['id' => request()->route('id'), 'idE' => $usuario->id])}}">{{$usuario->nickname}}</a></td>
                            <td>{{$usuario->email}}</td>
                            <td>{{$usuario->nombrecompleto}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
</body>
</html>