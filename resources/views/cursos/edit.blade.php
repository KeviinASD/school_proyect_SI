@extends('layouts.layout')

@section('content')
<div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
    <div class="flex justify-between mb-4 items-start">
        <div class="font-medium">Editar Curso</div>
    </div>
    <form action="{{ route('cursos.update', $curso->idCurso) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="nombreCurso" class="block text-sm font-medium text-gray-700">Nombre del Curso</label>
            <input type="text" name="nombreCurso" id="nombreCurso" value="{{ old('nombreCurso', $curso->nombreCurso) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
            @error('nombreCurso')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="idNivel" class="block text-sm font-medium text-gray-700">Nivel</label>
            <select name="idNivel" id="idNivel" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                @foreach ($niveles as $nivel)
                <option value="{{ $nivel->idNivel }}" @if ($nivel->idNivel === $curso->idNivel) selected @endif>{{ $nivel->nombreNivel }}</option>
                @endforeach
            </select>
            @error('idNivel')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center">
            <button type="submit" class="inline-block px-4 py-2 rounded bg-blue-500 text-white font-medium text-sm hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Guardar Cambios</button>
            <a href="{{ route('cursos.index') }}" class="inline-block ml-2 px-4 py-2 rounded bg-gray-300 text-gray-600 font-medium text-sm hover:bg-gray-400 focus:outline-none focus:bg-gray-400">Cancelar</a>
        </div>
    </form>
</div>
@endsection
