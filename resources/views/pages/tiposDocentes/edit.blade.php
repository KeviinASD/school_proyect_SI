@extends('layouts.layout')

@section('title', 'Editar Tipo de Docente')

@section('content')
    <div class="container mx-auto py-8">
        <h2 class="text-2xl font-semibold mb-4">Editar Tipo de Docente</h2>

        <form action="{{ route('tiposDocentes.update', $tipoDocente->id_tipo_docente) }}" method="POST" class="max-w-lg mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="nombreTipo">
                    Nombre Tipo
                </label>
                <input type="text" id="nombreTipo" name="nombreTipo" value="{{ old('nombreTipo', $tipoDocente->nombreTipo) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                @error('nombreTipo')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Actualizar</button>
                <a href="{{ route('tiposDocentes.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
