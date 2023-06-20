<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Modulo;
use App\Models\Evaluacion;
use App\Models\Pregunta;
use App\Models\Respuesta;
use App\Models\User;
use App\Models\resultado;
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

    public function ConfirmarEvaluacion(Request $request) {
        $evaluacionId = $request->input('evaluacion_id');
        $respuestasSeleccionadas = $request->input('respuestas');
        $totalRespuestas = count($respuestasSeleccionadas);
        $resultado = new resultado();
        $correctas = 0;
        foreach ($respuestasSeleccionadas as $preguntaId => $respuestaId) {
            $res = Respuesta::find($respuestaId);
            if ($res->correcta) {
                $correctas = $correctas+1;
            }
        }
        $porcentajeCorrectas = ($correctas / $totalRespuestas) * 100;
        $resultado->user_id = Auth::user()->id;
        $resultado->evaluacion_id = $evaluacionId;
        $resultado->nota = $porcentajeCorrectas;
        $resultado->save();
        return view('inicio');
    }

    public function realizarevaluacion($idEvaluacion)
    {
        $evaluacion = Evaluacion::find($idEvaluacion);
        $preguntas = Pregunta::where('evaluacion_id', $evaluacion->id)->get();
        $preguntaIds = $preguntas->pluck('id');
        $respuestas = Respuesta::whereIn('pregunta_id', $preguntaIds)->get();
        $userId = Auth::user()->id;

        $resultado = Resultado::where('evaluacion_id', $evaluacion->id)
            ->where('user_id', $userId)
            ->first();

        if ($resultado) {
            // Existe una columna en la tabla "resultado" que cumple con las condiciones
            // Puedes realizar las acciones que desees en este caso
            return view('inicio');
        } else {
            // No se encontró ninguna columna que cumpla con las condiciones
            // Puedes manejar esta situación de acuerdo a tus necesidades
            return view('RealizarPrueba', compact('evaluacion', 'preguntas', 'respuestas'));
        }

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
