@extends('layouts.layout')

@section('title', 'Tipos de Docente')

@section('content')
    <div class="container mx-auto py-8">
        <h2 class="text-2xl font-semibold mb-4">Tipos de Docente</h2>

        <a href="{{ route('tiposDocentes.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Agregar Tipo de Docente</a>

        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
            <thead>
                <tr class="w-full bg-gray-200 border-b border-gray-300">
                    <th class="py-2 px-4 text-left">Nombre Tipo</th>
                    <th class="py-2 px-4 text-left">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tiposDocentes as $tipoDocente)
                    <tr>
                        <td class="py-2 px-4 border-b border-gray-300">{{ $tipoDocente->nombreTipo }}</td>
                        <td class="py-2 px-4 border-b border-gray-300">
                            <a href="{{ route('tiposDocentes.show', $tipoDocente->id_tipo_docente) }}" class="text-blue-500 hover:text-blue-700">Ver</a>
                            <a href="{{ route('tiposDocentes.edit', $tipoDocente->id_tipo_docente) }}" class="text-blue-500 hover:text-blue-700 ml-4">Editar</a>
                            <form action="{{ route('tiposDocentes.destroy', $tipoDocente->id_tipo_docente) }}" method="POST" class="inline-block ml-4">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
