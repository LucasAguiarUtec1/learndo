<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Colaborador;
use App\Models\Estudiante;
use App\Models\Organizador;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/verificacion';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'same:password', 'min:8'],
            'nickname' => ['required', 'string', 'max:255', 'unique:users'],
            'phone' => ['required', 'numeric'],
            'image' => ['required', 'image'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $rol = null;
        if ($data['rol'] == 'Estudiante') {
            $rol = new Estudiante();
            $rol->creditos = 0;
            $rol->save();
        } else if ($data['rol'] == 'Organizador') {
            $rol = new Organizador();
            $rol->save();
        } else {
            $rol = new Colaborador();
            $rol->save();
        }

        $path = null;
        if ($data['image'] != null) {
            $file = $data['image'];
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = 'images/' . $fileName;
            Storage::disk('public')->put('images/' . $fileName, \File::get($file));
        }

        $rol->usuario()->save(new User([
            'nombrecompleto' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'nickname' => $data['nickname'],
            'telefono' => $data['phone'],
            'biografia' => $data['biography'],
            'foto' => $path,
        ]));

        return User::where('email', $data['email'])->first();
    }
}
