<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Clase;

class CursoController extends Controller
{
    public function create(Request $request)
    {
        $curso = new Curso();
        $curso->instructor = $request->instructor;
        $curso->save();
        $free = false;
        if ($request->precio == 0)
            $free = true;

        $curso->clase()->save(new Clase([
            'nombre' => $request->name,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'free' => $free,
        ]));

        return redirect()->route('inicio');
    }
}
