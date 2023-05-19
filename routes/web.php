<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('inicio');
})->name('inicio');

Route::view('/login', 'auth.login')->name('login');

Route::get('/iniciarsesion', [LoginController::class, 'authenticate'])->name('iniciarsesion');

Route::post('/Usuario/registro', [UsuarioController::class, 'create'])->name('registrarse');

Route::view('/Usuario/registro', 'auth.register')->name('registro');

//Route::get('/logout', [UsuarioController::class, 'logout'])->name('logout');

Auth::routes(['verify' => true]);

Route::view('/verificacion', 'auth.verify')->name('verify');

Route::view('/maps', 'maps')->name('maps');

Route::post('/Curso/registro', [CursoController::class, 'create'])->name('registrarcurso')->middleware(['auth', 'verified']);

Route::view('/Curso/registro', 'altaCurso')->name('registrocurso')->middleware(['auth', 'verified']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::view('/Seminario/registro', 'AltaSeminario')->name('registroseminario')->middleware(['auth', 'verified']);

Route::get('/login/{$driver}', [SocialController::class, 'redirectToProvider']);

Route::get('/login/{$driver}/callback', [SocialController::class, 'handleProviderCallback']);
