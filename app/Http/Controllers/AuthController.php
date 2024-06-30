<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function postLogin()
    {
        // Validate the request
        request()->validate([
            'name' => 'required',
            'password' => 'required',
        ], [
            'name.required' => 'Username is required',
            'password.required' => 'Password is required',
        ]);

        // Attempt to authenticate the user
        if (auth()->attempt(request()->only('name', 'password'))) {
            return redirect('/');
        }
        // Verificar si el nombre de usuario existe
        if (!User::where('name', request()->only('name'))->exists()) {
            return back()->withErrors(['name' => 'The provided username does not exist.'])->withInput(request()->only('name', 'password'));
        }

        // Si el nombre de usuario existe, entonces la contraseña es incorrecta
        return back()->withErrors(['password' => 'The provided password is incorrect.'])->withInput(request()->only('name', 'password'));
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }
}
