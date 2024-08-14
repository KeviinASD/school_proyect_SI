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
use App\Http\Controllers\FichaMatriculasController;
use App\Http\Controllers\TipoDocenteController;
use App\Http\Controllers\AlumnosMatriculadosController;
use App\Http\Controllers\EstadoCivilController;

use App\Http\Controllers\DetalleNotasController;

use App\Http\Controllers\LocationController;
use App\Http\Controllers\NotasController;
use App\Http\Controllers\NotaCapacidadController;
use App\Models\Catedra;
use App\Models\Grado;
use App\Http\Controllers\ReporteNotasController;

Route::resource('/alumnos', AlumnoController::class);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/', [ResumenXController::class, 'welcome'])->name('welcome');
    Route::get('/detalle-notas', [DetalleNotasController::class, 'index'])->name('detalle-notas.index');
    Route::post('/nota-capacidad', [NotaCapacidadController::class, 'store'])->name('nota-capacidad.store');
    Route::get('/dashboard', [ResumenXController::class, 'dashboard'])->name('dashboard');


    Route::get('/gradosYSecciones', [ResumenXController::class, 'index'])->name('gradosYSecciones');
    Route::resource('grados', GradosController::class);
    Route::get('/api/secciones/{gradoId}', [SeccionesController::class, 'getSeccionesByGrado']);
    Route::get('/api/grados/{nivelId}', [GradosController::class, 'getGradosByNivel']);
    Route::resource('niveles', NivelesController::class);
    Route::resource('secciones', SeccionesController::class);

    Route::resource('capacidades', CapacidadController::class);
    Route::resource('tiposDocentes', TipoDocenteController::class);
    Route::resource('estadosCiviles', EstadoCivilController::class);
    Route::resource('docentes', DocenteController::class);
    Route::resource('fichaMatriculas', FichaMatriculasController::class);
    Route::resource('tipoDocente', TipoDocenteController::class);    
    

    Route::get('/notas', [NotasController::class, 'index'])->name('notas.index');
    Route::get('/notas/registro/{codigo_Docente}', [NotasController::class, 'registro'])->name('notas.registro');
    Route::get('/notas/crear_ficha_notas/{idCatedra}', [NotasController::class, 'crear_ficha_notas'])->name('notas.crear_ficha_notas');
});

// routes when the user is not authenticated
Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'postLogin']);

});


Route::resource('asignaturas', AsignaturaController::class);
Route::resource('cursos', CursoController::class);
Route::delete('/cursos/{idCurso}', [CursoController::class, 'destroy'])->name('cursos.destroy');
Route::resource('capacidades', CapacidadController::class);
Route::put('capacidades/{id}', [CapacidadController::class, 'update'])->name('capacidades.update');

Route::get('/api/asignaturas/{idCurso}', [CapacidadController::class, 'getAsignaturas']);

Route::get('/get-grados-by-nivel/{nivelId}', [AsignaturaController::class, 'getGradosByNivel']);

//CATEDRAS
Route::resource('catedras', CatedraController::class);

Route::get('grados-by-nivel/{nivelId}', [CatedraController::class, 'getGradosByNivel']);
Route::get('secciones-by-grado/{gradoId}', [CatedraController::class, 'getSeccionesByGrado']);
Route::get('asignaturas-by-curso/{cursoId}', [CatedraController::class, 'getAsignaturasByCurso']);





Route::get('/alumnos/{alumno}/edit', [AlumnoController::class, 'edit'])->name('alumnos.edit');
Route::put('/alumnos/{codigoAlumno}', [AlumnoController::class, 'update'])->name('alumnos.update');

Route::get('/countries', [LocationController::class, 'getCountries'])->name('countries');
Route::get('/departamentos/{countryCode}', [LocationController::class, 'getDepartments'])->name('departamentos');
Route::get('/provincias/{geonameId}', [LocationController::class, 'getProvinces'])->name('provincias');
Route::get('/distritos/{geonameId}', [LocationController::class, 'getDistricts'])->name('distritos');



Route::get('/alumnosMatriculados', [AlumnosMatriculadosController::class, 'index'])->name('alumnosMatriculados.index');



Route::get('/reporte-notas', [ReporteNotasController::class, 'index'])->name('reporteDeNotas.index');
Route::get('/reporte-notas/pdf', [ReporteNotasController::class, 'pdfNotas'])->name('notas.pdf');

Route::post('/reporte-notas', [ReporteNotasController::class, 'reportePorAsignatura'])->name('reporteDeNotas.generar');

Route::get('/docentesByAñoEscolar/{añoEscolar}', [ReporteNotasController::class, 'docentesByAñoEscolar'])->name('docentesByAñoEscolar');
Route::get('/asignaturasByDocente/{codigoDocente}', [ReporteNotasController::class, 'asignaturasByDocente'])->name('asignaturasByDocente');
Route::get('/asignaturas-by-nivel-grado/{nivelId}/{gradoId}', [CatedraController::class, 'getAsignaturasByNivelYGrado']);