<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar sesión - LearnDo</title>
  <!-- Importar Tailwind CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.15/tailwind.min.css" integrity="sha512-R/4JfXivY9Q2fKkZ5+/ikKWmL5z5p5jDdJy/NxSS1F8X9kLR19gTp7oiU6bW1HBViF1Jb2i6zhxvDUoHgK8i9Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <h1> Usuarios registrados </h1>

    @foreach ($usuarios as $usuario)
        <li> {{$usuario->nickname}} </li>
        <br><br>
        <li> {{$usuario->nombre}} </li>
        <br><br>
        <li> {{$usuario->apellido}} </li>
        <br><br>
        <li> ----------------------------------- </li>
        <br><br>
    @endforeach

</body>
</html>
        
  
