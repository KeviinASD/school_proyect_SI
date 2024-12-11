@extends('layouts.layout')

@section('title', 'Usuarios')

@section('content')

<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Editar Usuario</h1>

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="mt-1 block w-full px-4 py-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full px-4 py-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label for="role" class="block text-sm font-medium text-gray-700">Rol</label>
            <select name="role" id="role" class="mt-1 block w-full px-4 py-2 border rounded" required>
                <option value="director" {{ old('role', $user->role) == 'director' ? 'selected' : '' }}>Director</option>
                <option value="secretaria" {{ old('role', $user->role) == 'secretaria' ? 'selected' : '' }}>Secretaria</option>
            </select>
        </div>

        <button type="submit" class="bg-yellow-500 text-white py-2 px-4 rounded">Actualizar Usuario</button>
    </form>
</div>

@endsection
