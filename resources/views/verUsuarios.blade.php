<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>List of Users</title>
	<!-- Add your stylesheets here -->
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Lista de Usuarios</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre de usuario</th>
                     <th>Email</th>
                     <th>Nombre completo</th>
                    <th>Teléfono</th>
                </tr>
             </thead>
            @foreach($usuarios as $usuario)
                <tbody>
                    <tr>
                        <td><a href="{{route('verperfil', $usuario->nickname)}}">{{$usuario->nickname}}</a></td>
                        <td>{{$usuario->email}}</td>
                        <td>{{$usuario->nombrecompleto}}</td>
                        <td>{{$usuario->telefono}}</td>
                    </tr>
                </tbody>
            @endforeach
            </table>
        </div>
            

	<!-- Add your scripts here -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="./custom.js"></script>
</body>
</html>