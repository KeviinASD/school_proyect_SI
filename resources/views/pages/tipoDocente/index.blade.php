@extends('layouts.layout')

@section('title', 'Tipos de Docentes')

@section('content')
<div class="container mx-auto">
    <h3 class="text-lg font-bold my-4">LISTADO DE TIPOS DE DOCENTES</h3>
    <div class="my-4">
        <a href="{{ route('tipoDocente.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            <i class="fas fa-plus"></i> Nuevo Tipo de Docente
        </a>
    </div>
    @if ($tipoDocentes->isEmpty())
        <p class="mt-4">No hay tipos de docentes registrados.</p>
    @else
        <table class="table-auto w-full bg-white border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-800 text-white">
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Nombre</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tipoDocentes as $tipoDocente)
                    <tr class="bg-gray-200">
                        <td class="border px-4 py-2">{{ $tipoDocente->id_tipo_docente }}</td>
                        <td class="border px-4 py-2">{{ $tipoDocente->nombreTipo }}</td>
                        <td class="border px-4 py-2 text-center">
                            <a href="{{ route('tipoDocente.edit', $tipoDocente->id_tipo_docente) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <form action="{{ route('tipoDocente.destroy', $tipoDocente->id_tipo_docente) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 ml-2 rounded" onclick="return confirm('¿Estás seguro de querer eliminar este tipo de docente?')">
                                    <i class="fas fa-trash"></i> Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
