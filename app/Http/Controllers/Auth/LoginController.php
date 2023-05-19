<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticate(Request $request)
    {
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
        if (Auth::login($user, $remember = false)) {
            $request->session()->regenerate();
            return redirect()->route('inicio');
        } else {
            return redirect()->back()->withErrors([
                'email' => 'No se pudo iniciar sesión. Por favor, comprueba tus credenciales e inténtalo de nuevo.',
            ]);
        }
    }
}
