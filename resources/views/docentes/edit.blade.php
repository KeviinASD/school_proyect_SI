@extends('layouts.layout')

@section('content')
    <div class="container mx-auto py-8">
        <h2 class="text-2xl font-semibold mb-4">Editar Docente</h2>

        <form action="{{ route('docentes.update', $docente->codigo_docente) }}" method="POST" class="max-w-lg mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="DNI">
                    DNI
                </label>
                <input type="text" id="DNI" name="DNI" value="{{ $docente->DNI }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="apellidos">
                    Apellidos
                </label>
                <input type="text" id="apellidos" name="apellidos" value="{{ $docente->apellidos }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="nombres">
                    Nombres
                </label>
                <input type="text" id="nombres" name="nombres" value="{{ $docente->nombres }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="direccion">
                    Dirección
                </label>
                <input type="text" id="direccion" name="direccion" value="{{ $docente->direccion }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="fechaIngreso">
                    Fecha de Ingreso
                </label>
                <input type="date" id="fechaIngreso" name="fechaIngreso" value="{{ $docente->fechaIngreso }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="id_tipo_docente">
                    Tipo de Docente
                </label>
                <select name="id_tipo_docente" id="id_tipo_docente" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    @foreach ($tiposDocentes as $tipoDocente)
                        <option value="{{ $tipoDocente->id_tipo_docente }}" {{ $docente->id_tipo_docente == $tipoDocente->id_tipo_docente ? 'selected' : '' }}>{{ $tipoDocente->nombreTipo }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="id_estado_civil">
                    Estado Civil
                </label>
                <select name="id_estado_civil" id="id_estado_civil" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    @foreach ($estadosCiviles as $estadoCivil)
                        <option value="{{ $estadoCivil->id_estado_civil }}" {{ $docente->id_estado_civil == $estadoCivil->id_estado_civil ? 'selected' : '' }}>{{ $estadoCivil->nombreEstadoCivil }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Guardar Cambios</button>
                <a href="{{ route('docentes.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
