<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $buscarPor = $request->input('buscarpor');
        
        // Filtrar solo los usuarios con los roles específicos
        $rolesPermitidos = ['director', 'admin', 'secretaria'];  // Los roles que deseas mostrar
    
        $users = User::when($buscarPor, function ($query, $buscarPor) {
                return $query->where('name', 'like', '%' . $buscarPor . '%')
                             ->orWhere('email', 'like', '%' . $buscarPor . '%');
            })
            ->whereIn('role', $rolesPermitidos) // Filtrar por los roles permitidos
            ->paginate(10);
    
        return view('pages.users.index', compact('users'));
    }

    public function create()
    {
        return view('pages.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:director,secretaria', // Validación para los roles permitidos
        ]);
    
        // Crear el usuario con los datos proporcionados
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role, // Agregar el rol aquí
        ]);
    
        return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente.');
    }

    public function edit(User $user)
    {
        return view('pages.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:director,secretaria', // Validación para el rol
        ]);
    
        // Actualizar el usuario con los datos proporcionados
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'role' => $request->role, // Agregar el rol
        ]);
    
        return redirect()->route('users.index')->with('success', 'Usuario actualizado exitosamente.');
    }
    

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('pages.users.index')->with('success', 'Usuario eliminado exitosamente.');
    }
}
