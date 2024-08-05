@extends('layouts.layout')

@section('title', 'Capacidades')

@section('content')
<div class="bg-white border border-gray-100 shadow-md p-6 rounded-md">
    <h2 class="text-xl font-medium mb-4">Lista de Capacidades</h2>
    <a href="{{ route('capacidades.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 disabled:opacity-60 transition">
        Crear Nueva Capacidad
    </a>
    <table class="min-w-full mt-4 divide-y divide-gray-200">
        <thead>
            <tr>
                <th>ID</th>
                <th>Descripción</th>
                <th>Asignatura</th>
                <th>Curso</th>
                <th>Orden</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($capacidades as $capacidad)
            <tr>
                <td>{{ $capacidad->idCapacidad }}</td>
                <td>{{ $capacidad->descripcion }}</td>
                <td>{{ $capacidad->asignatura->nombreAsignatura }}</td>
                <td>{{ $capacidad->curso->nombreCurso }}</td>
                <td>{{ $capacidad->orden }}</td>
                <td>{{ $capacidad->estado ? 'Activo' : 'Inactivo' }}</td>
                <td>
                    <a href="{{ route('capacidades.edit', $capacidad) }}" class="text-blue-600 hover:text-blue-900">Editar</a>
                    <form action="{{ route('capacidades.destroy', $capacidad) }}" method="POST" class="inline">
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
