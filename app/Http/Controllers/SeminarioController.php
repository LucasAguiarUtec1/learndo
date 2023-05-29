<?php

namespace App\Http\Controllers;

use App\Models\Seminario;
use Illuminate\Http\Request;
use App\Models\Clase;
use Illuminate\Support\Facades\Auth;

class SeminarioController extends Controller
{
    public function create(Request $request)
    {
        if ($request['tipo'] == "Presencial") {
            $seminario = new Seminario();
            $seminario->fecha = $request['fecha'];
            $seminario->ubicacion = $request['ubi'];
            $seminario->tipo = $request['tipo'];
            $seminario->save();
            $free = false;
            if ($request['free'] == 0)
                $free = true;

            $seminario->clase()->save(new Clase(
                [
                    'nombre' => $request['name'],
                    'descripcion' => $request['descripcion'],
                    'precio' => $request['precio'],
                    'free' => $free,
                    'organizador_id' => Auth::user()->id,
                ]
            ));
        } else {
            $seminario = new Seminario();
            $seminario->fecha = $request['fecha'];
            $seminario->plataforma = $request['plataforma'];
            $seminario->tipo = $request['tipo'];
            $seminario->save();
            $free = false;
            if ($request['free'] == 0)
                $free = true;

            $seminario->clase()->save(new Clase(
                [
                    'nombre' => $request['name'],
                    'descripcion' => $request['descripcion'],
                    'precio' => $request['precio'],
                    'free' => $free,
                    'organizador_id' => Auth::user()->id,
                ]
            ));
        }
        return redirect()->route('inicio');
    }

    public function delete($id)
    {
        $clase = Clase::find($id);
        $seminario = $clase->claseable;
        $clase->delete();
        $seminario->delete();
        return redirect()->route('miscursos');
    }
}
