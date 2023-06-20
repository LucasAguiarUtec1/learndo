<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Clase;
use App\Models\Colaboracion;
use App\Models\Invitacion;
use Illuminate\Support\Facades\Auth;

class ColaboracionController extends Controller
{
    public function aceptarInvitacion($cursoId, $usuarioId, $eltoken)
    {
        $invitacion = Invitacion::where('usuario_id', $usuarioId)
                        ->where('clase_id', $cursoId)
                        ->first();

        
        if(Auth::user()->id == $usuarioId) {
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
            }
            else {
                return view('tokeninvalido'); // token invalido
            }
        }
        else {
            return view('invuser'); // Usuario inválido
        }
    }
}
