@extends('layouts.layout')

@section('title', 'Asignaturas')

@section('content')
<div class="bg-white border border-gray-200 shadow-sm rounded-lg p-6">
    <h2 class="text-2xl font-semibold mb-6">Lista de Asignaturas</h2>
    <a href="{{ route('asignaturas.create') }}" class="inline-flex items-center px-5 py-2.5 bg-blue-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:border-blue-800 focus:ring focus:ring-blue-200 transition">
        Crear Nueva Asignatura
    </a>

    <!-- Mensaje de éxito -->
    @if(session('success'))
    <div id="success-message" class="mb-4 p-4 bg-green-100 text-green-800 border border-green-300 rounded-md">
        {{ session('success') }}
    </div>
    @endif

    <div class="overflow-x-auto mt-6">
        <table class="min-w-full divide-y divide-gray-300">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Curso</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Grado</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nivel</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Asignatura</th> <!-- Nueva columna -->
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($asignaturas as $asignatura)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $asignatura->idAsignatura }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $asignatura->curso->nombreCurso }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $asignatura->grado->nombreGrado }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $asignatura->nivel->nombreNivel }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $asignatura->nombreAsignatura }}</td> <!-- Muestra el nombre de la asignatura -->
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex items-center space-x-4">
                        <a href="{{ route('asignaturas.edit', $asignatura->idAsignatura) }}" class="flex items-center text-blue-600 hover:text-blue-900">
                            <!-- Icono de editar -->
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14m7-7H5"></path>
                            </svg>
                            Editar
                        </a>
                        <form action="{{ route('asignaturas.destroy', $asignatura->idAsignatura) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta asignatura?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="flex items-center text-red-600 hover:text-red-900">
                                <!-- Icono de eliminar -->
                                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var successMessage = document.getElementById('success-message');
        if (successMessage) {
            setTimeout(function () {
                successMessage.style.opacity = '0';
                setTimeout(function () {
                    successMessage.style.display = 'none';
                }, 200); // Tiempo para la transición de opacidad
            }, 1000); // Tiempo para que el mensaje se oculte
        }
    });
</script>
@endsection
