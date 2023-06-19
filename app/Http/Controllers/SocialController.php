<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Organizador;
use App\Models\Colaborador;
use Illuminate\Support\Facades\Storage;


class SocialController extends Controller
{

    public function redirectToProvider($driver)
    {
        return Socialite::driver($driver)->redirect();
    }

    public function handleProviderCallback($driver)
    {
        $facebookUser = Socialite::driver($driver)->user();

        $user = User::where('email', $facebookUser->email)->first();

        if (!$user) {
            $timestamp = \Carbon\Carbon::now();
            $user = User::create([
                'nickname' => $facebookUser->name . '12345678',
                'email' => $facebookUser->email,
                'nombrecompleto' => $facebookUser->name,
                'fb_id' => $facebookUser->id,
                'email_verified_at' => $timestamp,
                'userable_type' => 'App\Models\Estudiante',
                'userable_id' => 0,
                'telefono' => '',
            ]);
            Auth::login($user);
            session()->save();
            //if (Auth::check()) {
                // El usuario está autenticado
            //    dd('El usuario está autenticado');
            //} else {
                // El usuario no está autenticado
            //    dd('El usuario no está autenticado');
            //}
            //$user = Auth::user();
            //$user->sendEmailVerificationNotification();
            return view('auth.registroFacebook', ['user' => $user]);
        } else {
            Auth::login($user);
            return view('inicio');
        }
    }

    public function refreshinfo(Request $request)
    {
        $user = User::where('email', $request->email_user)->first();
        $user->nickname = $request->nick;
        $path = null;
        if ($request['image'] != null) {
            $file = $request['image'];
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = 'images/' . $fileName;
            Storage::disk('public')->put('images/' . $fileName, \File::get($file));
        }
        $user->foto = $path;
        $user->save();
        switch ($request->rol) {
            case 'Estudiante':
                $estudiante = new Estudiante();
                $estudiante->creditos = 0;
                $estudiante->save();
                $estudiante->usuario()->save($user);
                break;
            case 'Organizador':
                $organizador = new Organizador();
                $organizador->save();
                $organizador->usuario()->save($user);
                break;
            case 'Colaborador':
                $colaborador = new Colaborador();
                $colaborador->save();
                $colaborador->usuario()->save($user);
                break;
        }
        return redirect()->route('inicio');
    }
}
