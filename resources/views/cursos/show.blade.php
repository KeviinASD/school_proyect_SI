@extends('layouts.layout')

@section('title', 'Detalles del Curso')

@section('content')
    <div class="bg-white border border-gray-100 shadow-md p-6 rounded-md">
        <h2 class="text-lg font-medium mb-4">Detalles del Curso - {{ $curso->nombreCurso }}</h2>
        
        <div class="mb-4">
            <p class="text-sm font-medium text-gray-700">Nombre del Curso:</p>
            <p class="text-lg font-semibold">{{ $curso->nombreCurso }}</p>
        </div>

        <div class="mb-4">
            <p class="text-sm font-medium text-gray-700">Nivel:</p>
            <p class="text-lg font-semibold">{{ $nivel->nombreNivel }}</p>
        </div>

        <div class="flex justify-between">
            <a href="{{ route('cursos.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">Regresar</a>
            <a href="{{ route('cursos.edit', $curso->idCurso) }}" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Editar</a>
        </div>
    </div>
@endsection
