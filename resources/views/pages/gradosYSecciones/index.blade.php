@extends('layouts.layout')

@section('title', 'Grados y Secciones')

@section('content')


<section class=" space-y-4">
    @php
        $isGris = false; // Definiendo la variable
    @endphp
    <nav class="">
        <ul class="flex gap-8 border-b py-4">
            <li class="text-red-700 font-semibold hover:text-[#434343] transition duration-300"><a href="{{ route('gradosYSecciones') }}">RESUMEN</a></li>
            <li class="font-semibold hover:text-[#434343] transition duration-300"><a href="{{ route('niveles.index') }}">NIVELES</a></li>
            <li class="font-semibold hover:text-[#434343] transition duration-300"><a href="{{ route('grados.index') }}">GRADOS</a></li>
            <li class="font-semibold hover:text-[#434343] transition duration-300"><a href="{{ route('secciones.index') }}">SECCIONES</a></li>
        </ul>
    </nav>
    <div class="container">
        <h1 class="text-2xl font-bold mb-4">Cantidades</h1>
        <div class="grid grid-cols-3 min-w-[200px] gap-4">
            <div class="columns-1 space-y-2 border p-4 rounded-md bg-[#DEF4DB] shadow-md">
                <h1>Niveles</h1>
                <p>{{count($niveles)}}</p>
            </div>
            <div class="columns-1 space-y-2 border p-4 rounded-md bg-[#D8E2FD] shadow-md">
                <h1>Grados</h1>
                <p>{{count($grados)}}</p>
            </div>
            <div class="columns-1 space-y-2 border p-4 rounded-md bg-[#EEDBF1] shadow-md">
                <h1>Secciones</h1>
                <p>{{count($secciones)}}</p>
            </div>
        </div>
    </div>
    <h1 class="font-bold text-2xl">Niveles</h1>

    <div class="rounded-xl border overflow-auto h-[80vh]">
        <table class=" w-full">
            <thead class="">
                <tr class="bg-gray-100 font-semibold">
                    <th class="font-normal text-start p-4 -space-y-2">
                        <p>Niveles</p>
                        <p class="pl-5"> 
                            <svg class="h-8 w-7 text-gray-500 inline-block"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <line x1="5" y1="12" x2="19" y2="12" /></svg> 
                            <svg class="h-8 w-4 text-gray-700 inline-block rotate-90 -translate-x-9 -translate-y-1"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <line x1="5" y1="12" x2="19" y2="12" /></svg> 
                            <span class="-translate-x-4 inline-block">Grados</span>
                        </p>
                        <p class="pl-16">
                            <svg class="h-8 w-7 text-gray-500 inline-block"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <line x1="5" y1="12" x2="19" y2="12" /></svg> 
                            <svg class="h-8 w-4 text-gray-700 inline-block rotate-90 -translate-x-9 -translate-y-1"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <line x1="5" y1="12" x2="19" y2="12" /></svg> 
                            <span class="-translate-x-4 inline-block">Secciones</span>
                        </p>
                    </th>
                    <th class="font-normal text-start align-text-top border-l-2 pl-2 pt-4">
                        <p>Overview</p>
                    </th>
                    <th class="font-normal text-start align-text-top border-l-2 pl-2 pt-4">
                        <p>Details</p>
                    </th>
                </tr>
            </thead>
                @foreach ($niveles as $nivel)
                <tr class="bg-[#DEF4DB]">
                    <td >
                        <button class="toggle-btn w-full h-full py-7 pl-4 flex justify-start items-center gap-2">
                            <svg class="h-5 w-5 inline-block text-gray-400"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <line x1="12" y1="5" x2="12" y2="19" />  <line x1="5" y1="12" x2="19" y2="12" /></svg>
                            <svg class="h-5 w-5 text-gray-300"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <circle cx="12" cy="12" r="10" />  <circle cx="12" cy="12" r="4" />  <line x1="4.93" y1="4.93" x2="9.17" y2="9.17" />  <line x1="14.83" y1="14.83" x2="19.07" y2="19.07" />  <line x1="14.83" y1="9.17" x2="19.07" y2="4.93" />  <line x1="14.83" y1="9.17" x2="18.36" y2="5.64" />  <line x1="4.93" y1="19.07" x2="9.17" y2="14.83" /></svg>
                            <span class="font-semibold">{{$nivel->nombreNivel}}</span>
                        </button>
                    </td>
                    <td class="pl-4 border-l-2">{{count($nivel->grados)}} Grados</td>
                    <td class="pl-4 border-l-2">Colletion Ad</td>
                    @php
                        $isGris = !$isGris;
                    @endphp
                </tr>
                @if($nivel->grados->count() > 0)
                    
                    @foreach ($nivel->grados as $grado)
                    @if($grado->estado == 1)
                    <tr class="{{$isGris ? 'bg-gray-50':''}}">
                        <td class="pl-12 border-l">
                            <button class="w-full h-full py-7 pl-4 flex justify-start items-center gap-2 border-l-2">
                                <svg class="h-5 w-5 inline-block text-gray-400"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <line x1="12" y1="5" x2="12" y2="19" />  <line x1="5" y1="12" x2="19" y2="12" /></svg>
                                <svg class="h-5 w-5 text-slate-300"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <line x1="8" y1="21" x2="16" y2="21" />  <line x1="12" y1="17" x2="12" y2="21" />  <line x1="7" y1="4" x2="17" y2="4" />  <path d="M17 4v8a5 5 0 0 1 -10 0v-8" />  <circle cx="5" cy="9" r="2" />  <circle cx="19" cy="9" r="2" /></svg>                                  
                                <span class="font-semibold">{{$grado->nombreGrado}}</span>
                            </button>
                        </td>
                        <td class="pl-4 border-l-2">{{count($grado->secciones)}} Secciones</td>
                        <td class="pl-4 border-l-2">Colletion Ad</td>
                        @php
                            $isGris = !$isGris;
                        @endphp
                    </tr>

                    @foreach ($grado->secciones as $seccion)
                    @if($seccion->estado == 1)
                        <tr class="{{$isGris ? 'bg-gray-50':''}}">
                            <td class="pl-24 ">
                                <p class="border-l-2 w-full h-full py-7 pl-4 flex justify-start items-center gap-2">
                                    <svg class="h-5 w-5 text-slate-300"  fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"/></svg>
                                    <span class="font-semibold">{{$seccion->nombreSeccion}}</span>
                                </p>
                            </td>
                            <td class="pl-4 border-l-2"></td>
                            <td class="pl-4 border-l-2">Colletion Ad</td>
                            @php
                                $isGris = !$isGris;
                            @endphp
                        </tr>
                    @endif
                    @endforeach
                    

                    @endif
                    @endforeach
                @endif
                @endforeach
            <tbody>
    
            </tbody>
        </table>
    </div>
    {{-- <div class="p-6 border border-md shadow-md border-gray-100 shadow-black/5 space-y-4">
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
    </div> --}}

</section>
@endsection

