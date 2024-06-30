<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;



// routes when the user is authenticated
Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/', function () {return view('welcome');})->name('welcome');    
});

// routes when the user is not authenticated
Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'postLogin']);
});