@extends('layouts.layout')
@section('title', 'Niveles')

@section('content')
<section>
    <nav class="mb-10">
        <ul class="flex gap-8 border-b py-4">
            <li class="font-semibold hover:text-[#434343]  transition duration-300"><a href="{{ route('gradosYSecciones') }}">RESUMEN</a></li>
            <li class=" font-semibold hover:text-[#434343]  transition duration-300"><a href="{{ route('niveles.index') }}">NIVELES</a></li>
            <li class=" text-red-700 font-semibold hover:text-[#434343]  transition duration-300"><a href="{{ route('grados.index') }}">GRADOS</a></li>
            <li class="font-semibold hover:text-[#434343]  transition duration-300"><a href="{{ route('secciones.index') }}">SECCIONES</a></li>
        </ul>
    </nav>
    <div>
        @if (session('success'))
        <div id="success-message" class="p-4 rounded bg-[#DEF4DB] font-semibold transition duration-300 hover:translate-x-1">
            {{ session('success') }}
        </div>
        @endif
        @if (session('error'))
        <div id="success-message" class="p-4 rounded bg-[#FDE2E2] font-semibold transition duration-300 hover:translate-x-1">
            {{ session('error') }}
        </div>
        @endif
        <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md space-y-4">
            <div class="flex justify-between mb-4 items-start">
                <div class="font-medium">DETALLES GRADOS</div>
                <form action="{{ route('grados.index') }}" method="GET" class="flex items-center">
                    <select name="nivel_id" class="border border-gray-300 py-1 px-2 rounded focus:outline-none focus:right-2 focus:ring-red-500">
                        <option value="">Todos los Niveles</option>
                        @foreach ($niveles as $nivel)
                        <option value="{{ $nivel->idNivel }}" {{ request('nivel_id') == $nivel->idNivel ? 'selected' : '' }}>
                            {{ $nivel->nombreNivel }}
                        </option>
                        @endforeach
                    </select>
                    <button type="submit" class="ml-2 px-4 py-1 rounded bg-blue-500 text-white">Filtrar</button>
                </form>
            </div>
            <div>
                <button class="px-4 py-2 rounded bg-black-primary-200 text-white font-semibold hover:bg-black-primary-100 transition duration-300"><a href=" {{route('grados.create')}}">CREAR GRADO</a></button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full min-w-[460px]">
                    <thead>
                        <tr class="rounded-md">
                            <th class="text-[12px] uppercase tracking-wide font-medium text-gray-500 py-2 px-4 bg-gray-100 text-left rounded-tl-md rounded-bl-md">IDGRADO</th>
                            <th class="text-[12px] uppercase tracking-wide font-medium text-gray-500 py-2 px-4 bg-gray-100 text-left"><span class="border-l-gray-500 border-l pl-2">NIVEL</span></th>
                            <th class="text-[12px] uppercase tracking-wide font-medium text-gray-500 py-2 px-4 bg-gray-100 text-left"><span class="border-l-gray-500 border-l pl-2">GRADO</span></th>
                            <th class="text-[12px] uppercase tracking-wide font-medium text-gray-500 py-2 px-4 bg-gray-100 text-left"><span class="border-l-gray-500 border-l pl-2">STATUS</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($grados as $grado) 

                        <tr>
                            <td class="p-3 px-4 border-b border-b-gray-50">
                                <div class="flex items-center">
                                    <a href="#" class="text-gray-600 text-sm font-medium hover:text-blue-500 ml-2 truncate">{{$grado->idGrado}}</a>
                                </div>
                            </td>
                            <td class="py-3 px-4 border-b border-b-gray-50">
                                <span class="text-[13px] font-medium">{{$grado->nivel->nombreNivel}}</span>
                            </td>
                            <td class="py-3 px-4 border-b border-b-gray-50">
                                <span class="text-[13px] font-medium">{{$grado->nombreGrado}}</span>
                            </td>
                            <td class="py-3 px-4 border-b border-b-gray-50 space-x-2">
                                <button class="inline-block p-2 rounded bg-emerald-200 font-medium text-[12px] leading-none  transition duration-300 hover:scale-105"><a href="{{ route('grados.edit', $grado->idGrado) }}">EDITAR</a></button>
                                <form action="{{ route('grados.destroy', $grado->idGrado) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este grado?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-block p-2 rounded transition duration-300 hover:scale-105 bg-red-400 font-medium text-[12px] leading-none">ELIMINAR</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-5">
                    {{ $grados->links('vendor.pagination.tailwind') }}
                </div>
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
                }, 500); // Tiempo igual al de la transición de desvanecimiento
            }, 3000); // Tiempo en milisegundos antes de comenzar el desvanecimiento (3 segundos)
        }
    });
</script>
@endsection