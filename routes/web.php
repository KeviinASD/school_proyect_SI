<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GradosController;
use App\Http\Controllers\NivelesController;
use App\Http\Controllers\ResumenXController;
use App\Http\Controllers\SeccionesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\NotasController;

Route::resource('/alumnos', AlumnoController::class);
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

    Route::get('/notas', [NotasController::class, 'index'])->name('notas.index');
});

// routes when the user is not authenticated
Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'postLogin']);
    
});

Route::get('/alumnos/{alumno}/edit', [AlumnoController::class, 'edit'])->name('alumnos.edit');
Route::put('/alumnos/{alumno}', [AlumnoController::class, 'update'])->name('alumnos.update');

Route::get('/countries', [LocationController::class, 'getCountries'])->name('countries');
Route::get('/departamentos/{countryCode}', [LocationController::class, 'getDepartments'])->name('departamentos');
Route::get('/provincias/{geonameId}', [LocationController::class, 'getProvinces'])->name('provincias');
Route::get('/distritos/{geonameId}', [LocationController::class, 'getDistricts'])->name('distritos');