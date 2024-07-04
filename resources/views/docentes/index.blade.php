@extends('layouts.layout')

@section('content')
    <div class="container mx-auto py-8">
        <h2 class="text-2xl font-semibold mb-4">Docentes</h2>
        <a href="{{ route('docentes.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mb-4 rounded">Crear Nuevo Docente</a>

        @if ($docentes->isEmpty())
            <p class="mt-4">No hay docentes registrados.</p>
        @else
            <div class="overflow-x-auto mt-8">
                <table class="min-w-full bg-white border-collapse border border-gray-300">
                    <thead>
                        <tr>
                            <th class="bg-gray-100 border border-gray-300 px-4 py-2">Código</th>
                            <th class="bg-gray-100 border border-gray-300 px-4 py-2">DNI</th>
                            <th class="bg-gray-100 border border-gray-300 px-4 py-2">Apellidos</th>
                            <th class="bg-gray-100 border border-gray-300 px-4 py-2">Nombres</th>
                            <th class="bg-gray-100 border border-gray-300 px-4 py-2">Dirección</th>
                            <th class="bg-gray-100 border border-gray-300 px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($docentes as $docente)
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">{{ $docente->codigo_docente }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $docente->DNI }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $docente->apellidos }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $docente->nombres }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $docente->direccion }}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <a href="{{ route('docentes.edit', $docente->codigo_docente) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Editar</a>
                                    <form action="{{ route('docentes.destroy', $docente->codigo_docente) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" onclick="return confirm('¿Estás seguro de querer eliminar este docente?')">Eliminar</button>
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
