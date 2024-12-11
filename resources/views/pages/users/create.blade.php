@extends('layouts.layout')

@section('title', 'Usuarios')

@section('content')

<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Crear Usuario</h1>

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
            <input type="text" name="name" id="name" class="mt-1 block w-full px-4 py-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="mt-1 block w-full px-4 py-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
            <input type="password" name="password" id="password" class="mt-1 block w-full px-4 py-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar Contraseña</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full px-4 py-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label for="role" class="block text-sm font-medium text-gray-700">Rol</label>
            <select name="role" id="role" class="mt-1 block w-full px-4 py-2 border rounded" required>
                <option value="director">Director</option>
                <option value="secretaria">Secretaria</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Crear Usuario</button>
    </form>
</div>
@endsection