@extends('layouts.layout')

@section('title', 'Editar Curso')

@section('content')
<div class="bg-white border border-gray-100 shadow-md p-6 rounded-md">
    <h2 class="text-xl font-medium mb-4">Editar Curso</h2>
    <form action="{{ route('cursos.update', $curso->idCurso) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="nombreCurso" class="block text-sm font-medium text-gray-700">Nombre del Curso</label>
            <input type="text" id="nombreCurso" name="nombreCurso" value="{{ old('nombreCurso', $curso->nombreCurso) }}" placeholder="Ingrese el nombre del curso" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            @error('nombreCurso')
            <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="idNivel" class="block text-sm font-medium text-gray-700">Nivel</label>
            <select id="idNivel" name="idNivel" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @foreach ($niveles as $nivel)
                <option value="{{ $nivel->idNivel }}" {{ $nivel->idNivel == old('idNivel', $curso->idNivel) ? 'selected' : '' }}>
                    {{ $nivel->nombreNivel }}
                </option>
                @endforeach
            </select>
            @error('idNivel')
            <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <button type="submit" class="inline-block px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">Actualizar Curso</button>
        </div>
    </form>
</div>
@endsection
