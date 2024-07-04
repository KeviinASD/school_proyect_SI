@extends('layouts.layout')

@section('title', 'Grados y Secciones')

@section('content')
<section class="container space-y-4">

    <nav class="">
        <ul class="flex gap-8 border-b py-4">
            <li class="text-red-700 font-semibold hover:text-[#434343] hover:scale-110 transition duration-300"><a href="{{ route('gradosYSecciones') }}">RESUMEN</a></li>
            <li class="font-semibold hover:text-[#434343] hover:scale-110 transition duration-300"><a href="{{ route('niveles.index') }}">NIVELES</a></li>
            <li class="font-semibold hover:text-[#434343] hover:scale-110 transition duration-300"><a href="{{ route('grados.index') }}">GRADOS</a></li>
            <li class="font-semibold hover:text-[#434343] hover:scale-110 transition duration-300"><a href="{{ route('secciones.index') }}">SECCIONES</a></li>
        </ul>
    </nav>
    <div>
        <h1 class="text-2xl font-bold mb-4">Cantidades</h1>
        <div class="grid grid-cols-3 min-w-[200px] gap-4">
            <div class="columns-1 space-y-2 border p-4 rounded-md bg-[#DEF4DB]">
                <h1>Niveles</h1>
                <p>{{count($niveles)}}</p>
            </div>
            <div class="columns-1 space-y-2 border p-4 rounded-md bg-[#D8E2FD]">
                <h1>Grados</h1>
                <p>{{count($grados)}}</p>
            </div>
            <div class="columns-1 space-y-2 border p-4 rounded-md bg-[#EEDBF1]">
                <h1>Secciones</h1>
                <p>{{count($secciones)}}</p>
            </div>
        </div>
    </div>
    <h1 class="font-bold text-2xl">Niveles</h1>
    <div class="p-6 border border-md shadow-md border-gray-100 shadow-black/5 space-y-4">
        @foreach ($niveles as $nivel)
        <details class="group">
            <summary class="flex justify-between items-center font-medium cursor-pointer list-none">
                <span>{{$nivel->nombreNivel}}</span>
                <span class="transition group-open:rotate-180">
                    <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24" class="text-green-700">
                        <path d="M6 9l6 6 6-6"></path>
                    </svg>
                </span>
            </summary>
            <div class="ml-8">
                @foreach ($nivel->grados as $grado)
                    <details class="group">
                        <summary class="flex items-center font-medium cursor-pointer list-none gap-2">
                            <p class="text-gray-600">{{$grado->nombreGrado}}</p>
                            <svg class="hover:translate-x-1 duration-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" data-icon="SvgArrowRight3" aria-hidden="true"><path d="M12.933 16.667L18 12m0 0H6m12 0l-5.067-4.667"></path></svg>
                        </summary>
                        <div class="ml-8">
                            @if ($grado->secciones->count() > 0)
                                @foreach ($grado->secciones as $seccion)
                                    <p class="text-gray-500 text-sm">{{ $seccion->nombreSeccion }}</p>
                                @endforeach
                            @else
                                <p class="text-red-400 text-sm">No hay secciones</p>
                            @endif                                
                        </div>
                    </details>
                @endforeach
            </div>
        </details>
        @endforeach
    </div>


</section>
@endsection



<!-- <div>
        <h2>Grados</h2>
        <form action="{{ route('grados.store') }}" method="POST">
            @csrf
            <select name="idNivel" required>
                @foreach ($niveles as $nivel)
                <option value="{{ $nivel->idNivel }}">{{ $nivel->nombreNivel }}</option>
                @endforeach
            </select>
            <input type="text" name="nombreGrado" placeholder="Nombre del Grado" required>
            <button type="submit">Crear Grado</button>
        </form>
    </div> -->