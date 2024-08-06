<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\FichaMatriculasController;
use App\Http\Controllers\TipoDocenteController;


Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/', function () {return view('welcome');})->name('welcome');
    Route::get('/dashboard', function () {return view('pages.dashboard.index');})->name('dashboard');

    Route::resource('docentes', DocenteController::class);
    Route::resource('fichaMatriculas', FichaMatriculasController::class);
    Route::resource('tiposDocentes', TipoDocenteController::class);    
});

// routes when the user is not authenticated
Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'postLogin']);
    
});

