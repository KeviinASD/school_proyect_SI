<?php

use App\Http\Controllers\AsignaturaController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;



// routes when the user is authenticated
Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/', function () {return view('welcome');})->name('welcome');   
    Route::get('/dashboard', function () {return view('pages.dashboard.index');})->name('dashboard');

    Route::get('/gradosYSecciones', [ResumenXController::class, 'index'])->name('gradosYSecciones');
    Route::resource('grados', GradosController::class);
    Route::get('/api/grados/{nivelId}', [GradosController::class, 'getGradosByNivel']);
    Route::resource('niveles', NivelesController::class);
    Route::resource('secciones', SeccionesController::class);
});

// routes when the user is not authenticated
Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'postLogin']);
});

Route::resource('asignaturas', AsignaturaController::class);
Route::resource('cursos', CursoController::class);

Route::resource('capacidades', CapacidadController::class);