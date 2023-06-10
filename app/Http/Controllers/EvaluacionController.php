<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Modulo;
use App\Models\Evaluacion;
use App\Models\Preguntas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class EvaluacionController extends Controller
{


    public function crearEv($idMod)
    {
        $modulo = Modulo::find($idMod);
        return view('AltaEvaluacion', ['modulo' => $modulo]);
    }

    public function crearEvaluacion(Request $request, $idMod)
    {
        $modulo = Modulo::find($idMod);
        $modulo = $modulo;
        $evaluacion = new Evaluacion();
        $evaluacion->nombre = $request->nombre;
        $evaluacion->modulo_id = $modulo->id;
        $evaluacion->save();
        return redirect()->route('modulos', $idMod);
    }
}
