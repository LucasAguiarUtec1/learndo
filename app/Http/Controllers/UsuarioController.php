<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;

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
        return view('PerfilUsuario', compact('usuario'));
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
