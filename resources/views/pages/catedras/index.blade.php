@extends('layouts.layout')

@section('title', 'Lista de Cátedras')

@section('content')
<div class="bg-white border border-gray-100 shadow-md py-6   rounded-md">
    <h2 class="text-xl font-medium mb-4">Lista de Cátedras</h2>
    <a href="{{ route('catedras.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 mb-4">
        Agregar Nueva Cátedra
    </a>
    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Código Docente</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre Docente</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sección</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Grado</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nivel</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Curso</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Asignatura</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Año Escolar</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($catedras as $catedra)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $catedra->codigo_docente }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $catedra->docente ? $catedra->docente->nombres . ' ' . $catedra->docente->apellidos : 'No disponible' }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $catedra->seccion->nombreSeccion }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $catedra->grado->nombreGrado }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $catedra->nivel->nombreNivel }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $catedra->curso->nombreCurso }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $catedra->asignatura->nombreAsignatura }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $catedra->añoEscolar }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <a href="{{ route('catedras.edit', $catedra->idCatedra) }}" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                    <form action="{{ route('catedras.destroy', $catedra->idCatedra) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar esta cátedra?')" class="text-red-600 hover:text-red-900">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
