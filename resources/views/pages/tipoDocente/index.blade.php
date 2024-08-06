@extends('layouts.layout')

@section('title', 'Tipos de Docentes')

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
            <div class="flex justify-between mb-4 items-center">
                <div class="font-medium">LISTADO DE TIPOS DE DOCENTES</div>
                <a href="{{ route('tipoDocente.create') }}" class="px-4 py-1 rounded bg-[#D8E2FD] font-semibold hover:bg-blue-200 transition duration-300 hover:translate-x-1">
                    NUEVO TIPO DE DOCENTE
                </a>
            </div>
            <div class="overflow-x-auto">
                @if ($tipoDocentes->isEmpty())
                    <p class="p-4">No hay tipos de docentes registrados.</p>
                @else
                    <table class="w-full min-w-[600px] bg-white border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-800 text-white">
                                <th class="text-[12px] uppercase tracking-wide font-medium text-gray-500 py-2 px-4 bg-gray-100 text-left rounded-tl-md">ID</th>
                                <th class="text-[12px] uppercase tracking-wide font-medium text-gray-500 py-2 px-4 bg-gray-100 text-left">Nombre</th>
                                <th class="text-[12px] uppercase tracking-wide font-medium text-gray-500 py-2 px-4 bg-gray-100 text-left rounded-tr-md">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tipoDocentes as $tipoDocente)
                                <tr class="border-b border-b-gray-50">
                                    <td class="p-3 px-4">{{ $tipoDocente->id_tipo_docente }}</td>
                                    <td class="py-3 px-4">{{ $tipoDocente->nombreTipo }}</td>
                                    <td class="py-3 px-4 space-y-1 text-center">
                                        <a href="{{ route('tipoDocente.edit', $tipoDocente->id_tipo_docente) }}" class="inline-block p-2 rounded bg-emerald-200 font-medium text-[12px] leading-none transition duration-300 hover:scale-105">Editar</a>
                                        <form action="{{ route('tipoDocente.destroy', $tipoDocente->id_tipo_docente) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de querer eliminar este tipo de docente?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-block p-2 rounded transition duration-300 hover:scale-105 bg-red-400 font-medium text-[12px] leading-none">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            <div class="mt-5">
                {{ $tipoDocentes->links('vendor.pagination.tailwind') }}
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
