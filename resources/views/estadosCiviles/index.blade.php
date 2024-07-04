@extends('layouts.layout')

@section('content')
    <div class="container mx-auto py-8">
        <h2 class="text-2xl font-semibold mb-4">Estados Civiles</h2>
        <a href="{{ route('estadosCiviles.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mb-4 rounded">Crear Nuevo Estado Civil</a>

        @if ($estadosCiviles->isEmpty())
            <p class="mt-4">No hay estados civiles registrados.</p>
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
                        @foreach ($estadosCiviles as $estadoCivil)
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">{{ $estadoCivil->id_estado_civil }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $estadoCivil->nombreEstadoCivil }}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <a href="{{ route('estadosCiviles.edit', $estadoCivil->id_estado_civil) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Editar</a>
                                    <form action="{{ route('estadosCiviles.destroy', $estadoCivil->id_estado_civil) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" onclick="return confirm('¿Estás seguro de querer eliminar este estado civil?')">Eliminar</button>
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
