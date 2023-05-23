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
                'foto_fb' => $facebookUser->avatar,
                'fb_id' => $facebookUser->id,
                'email_verified_at' => $timestamp,
                'userable_type' => 'App\Models\Alumno',
                'userable_id' => 0,
                'telefono' => '',
            ]);
            Auth::login($user, false);
            $user = Auth::user();
            //$user->sendEmailVerificationNotification();
            return view('auth.registroFacebook');
        } else {
            Auth::login($user, false);
            return view('inicio');
        }
    }

    public function refreshInfo(Request $request)
    {
        $user = User::where('email', Auth::user()->email)->first();
        $user->nickname = $request->nick;
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
