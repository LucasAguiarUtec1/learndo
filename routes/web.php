<?php

use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

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

Route::view('/', 'inicio')->name('inicio');

Route::view('/login', 'login')->name('login');

Route::post('/login', [UsuarioController::class, 'createEstudiante'])->name('registro');

Route::get('/Usuarios', [UsuarioController::class, 'show'])->name('usuarios');
