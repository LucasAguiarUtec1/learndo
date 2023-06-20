<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Clase;
use App\Models\Curso;
use App\Models\Invitacion;
use Illuminate\Http\Request;
use Illuminate\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Mail;
use App\Models\Recomendacion;
use Illuminate\Support\Facades\DB;


class UsuarioController extends Controller
{
    use HasApiTokens;

    public function show()
    {
        $usuarios = User::all();
        return view('usuarios', compact('usuarios'));
    }

    public function listar()
    {
        $usuarios = User::all();
        return view('verUsuarios', ['usuarios' => $usuarios]);
    }
    public function obtenerCreditos()
    {
        // Obtener el id del usuario autenticado
        $userId = Auth::id();

        // Obtener el estudiante correspondiente al usuario
        $estudiante = Estudiante::where('userable_id', $userId)->first();

        // Verificar si se encontró el estudiante
        if ($estudiante) {
            $creditos = $estudiante->creditos;
        } else {
            // Si no se encontró el estudiante, asignar un valor predeterminado o lanzar una excepción, según lo prefieras
            $creditos = 0; // Valor predeterminado
            // throw new \Exception('Estudiante no encontrado'); // Lanzar excepción
        }

        return $creditos;
    }
    public function obtenerEstudianteActual()
    {
        $userId = Auth::id();
        $usuario =User::find($userId);
        $estudiante = $usuario->userable;
        return $estudiante;
    }



    public function verperfil($id)
    {
        $usuario = User::find($id);
        $cursos = Clase::where('organizador_id', $usuario->id)->get();
        $cursos_propios = Clase::where('organizador_id', Auth::User()->id)->get();
        return view('PerfilUsuario', compact('usuario', 'cursos', 'cursos_propios'));
    }

    public function enviarInvitacion(Request $request)
    {
        $cursoId = $request->input('cursoSelect');
        $curso = Clase::find($cursoId);
        $usuarioId = $request->input('id_user');
        $usuario = User::find($usuarioId);
        $token = uniqid();

        // Lógica para enviar el correo electrónico aquí
        $data = [
            'curso' => $curso,
            'usuario' => $usuario,
            'token' => $token,
        ];


        $invitacion = Invitacion::firstOrCreate([
            'usuario_id' => $usuarioId,
            'clase_id' => $cursoId,
            'token' => $token,
        ]);

        Mail::send('emails.invitacion', $data, function ($message) use ($usuario) {
            $message->to($usuario->email)
                ->subject('Invitación a colaborar');
        });



        if (!$invitacion) {
            // Invitación no válida
            return redirect()->back()->with('error', 'Invitación no válida');
        }


        return redirect()->back()->with('success', 'Invitación enviada correctamente');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        //$remember = $request->filled('remember');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('inicio');
        }

        return redirect()->back()->withErrors([
            'email' => 'No se pudo iniciar sesión. Por favor, comprueba tus credenciales e inténtalo de nuevo.',
            'password' => 'No se pudo iniciar sesión. Por favor, comprueba tus credenciales e inténtalo de nuevo.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return view('inicio');
    }

    public function recomendaciones()
    {
        $recomendaciones = Recomendacion::where('receptor_id', Auth::user()->id)->where('estado', 0)->get();
        $cursos = [];

        foreach ($recomendaciones as $recomendacion) {
            $cursos[] = Curso::find($recomendacion->curso_id);
        }
        return view('misRecomendaciones', compact('recomendaciones', 'cursos'));
    }

    public function aceptarRecomendacion($id)
    {
        $clase = Clase::find($id);
        $curso = $clase->claseable;

        DB::insert('insert into comprados (user_id, curso_id) values (?, ?)', [Auth::user()->id, $curso->id]);

        DB::update('update recomendaciones set estado = 1 where curso_id = ? and receptor_id = ?', [$curso->id, Auth::user()->id]);

        return redirect()->back();
    }

    public function rechazarRecomendacion($id)
    {
        $clase = Clase::find($id);
        $curso = $clase->claseable;

        DB::update('update recomendaciones set estado = 2 where curso_id = ? and receptor_id = ?', [$curso->id, Auth::user()->id]);

        return redirect()->back();
    }
}
