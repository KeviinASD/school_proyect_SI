@extends('layouts.layout')

@section('title', 'Resumen de Notas')

@section('content') 
<section class="space-y-10">
    <div class="text-center">
        <h1 class="text-3xl font-bold">Resumen de Notas</h1>
        <p class="text-lg text-gray-600">Año Escolar: {{ $añoEscolarActual }}, Periodo: {{ $periodo }}</p>
    </div>

    <div class="space-y-6">
        @forelse($notas_cursos as $curso)
            <div class="border border-gray-300 rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold text-blue-600">{{ $curso['nombre_curso'] }}</h2>

                @if(count($curso['notas_capacidad']) > 0)
                    <table class="w-full mt-4 border-collapse border border-gray-400">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="border border-gray-300 p-2 text-left">Capacidad</th>
                                <th class="border border-gray-300 p-2 text-center">Nota</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($curso['notas_capacidad'] as $capacidad)
                                <tr>
                                    <td class="border border-gray-300 p-2">{{ $capacidad['nombre_capacidad'] }}</td>
                                    <td class="border border-gray-300 p-2 text-center">{{ $capacidad['nota'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-gray-500 mt-4">No hay notas disponibles para este curso.</p>
                @endif
            </div>
        @empty
            <div class="text-center">
                <p class="text-gray-500">No se encontraron cursos para este alumno.</p>
            </div>
        @endforelse
    </div>
</section>
@endsection