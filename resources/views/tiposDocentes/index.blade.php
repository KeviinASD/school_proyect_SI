@extends('layouts.layout')

@section('content')
    <div class="container mx-auto py-8">
        <h2 class="text-2xl font-semibold mb-4">Tipos de Docente</h2>
        <a href="{{ route('tiposDocentes.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mb-4 rounded">Crear Nuevo Tipo de Docente</a>

        @if ($tiposDocentes->isEmpty())
            <p class="mt-4">No hay tipos de docente registrados.</p>
        @else
            <div class="overflow-x-auto mt-8">
                <table class="min-w-full bg-white border-collapse border border-gray-300">
                    <thead>
                        <tr>
                            <th class="bg-gray-100 border border-gray-300 px-4 py-2">ID</th>
                            <th class="bg-gray-100 border border-gray-300 px-4 py-2">Nombre</th>
                            <th class="bg-gray-100 border border-gray-300 px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tiposDocentes as $tipoDocente)
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">{{ $tipoDocente->id_tipo_docente }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $tipoDocente->nombreTipo }}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <a href="{{ route('tiposDocentes.edit', $tipoDocente->id_tipo_docente) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Editar</a>
                                    <form action="{{ route('tiposDocentes.destroy', $tipoDocente->id_tipo_docente) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" onclick="return confirm('¿Estás seguro de querer eliminar este tipo de docente?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
