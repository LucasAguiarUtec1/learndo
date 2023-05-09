<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function show()
    {
        $usuarios = Usuario::all();
        return view('usuarios', compact('usuarios'));
    }

    public function createEstudiante(Request $request)
    {

        $estudiante = new Estudiante();
        $estudiante->creditos = 0;
        $estudiante->save();

        $estudiante->usuario()->save(new Usuario([
            'nickname' => $request->nickname,
            'email' => $request->email,
            'password' => $request->password,
            'nombre' => $request->name,
            'apellido' => $request->lastname,
            'telefono' => $request->phone,
            'biografia' => $request->biography,
        ]));

        return redirect()->route('inicio');
    }
}
