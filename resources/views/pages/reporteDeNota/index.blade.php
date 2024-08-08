@extends('layouts.layout')

@section('title', 'Generar Reporte de Notas')

@section('content')
<div class="bg-white border border-gray-100 shadow-md p-6 rounded-md">
    <h2 class="text-xl font-medium mb-4">Generar Reporte de Notas</h2>
    <form action="{{ route('reporteDeNotas.generar') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="idAsignatura" class="block text-sm font-medium text-gray-700">Seleccionar Asignatura</label>
            <select id="idAsignatura" name="idAsignatura" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="">Seleccionar</option>
                @foreach($asignaturas as $asignatura)
                    <option value="{{ $asignatura->idAsignatura }}">{{ $asignatura->nombreAsignatura }}</option>
                @endforeach
            </select>
            @error('idAsignatura')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 disabled:opacity-60 transition">
                Generar Reporte
            </button>
        </div>
    </form>
</div>
@endsection
