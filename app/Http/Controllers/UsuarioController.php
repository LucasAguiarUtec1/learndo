<?php

namespace App\Http\Controllers;

use App\Models\Organizador;
use App\Models\Estudiante;
use App\Models\Colaborador;
use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function show()
    {
        $usuarios = Usuario::all();
        return view('usuarios', compact('usuarios'));
    }

    public function create(Request $request)
    {
        $rol = $request->rol;

        if ($rol == "Estudiante") {
            $estudiante = new Estudiante();
            $estudiante->creditos = 0;
            $estudiante->save();

            $estudiante->usuario()->save(new Usuario([
                'nickname' => $request->nickname,
                'email' => $request->email,
                'password' => $request->password,
                'nombrecompleto' => $request->name,
                'telefono' => $request->phone,
                'biografia' => $request->biography,
            ]));
        } else if ($rol == "Organizador") {
            $organizador = new Organizador();
            $organizador->save();

            $organizador->usuario()->save(new Usuario([
                'nickname' => $request->nickname,
                'email' => $request->email,
                'password' => $request->password,
                'nombrecompleto' => $request->name,
                'telefono' => $request->phone,
                'biografia' => $request->biography,
            ]));
        } else {
            $colaborador = new Colaborador();
            $colaborador->save();

            $colaborador->usuario()->save(new Usuario([
                'nickname' => $request->nickname,
                'email' => $request->email,
                'password' => $request->password,
                'nombrecompleto' => $request->name,
                'telefono' => $request->phone,
                'biografia' => $request->biography,
            ]));
        }



        return redirect()->route('inicio');
    }
}
