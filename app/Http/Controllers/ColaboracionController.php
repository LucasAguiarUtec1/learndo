<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Clase;
use App\Models\Curso;
use App\Models\Colaboracion;
use App\Models\Invitacion;
use Illuminate\Support\Facades\Auth;
use App\Models\Recomendacion;

class ColaboracionController extends Controller
{
    public function aceptarInvitacion($cursoId, $usuarioId, $eltoken)
    {
        $invitacion = Invitacion::where('usuario_id', $usuarioId)
            ->where('clase_id', $cursoId)
            ->first();


        if (Auth::user()->id == $usuarioId) {
            if ($invitacion->token == $eltoken) {
                // Guardar la información en el modelo Colaboracion
                $colaboracion = Colaboracion::firstOrCreate([
                    'usuario_id' => $usuarioId,
                    'clase_id' => $cursoId,
                ]);

                if (!$colaboracion->wasRecentlyCreated) {
                    // Ya existe una colaboración con la misma combinación
                    return view('yacolabora'); // Ya colabora
                }

                // Redireccionar o retornar una respuesta según tus necesidades
                Invitacion::where('clase_id', $cursoId)
                    ->where('usuario_id', $usuarioId)
                    ->delete();
                return view('inicio'); // exito
            } else {
                return view('tokeninvalido'); // token invalido
            }
        } else {
            return view('invuser'); // Usuario inválido
        }
    }


    public function compartir($id)
    {
        $curso = Curso::find($id);
        $estudiantes = User::where('userable_type', 'App\Models\Estudiante')->get();
        return view('compartir', compact('curso', 'estudiantes'));
    }

    public function compartirCurso($id, $idE)
    {
        $curso = Curso::find($id);
        $estudiante = User::find($idE);
        $recomendacion = Recomendacion::where('curso_id', $curso->id);
        Recomendacion::create([
            'emisor_id' => Auth::user()->id,
            'receptor_id' => $estudiante->id,
            'curso_id' => $curso->id,
            'estado' => '0',
        ]);

        return redirect()->route('inicio');
    }
}
