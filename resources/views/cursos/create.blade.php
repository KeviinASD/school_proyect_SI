@extends('layouts.layout')

@section('title', 'Crear Curso')

@section('content')
<div class="bg-white border border-gray-100 shadow-md p-6 rounded-md">
    <h2 class="text-xl font-medium mb-4">Crear Nuevo Curso</h2>
    <form action="{{ route('cursos.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="nombreCurso" class="block text-sm font-medium text-gray-700">Nombre del Curso</label>
            <input type="text" id="nombreCurso" name="nombreCurso" value="{{ old('nombreCurso') }}" placeholder="Ingrese el nombre del curso" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            @error('nombreCurso')
            <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="idNivel" class="block text-sm font-medium text-gray-700">Nivel</label>
            <select id="idNivel" name="idNivel" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="">Seleccione un nivel</option>
                @foreach ($niveles as $nivel)
                <option value="{{ $nivel->idNivel }}" {{ old('idNivel') == $nivel->idNivel ? 'selected' : '' }}>
                    {{ $nivel->nombreNivel }}
                </option>
                @endforeach
            </select>
            @error('idNivel')
            <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 disabled:opacity-60 transition">
                Guardar Curso
            </button>
        </div>
    </form>
</div>
@endsection