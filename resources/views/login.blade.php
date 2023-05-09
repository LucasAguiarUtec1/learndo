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
  <form method="POST" action="{{route('registro')}}">

    @csrf
    <label>Correo electrónico: </label>
    <input type="email" name="email" placeholder="Correo electrónico" required>
    <br><br>
    
    <label>Nickname: </label>
    <input type="text" name="nickname" placeholder="Nickname" required>
    <br><br>

    <label>Nombre: </label>
    <input type="text" name="name" placeholder="Nombre" required>
    <br><br>

    <label>Apellido: </label>
    <input type="text" name="lastname" placeholder="Apellido" required>
    <br><br>

    <label>Telefono </label>
    <input type="text" name="phone" placeholder="Telefono" required>

    <br><br>

    <label>Biografia: </label>
    <input type="text" name="biography" placeholder="Biografia" required>
    <br><br>

    <label>Contraseña: </label>
    <input type="password" name="password" placeholder="Contraseña" required>
    <br><br>

    <button type="submit">registrarme</button>
  </form>

</body>
</html>
        
  
