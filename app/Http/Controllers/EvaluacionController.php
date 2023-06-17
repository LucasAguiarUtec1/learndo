<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Modulo;
use App\Models\Evaluacion;
use App\Models\Pregunta;
use App\Models\Respuesta;
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
        $preguntas = $request->input('pregunta');
        $respuestas = $request->input('opcion');
        $correctas = $request->input('correcta');
        //dd($preguntas);
        foreach($preguntas as $indice_pregunta => $pregunta) {
            if ($pregunta) {
                $pregunta_crear = new Pregunta();
                $pregunta_crear->pregunta = $pregunta;
                $pregunta_crear->evaluacion_id = $evaluacion->id;
                $pregunta_crear->save();
                $respuestasPregunta = $respuestas[$indice_pregunta];
                $correctasPregunta = $correctas[$indice_pregunta];
                //dd($respuestasPregunta);
                foreach ($respuestasPregunta as $indice_respuesta => $respuesta) {
                    if($respuesta) {
                        $respuesta_crear = new Respuesta();
                        $respuesta_crear->respuesta = $respuesta;
                        $respuesta_crear->pregunta_id = $pregunta_crear->id;
                        $respuesta_crear->correcta = isset($correctasPregunta[$indice_respuesta]) ? true : false;
                        $respuesta_crear->save();
                    }
                }
            }
        }
        return redirect()->route('modulos', $idMod);
    }
}
