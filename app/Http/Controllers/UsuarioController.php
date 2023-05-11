<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Organizador;
use App\Models\Estudiante;
use App\Models\Colaborador;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\AltaRequest;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;

class UsuarioController extends Controller
{

    public function show()
    {
        $usuarios = User::all();
        return view('usuarios', compact('usuarios'));
    }

    public function create(AltaRequest $request)
    {
        $rol = $request->rol;



        if ($rol == "Estudiante") {
            $estudiante = new Estudiante();
            $estudiante->creditos = 0;
            $estudiante->save();

            $estudiante->usuario()->save(new User([
                'nickname' => $request->nickname,
                'email' => $request->email,
                'password' => $request->password,
                'nombrecompleto' => $request->name,
                'telefono' => $request->phone,
                'biografia' => $request->biography,
            ]));
        } else if ($rol == "Organizador") {
            $organizador = new Organizador();
            $organizador->save();

            $organizador->usuario()->save(new User([
                'nickname' => $request->nickname,
                'email' => $request->email,
                'password' => $request->password,
                'nombrecompleto' => $request->name,
                'telefono' => $request->phone,
                'biografia' => $request->biography,
            ]));
        } else {
            $colaborador = new Colaborador();
            $colaborador->save();

            $colaborador->usuario()->save(new User([
                'nickname' => $request->nickname,
                'email' => $request->email,
                'password' => $request->password,
                'nombrecompleto' => $request->name,
                'telefono' => $request->phone,
                'biografia' => $request->biography,
            ]));
        }

        $usermodel = User::where('nickname', $request->nickname)->first();
        $usermodel->sendEmailVerificationNotification();

        return redirect()->route('verify');
    }


    public function login(Request $request)
    {
        // Comprobar si se han proporcionado una dirección de correo electrónico y una contraseña
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        $remember = $request->filled('remember');

        // Comprobar si el usuario ha verificado su dirección de correo electrónico
        $user = User::where('email', $request->email)->first();
        if ($user && !$user->email_verified_at) {
            return redirect()->back()->withErrors([
                'email' => 'Tu cuenta aún no ha sido activada. Por favor, confirma tu dirección de correo electrónico.'
            ]);
        }

        // Autenticar al usuario y redirigir a la página de inicio
        if (auth()->attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->route('inicio');
        } else {
            return redirect()->back()->withErrors([
                'email' => 'No se pudo iniciar sesión. Por favor, comprueba tus credenciales e inténtalo de nuevo.',
            ]);
        }
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('inicio');
    }
}
