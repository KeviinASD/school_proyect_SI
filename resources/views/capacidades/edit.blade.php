@extends('layouts.layout')

@section('title', 'Editar Capacidad')

@section('content')
<div class="bg-white border border-gray-100 shadow-md p-6 rounded-md">
    <h2 class="text-xl font-medium mb-4">Editar Capacidad</h2>

    <!-- Mensaje de error -->
    @if($errors->any())
    <div class="mb-4 p-4 bg-red-100 text-red-800 border border-red-300 rounded-md">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
    @endif

    <form action="{{ route('capacidades.update', $capacidad->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="idAsignatura" class="block text-sm font-medium text-gray-700">Asignatura</label>
            <select id="idAsignatura" name="idAsignatura" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                @foreach ($asignaturas as $asignatura)
                <option value="{{ $asignatura->idAsignatura }}" {{ old('idAsignatura', $capacidad->idAsignatura) == $asignatura->idAsignatura ? 'selected' : '' }}>{{ $asignatura->nombreAsignatura }}</option>
                @endforeach
            </select>
            @error('idAsignatura')
            <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
            <input type="text" id="descripcion" name="descripcion" value="{{ old('descripcion', $capacidad->descripcion) }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
            @error('descripcion')
            <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="orden" class="block text-sm font-medium text-gray-700">Orden</label>
            <input type="number" id="orden" name="orden" value="{{ old('orden', $capacidad->orden) }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
            @error('orden')
            <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex justify-end">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-700">
                Actualizar Capacidad
            </button>
        </div>
    </form>
</div>
@endsection
