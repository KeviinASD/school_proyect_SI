<?php

use App\Http\Controllers\AsignaturaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CapacidadController;
use App\Http\Controllers\CatedraController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\GradosController;
use App\Http\Controllers\NivelesController;
use App\Http\Controllers\ResumenXController;
use App\Http\Controllers\SeccionesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\EstadoCivilController;
use App\Http\Controllers\TipoDocenteController;


Route::resource('/alumnos', AlumnoController::class);
// routes when the user is authenticated
Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/', function () {return view('welcome');})->name('welcome');
    Route::get('/dashboard', function () {return view('pages.dashboard.index');})->name('dashboard');

<<<<<<< HEAD
    Route::get('/gradosYSecciones', [ResumenXController::class, 'index'])->name('gradosYSecciones');
    Route::resource('grados', GradosController::class);
    Route::get('/api/grados/{nivelId}', [GradosController::class, 'getGradosByNivel']);
    Route::resource('niveles', NivelesController::class);
    Route::resource('secciones', SeccionesController::class);
=======
    Route::resource('tiposDocentes', TipoDocenteController::class);
    Route::resource('estadosCiviles', EstadoCivilController::class);
    Route::resource('docentes', DocenteController::class);

    
>>>>>>> origin/elmo
});

// routes when the user is not authenticated
Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'postLogin']);
<<<<<<< HEAD
});

Route::resource('asignaturas', AsignaturaController::class);
Route::resource('cursos', CursoController::class);
Route::delete('/cursos/{idCurso}', [CursoController::class, 'destroy'])->name('cursos.destroy');
Route::resource('capacidades', CapacidadController::class);

// Catedras Routes
Route::resource('catedras', CatedraController::class);
=======
    
});

>>>>>>> origin/elmo
