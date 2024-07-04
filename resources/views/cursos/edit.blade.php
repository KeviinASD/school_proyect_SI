@extends('layouts.layout')

@section('title', 'Editar Curso')

@section('content')
    <div class="bg-white border border-gray-100 shadow-md p-6 rounded-md">
        <h2 class="text-lg font-medium mb-4">Editar Curso - {{ $curso->nombreCurso }}</h2>
        <form action="{{ route('cursos.update', $curso->idCurso) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="nombreCurso" class="block text-sm font-medium text-gray-700">Nombre del Curso</label>
                <input type="text" id="nombreCurso" name="nombreCurso" class="mt-1 p-2 border border-gray-300 rounded-md w-full" value="{{ $curso->nombreCurso }}" required>
            </div>
            <div class="mb-4">
                <label for="idNivel" class="block text-sm font-medium text-gray-700">Nivel</label>
                <select id="idNivel" name="idNivel" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                    @foreach ($niveles as $nivel)
                        <option value="{{ $nivel->idNivel }}" {{ $nivel->idNivel == $curso->idNivel ? 'selected' : '' }}>{{ $nivel->nombreNivel }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Actualizar</button>
            </div>
        </form>
    </div>
@endsection
