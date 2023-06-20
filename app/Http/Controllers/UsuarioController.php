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
}
