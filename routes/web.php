<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ClaseController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\SeminarioController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\EvaluacionController;
use App\Http\Controllers\ColaboracionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\vendor\Chatify\MessagesController;
use App\Models\Estudiante;

/*
|--------------------------------------------------------------------------
| Web Route
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

Route::get('/offline', function () {
    return view('vendor.laravelpwa.offline');
});

Route::view('/login', 'auth.login')->name('login')->middleware('verified');

Route::get('/login/{driver}', [SocialController::class, 'redirectToProvider']);

Route::get('/login/{driver}/callback', [SocialController::class, 'handleProviderCallback']);

Route::post('/iniciarsesion', [LoginController::class, 'authenticate'])->name('iniciarsesion');

Route::post('/Usuario/registro', [UsuarioController::class, 'create'])->name('registrarse');

Route::view('/Usuario/registro', 'auth.register')->name('registro');

Route::get('/logout', [UsuarioController::class, 'logout'])->name('logout');

Auth::routes(['verify' => true]);

Route::view('/verificacion', 'auth.verify')->name('verify');

Route::view('/maps', 'maps')->name('maps');

Route::view('/Curso/registro', 'AltaCurso')->name('registrocurso')->middleware('auth');

Route::post('/Curso/registro', [CursoController::class, 'create'])->name('registrarcurso')->middleware('auth');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::view('/Seminario/registro', 'AltaSeminario')->name('registroseminario')->middleware('auth');

Route::post('/Seminario/registro', [App\Http\Controllers\SeminarioController::class, 'create'])->name('registrarseminario')->middleware('auth');

Route::post('/register/facebook', [SocialController::class, 'refreshinfo'])->name('refreshinfo');

Route::get('/Curso/misCursos', [CursoController::class, 'misCursos'])->name('miscursos')->middleware('auth');

Route::get('/Curso/misCursos/Eliminar/{id}', [CursoController::class, 'eliminar'])->name('eliminarcurso')->middleware('auth');

Route::get('/Seminario/misSeminarios/Eliminar/{id}', [App\Http\Controllers\SeminarioController::class, 'delete'])->name('eliminarseminario')->middleware('auth');

Route::get('/Curso/{id}/modulos', [CursoController::class, 'modulos'])->name('modulos')->middleware('auth');

Route::post('/Curso/{id}/modulos/crear', [CursoController::class, 'crearModulo'])->name('crearModulo')->middleware('auth');

Route::post('/Curso/{id}/modulos/sugerir', [CursoController::class, 'sugerirModulo'])->name('sugerirModulo')->middleware('auth');

Route::get('/Curso/{id}/modulos/{idMod}/eliminar', [CursoController::class, 'eliminarModulo'])->name('eliminarModulo')->middleware('auth');

Route::get('/Curso/{id}/modulos/{idMod}/accept', [CursoController::class, 'aceptarModulo'])->name('aceptarModulo')->middleware('auth');

Route::get('/modulos/{idMod}/crearEv', [EvaluacionController::class, 'crearEv'])->name('crearEv')->middleware('auth');

Route::post('/modulos/{idMod}/crearEvaluacion', [EvaluacionController::class, 'crearEvaluacion'])->name('crearEvaluacion')->middleware('auth');

Route::post('/uploadPDF', [CursoController::class, 'upload'])->name('uploadPDF')->middleware('auth');

Route::post('/sugPDF', [CursoController::class, 'sug_pdf'])->name('sug_pdf')->middleware('auth');

Route::get('/usuarios', [UsuarioController::class, 'listar'])->name('ListarUsuarios')->middleware('auth');

Route::get('/usuarios/{id}/profile', [UsuarioController::class, 'verperfil'])->name('verperfil')->middleware('auth');

Route::get('/openPDF', [CursoController::class, 'verLeccion'])->name('openPDF')->middleware('auth');

Route::get('/eliminarLeccion/{idCurso}/{idLeccion}', [CursoController::class, 'eliminarLeccion'])->name('eliminarLeccion')->middleware('auth');

Route::get('/aceptarLeccion/{idCurso}/{idLeccion}', [CursoController::class, 'aceptarLeccion'])->name('aceptarLeccion')->middleware('auth');

Route::post('/agregarMultimedia', [CursoController::class, 'agregarMultimedia'])->name('agregarMultimedia')->middleware('auth');

Route::get('/eliminarMultimedia/{idCurso}/{idMultimedia}', [CursoController::class, 'eliminarMultimedia'])->name('eliminarMultimedia')->middleware('auth');

Route::get('/mapita', [SeminarioController::class, 'getUbicaciones'])->name('mapa')->middleware('auth');

Route::get('/encontrarSeminario', [CursoController::class, 'encontrarSeminario'])->name('encontrarSeminario')->middleware('auth');

Route::get('/Seminario/{nombre}', [SeminarioController::class, 'verSeminario'])->name('verSeminario')->middleware('auth');

Route::get('/Cursos/Comprar', [ClaseController::class, 'show'])->name('comprar')->middleware('auth');

Route::view('/paypal', 'paypal')->name('paypal');

Route::post('/paypal/pay', [PaymentController::class, 'payWithPayPal'])->name('paywithpaypal');

Route::get('/paypal/status', [PaymentController::class, 'payPalStatus']);

Route::get('/chatify/{id}', [MessagesController::class, 'index'])->name('chat');

Route::get('/chatify', [MessagesController::class, 'index'])->name('chat_inicio');

Route::post('/enviarInvitacion', [UsuarioController::class, 'enviarInvitacion'])->name('enviarInvitacion');

Route::get('/aceptar-invitacion/{cursoId}/{usuarioId}/{eltoken}', [ColaboracionController::class, 'aceptarInvitacion'])->name('aceptar.invitacion')->middleware('auth');

Route::get('/compartir/curso/{id}', [ColaboracionController::class, 'compartir'])->name('compartir.curso')->middleware('auth');

Route::get('/compartir/seminario/{id}/{idE}', [ColaboracionController::class, 'compartirCurso'])->name('compartir')->middleware('auth');

Route::get('/recomendaciones', [UsuarioController::class, 'recomendaciones'])->name('recomendaciones')->middleware('auth');

Route::get('/recomendaciones/aceptar/{id}', [UsuarioController::class, 'aceptarRecomendacion'])->name('aceptarrecomendacion')->middleware('auth');

Route::get('/recomendaciones/rechazar/{id}', [UsuarioController::class, 'rechazarRecomendacion'])->name('rechazarrecomendacion')->middleware('auth');
Route::get('/realizarevaluacion/{idEvaluacion}', [EvaluacionController::class, 'realizarevaluacion'])->name('realizarevaluacion')->middleware('auth');

Route::post('/ConfirmarEvaluacion', [EvaluacionController::class, 'ConfirmarEvaluacion'])->name('ConfirmarEvaluacion')->middleware('auth');
