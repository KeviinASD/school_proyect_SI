@extends('layouts.layout')

@section('title', 'Capacidades')

@section('content')
<div class="bg-white border border-gray-200 shadow-lg p-6 rounded-lg">
    <!-- Menú de navegación -->
    <nav class="">
        <ul class="flex gap-8 border-b py-4">
            <li class="font-semibold hover:text-[#434343] transition duration-300"><a href="{{ route('vista.jerarquica') }}">RESUMEN</a></li>
            <li class="font-semibold hover:text-[#434343] transition duration-300"><a href="{{ route('asignaturas.index') }}">ASIGNATURAS</a></li>
            <li class="text-red-700 font-semibold hover:text-[#434343] transition duration-300"><a href="{{ route('capacidades.index') }}">CAPACIDADES</a></li>
        </ul>
    </nav>
    <h2 class="text-2xl font-semibold mb-4">Lista de Capacidades</h2>
    <a href="{{ route('capacidades.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-medium text-white uppercase hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
        Crear Nueva Capacidad
    </a>
    <div class="mt-6 overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Curso</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descripción</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Abreviatura</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Orden</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($capacidades as $capacidad)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $capacidad->idCapacidad }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $capacidad->asignatura->nombreAsignatura }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $capacidad->descripcion }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $capacidad->abreviatura }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $capacidad->orden }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex items-center space-x-2">
                        <a href="{{ route('capacidades.edit', $capacidad->idCapacidad) }}" class="flex items-center text-blue-600 hover:text-blue-900">
                            <!-- Icono de editar -->
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14m7-7H5"></path>
                            </svg>
                            Editar
                        </a>
                        <form action="{{ route('capacidades.destroy', $capacidad->idCapacidad) }}" method="POST" class="inline">
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
@endsection
