@extends('layouts.layout')

@section('title', 'Fichas de Matrícula')

@section('content')
<section>
    <div>
        @if (session('success'))
            <div id="success-message" class="p-4 rounded bg-[#DEF4DB] font-semibold transition duration-300 hover:translate-x-1">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div id="error-message" class="p-4 rounded bg-[#FDE2E2] font-semibold transition duration-300 hover:translate-x-1">
                {{ session('error') }}
            </div>
        @endif
        <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md space-y-4">
            <div class="flex justify-between mb-4 items-start">
                <div class="font-medium">LISTADO DE FICHAS DE MATRÍCULA</div>
                <div class="flex items-center">
                    <a href="{{ route('fichaMatriculas.create') }}" class="px-4 py-1 rounded bg-[#D8E2FD] font-semibold hover:bg-blue-200 transition duration-300 hover:translate-x-1">
                        NUEVA FICHA DE MATRÍCULA
                    </a>
                    <form class="flex items-center ml-4" method="GET" action="{{ route('fichaMatriculas.index') }}">
                        <input name="buscarpor" class="border border-gray-300 py-1 px-2 rounded focus:outline-none focus:ring-red-500" type="search" placeholder="Búsqueda por código de alumno" aria-label="Search" value="{{ request()->input('buscarpor') }}">
                        <button class="ml-2 px-4 py-1 rounded bg-blue-500 text-white">Buscar</button>
                    </form>
                </div>
            </div>
            <div class="overflow-x-auto">
                @if ($fichasMatriculas->isEmpty())
                    <p class="p-4">No hay fichas de matrícula registradas.</p>
                @else
                    <table class="w-full min-w-[600px]">
                        <thead>
                            <tr class="rounded-md">
                                <th class="text-[12px] uppercase tracking-wide font-medium text-gray-500 py-2 px-4 bg-gray-100 text-left rounded-tl-md rounded-bl-md">Nro Matrícula</th>
                                <th class="text-[12px] uppercase tracking-wide font-medium text-gray-500 py-2 px-4 bg-gray-100 text-left">Código Alumno</th>
                                <th class="text-[12px] uppercase tracking-wide font-medium text-gray-500 py-2 px-4 bg-gray-100 text-left">Fecha Matrícula</th>
                                <th class="text-[12px] uppercase tracking-wide font-medium text-gray-500 py-2 px-4 bg-gray-100 text-left">Sección</th>
                                <th class="text-[12px] uppercase tracking-wide font-medium text-gray-500 py-2 px-4 bg-gray-100 text-left">Grado</th>
                                <th class="text-[12px] uppercase tracking-wide font-medium text-gray-500 py-2 px-4 bg-gray-100 text-left">Nivel</th>
                                <th class="text-[12px] uppercase tracking-wide font-medium text-gray-500 py-2 px-4 bg-gray-100 text-left">Año Escolar</th>
                                <th class="text-[12px] uppercase tracking-wide font-medium text-gray-500 py-2 px-4 bg-gray-100 text-left rounded-tr-md rounded-br-md">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fichasMatriculas as $fichaMatricula)
                                <tr class="border-b border-b-gray-50">
                                    <td class="py-3 px-4">{{ $fichaMatricula->nroMatricula }}</td>
                                    <td class="py-3 px-4">{{ $fichaMatricula->codigoAlumno }}</td>
                                    <td class="py-3 px-4">{{ $fichaMatricula->fechaMatricula }}</td>
                                    <td class="py-3 px-4">{{ $fichaMatricula->seccion->nombreSeccion }}</td>
                                    <td class="py-3 px-4">{{ $fichaMatricula->grado->nombreGrado }}</td>
                                    <td class="py-3 px-4">{{ $fichaMatricula->nivel->nombreNivel }}</td>
                                    <td class="py-3 px-4">{{ $fichaMatricula->añoEscolar }}</td>
                                    <td class="py-3 px-4 space-y-1">
                                        <p class="text-center">
                                            <a href="{{ route('fichaMatriculas.edit', $fichaMatricula->nroMatricula) }}" class="inline-block p-2 rounded bg-emerald-200 font-medium text-[12px] leading-none transition duration-300 hover:scale-105">Editar</a>
                                        </p>
                                        <p class="text-center">
                                            <form action="{{ route('fichaMatriculas.destroy', $fichaMatricula->nroMatricula) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de querer eliminar esta ficha de matrícula?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-block p-2 rounded transition duration-300 hover:scale-105 bg-red-400 font-medium text-[12px] leading-none">Eliminar</button>
                                            </form>
                                        </p>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            <div class="mt-5">
                {{ $fichasMatriculas->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const successMessage = document.getElementById('success-message');
        if (successMessage) {
            setTimeout(() => {
                successMessage.classList.add('opacity-0');
                setTimeout(() => {
                    successMessage.remove();
                }, 500);
            }, 3000);
        }

        const errorMessage = document.getElementById('error-message');
        if (errorMessage) {
            setTimeout(() => {
                errorMessage.classList.add('opacity-0');
                setTimeout(() => {
                    errorMessage.remove();
                }, 500);
            }, 3000);
        }
    });
</script>
@endsection
