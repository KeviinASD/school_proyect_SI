@extends('layouts.layout')

@section('title', 'Reporte de Notas')

@section('content')
<div class="bg-white border border-gray-100 shadow-md p-6 rounded-md">
    <h2 class="text-xl font-medium mb-4">Reporte de Notas para {{ $asignatura->nombreAsignatura }}</h2>
    <table class="min-w-full bg-white border border-gray-300 mt-4">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Nombres</th>
                <th class="py-2 px-4 border-b">Apellidos</th>
                <th class="py-2 px-4 border-b">Nota</th>
            </tr>
        </thead>
        <tbody>
            @forelse($notas as $nota)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $nota->nombres }}</td>
                    <td class="py-2 px-4 border-b">{{ $nota->apellidos }}</td>
                    <td class="py-2 px-4 border-b">{{ $nota->nota }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="py-2 px-4 border-b text-center">No hay notas disponibles</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
