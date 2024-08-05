@extends('layouts.layout')

@section('title', 'Asignaturas')

@section('content')
<div class="bg-white border border-gray-100 shadow-md p-6 rounded-md">
    <h2 class="text-xl font-medium mb-4">Lista de Asignaturas</h2>
    <a href="{{ route('asignaturas.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 disabled:opacity-60 transition">
        Crear Nueva Asignatura
    </a>
    <table class="min-w-full mt-4 divide-y divide-gray-200">
        <thead>
            <tr>
                <th>ID</th>
                <th>Curso</th>
                <th>Grado</th>
                <th>Nivel</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($asignaturas as $asignatura)
            <tr>
                <td>{{ $asignatura->idAsignatura }}</td>
                <td>{{ $asignatura->curso->nombreCurso }}</td>
                <td>{{ $asignatura->grado->nombreGrado }}</td>
                <td>{{ $asignatura->nivel->nombreNivel }}</td>
                <td>{{ $asignatura->estado ? 'Activo' : 'Inactivo' }}</td>
                <td>
                    <a href="{{ route('asignaturas.edit', $asignatura) }}" class="text-blue-600 hover:text-blue-900">Editar</a>
                    <form action="{{ route('asignaturas.destroy', $asignatura) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
