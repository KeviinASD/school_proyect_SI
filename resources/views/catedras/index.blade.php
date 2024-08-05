@extends('layouts.layout')

@section('title', 'Cátedras')

@section('content')
<div class="bg-white border border-gray-100 shadow-md p-6 rounded-md">
    <h2 class="text-xl font-medium mb-4">Lista de Cátedras</h2>
    <a href="{{ route('catedras.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 disabled:opacity-60 transition">
        Crear Nueva Cátedra
    </a>
    <table class="min-w-full mt-4 divide-y divide-gray-200">
        <thead>
            <tr>
                <th>ID</th>
                <th>Docente</th>
                <th>Asignatura</th>
                <th>Curso</th>
                <th>Sección</th>
                <th>Grado</th>
                <th>Nivel</th>
                <th>Año Escolar</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($catedras as $catedra)
            <tr>
                <td>{{ $catedra->idCatedra }}</td>
                <td>{{ $catedra->docente->nombres }} {{ $catedra->docente->apellidos }}</td>
                <td>{{ $catedra->asignatura->nombreAsignatura }}</td>
                <td>{{ $catedra->curso->nombreCurso }}</td>
                <td>{{ $catedra->seccion->nombreSeccion }}</td>
                <td>{{ $catedra->grado->nombreGrado }}</td>
                <td>{{ $catedra->nivel->nombreNivel }}</td>
                <td>{{ $catedra->añoEscolar->añoEscolar }}</td>
                <td>
                    <a href="{{ route('catedras.edit', $catedra) }}" class="text-blue-600 hover:text-blue-900">Editar</a>
                    <form action="{{ route('catedras.destroy', $catedra) }}" method="POST" class="inline">
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
