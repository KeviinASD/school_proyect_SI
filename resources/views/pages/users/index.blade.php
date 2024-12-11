@extends('layouts.layout')

@section('title', 'Usuarios')

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
                <div class="font-medium">LISTADO DE USUARIOS</div>
                <form class="flex items-center" method="GET" action="{{ route('users.index') }}">
                    <input name="buscarpor" class="border border-gray-300 py-1 px-2 rounded focus:outline-none focus:ring-red-500" type="search" placeholder="Búsqueda por nombre o correo" aria-label="Search" value="{{ request()->input('buscarpor') }}">
                    <button class="ml-2 px-4 py-1 rounded bg-blue-500 text-white">Buscar</button>
                </form>
            </div>
            <div class="mb-4">
                <a href="{{ route('users.create') }}" class="px-4 py-1 rounded bg-[#D8E2FD] font-semibold hover:bg-blue-200 transition duration-300 hover:translate-x-1">
                    NUEVO USUARIO
                </a>
            </div>
            <div class="overflow-x-auto">
                @if ($users->isEmpty())
                    <p class="p-4">No hay usuarios registrados.</p>
                @else
                    <table class="w-full min-w-[600px]">
                        <thead>
                            <tr class="rounded-md">
                                <th class="text-[12px] uppercase tracking-wide font-medium text-gray-500 py-2 px-4 bg-gray-100 text-left rounded-tl-md rounded-bl-md">Nombre</th>
                                <th class="text-[12px] uppercase tracking-wide font-medium text-gray-500 py-2 px-4 bg-gray-100 text-left">Correo Electrónico</th>
                                <th class="text-[12px] uppercase tracking-wide font-medium text-gray-500 py-2 px-4 bg-gray-100 text-left">Fecha de Creación</th>
                                <th class="text-[12px] uppercase tracking-wide font-medium text-gray-500 py-2 px-4 bg-gray-100 text-left">Rol</th>
                                <th class="text-[12px] uppercase tracking-wide font-medium text-gray-500 py-2 px-4 bg-gray-100 text-left rounded-tr-md rounded-br-md">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="border-b border-b-gray-50">
                                    <td class="py-3 px-4">{{ $user->name }}</td>
                                    <td class="py-3 px-4">{{ $user->email }}</td>
                                    <td class="py-3 px-4">{{ $user->created_at->format('d/m/Y') }}</td>
                                    <td class="py-3 px-4">
                                        <span class="px-4 py-2 rounded-lg {{ $user->role == 'admin' ? 'bg-red-500 text-white' : 'bg-blue-500 text-white' }} text-[12px] font-medium">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 space-y-1 flex justify-center gap-2 items-center">
                                        @if($user->role != 'admin') 
                                        <p class="text-center">
                                            <a href="{{ route('users.edit', $user->id) }}" class="inline-block p-2 rounded bg-emerald-200 font-medium text-[12px] leading-none transition duration-300 hover:scale-105">Editar</a>
                                        </p>
                                        <p class="text-center">
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de querer eliminar este usuario?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-block p-2 rounded transition duration-300 hover:scale-105 bg-red-400 font-medium text-[12px] leading-none">Eliminar</button>
                                            </form>
                                        </p>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            <div class="mt-5">
                {{ $users->links('vendor.pagination.tailwind') }}
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
