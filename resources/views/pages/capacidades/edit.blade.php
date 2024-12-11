@extends('layouts.layout')

@section('title', 'Editar Capacidad')

@section('content')
<div class="bg-white border border-gray-200 shadow-lg p-6 rounded-lg">
    <h2 class="text-2xl font-semibold mb-4">Editar Capacidad</h2>
    <form method="POST" action="{{ route('capacidades.update', $capacidad->idCapacidad) }}">
        @csrf
        @method('PUT')
        <div class="space-y-4">
            <!-- Asignatura -->
            <div>
                <label for="idAsignatura" class="block text-sm font-medium text-gray-700">Asignatura</label>
                <select id="idAsignatura" name="idAsignatura" class="mt-1 block w-full h-10 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                    <option value="">Selecciona una Asignatura</option>
                    @foreach($asignaturas as $asignatura)
                        <option value="{{ $asignatura->idAsignatura }}" {{ $capacidad->idAsignatura == $asignatura->idAsignatura ? 'selected' : '' }}>{{ $asignatura->nombreAsignatura }}</option>
                    @endforeach
                </select>
                @error('idAsignatura')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Descripción -->
            <div>
                <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                <input type="text" id="descripcion" name="descripcion" value="{{ old('descripcion', $capacidad->descripcion) }}" class="mt-1 p-2 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                @error('descripcion')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Abreviatura -->
            <div>
                <label for="abreviatura" class="block text-sm font-medium text-gray-700">Abreviatura</label>
                <input type="text" id="abreviatura" name="abreviatura" value="{{ old('abreviatura', $capacidad->abreviatura) }}" class="mt-1 p-2 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                @error('abreviatura')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Orden -->
            <div>
                <label for="orden" class="block text-sm font-medium text-gray-700">Orden</label>
                <input type="number" id="orden" name="orden" value="{{ old('orden', $capacidad->orden) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                @error('orden')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">Actualizar Capacidad</button>
            </div>
        </div>
    </form>
</div>
@endsection