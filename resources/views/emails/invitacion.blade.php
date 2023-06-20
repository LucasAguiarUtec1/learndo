<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invitación a colaborar</title>
</head>
<body>
    <h1>Invitación a colaborar</h1>
    <p>¡Hola {{ $usuario->nombrecompleto }}!</p>
    <p>Has sido invitado a colaborar en el curso "{{ $curso->nombre }}".</p>
    <p>Haz clic en el siguiente botón para aceptar la invitación:</p>
    <a href="{{ route('aceptar.invitacion', ['cursoId' => $curso->id, 'usuarioId' => $usuario->id, 'eltoken' => $token]) }}" target="_blank">Aceptar Invitación</a>
</body>
</html>