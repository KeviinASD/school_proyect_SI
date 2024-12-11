@extends('layouts.layout')

@section('title', 'Asignaturas Resumen')

@section('content')
<div class="bg-white border border-gray-200 shadow-sm rounded-lg p-6">
    <!-- Menú de navegación -->
    <nav class="">
        <ul class="flex gap-8 border-b py-4">
            <li class="text-red-700 font-semibold hover:text-[#434343] transition duration-300"><a href="{{ route('vista.jerarquica') }}">RESUMEN</a></li>
            <li class="font-semibold hover:text-[#434343] transition duration-300"><a href="{{ route('asignaturas.index') }}">ASIGNATURAS</a></li>
            <li class="font-semibold hover:text-[#434343] transition duration-300"><a href="{{ route('capacidades.index') }}">CAPACIDADES</a></li>
        </ul>
    </nav>

    <div class="container">
        <h1 class="text-2xl font-bold mb-4">Cantidades</h1>
        <div class="grid grid-cols-3 min-w-[200px] gap-4">
            <div class="columns-1 space-y-2 border p-4 rounded-md bg-[#DEF4DB] shadow-md">
                <h1>Cursos</h1>
                <p>{{count($asignaturas)}}</p>
            </div>
            <div class="columns-1 space-y-2 border p-4 rounded-md bg-[#D8E2FD] shadow-md">
                <h1>Capacidades</h1>
                <p>{{count($capacidades)}}</p>
            </div>
        </div>
    </div>


    <!-- Vista jerárquica -->
    <div class="bg-white shadow rounded-lg">
        <div class="border-b border-gray-200 p-4">
            <h5 class="text-lg font-bold text-gray-700">Listado de Asignaturas y sus Capacidades</h5>
        </div>
        <div class="p-4">
            @foreach ($asignaturas as $asignatura)
                <div class="mb-6">
                    <h6 class="text-lg font-semibold text-blue-600">{{ $asignatura->nombreAsignatura }}</h6>
                    <ul class="list-disc list-inside mt-2">
                        @foreach ($asignatura->capacidades as $capacidad)
                            <li class="text-gray-600">{{ $capacidad->descripcion }}</li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection