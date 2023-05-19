<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;
use App\Models\User;

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
            $timestamp = \Carbon\Carbon::now()->timestamp;
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
            return 'exitoo';
        } else {
            Auth::login($user, false);
            return view('inicio');
        }
    }
}
