@extends('layouts.layout')
@section('title', 'Niveles')

@section('content')
<section >
<nav class="mb-10">
        <ul class="flex gap-8 border-b py-4">
            <li class="font-semibold hover:text-[#434343] hover:scale-110 transition duration-300"><a href="{{ route('gradosYSecciones') }}">RESUMEN</a></li>
            <li class="font-semibold hover:text-[#434343] hover:scale-110 transition duration-300"><a href="{{ route('niveles.index') }}">NIVELES</a></li>
            <li class="font-semibold hover:text-[#434343] hover:scale-110 transition duration-300"><a href="{{ route('grados.index') }}">GRADOS</a></li>
            <li class="text-red-700 font-semibold hover:text-[#434343] hover:scale-110 transition duration-300"><a href="{{ route('secciones.index') }}">SECCIONES</a></li>
        </ul>
</nav>
<div>
        <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
            <div class="flex justify-between mb-4 items-start">
                <div class="font-medium">DETALLES SECCIONES</div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full min-w-[460px]">
                    <thead>
                        <tr>
                            <th class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tl-md rounded-bl-md">IDSECCION</th>
                            <th class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left">NIVEL</th>
                            <th class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left">GRADO</th>
                            <th class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left">NOMBRE SECCION</th>
                            <th class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tr-md rounded-br-md">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($secciones as $seccion)

                        <tr>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <div class="flex items-center">
                                    <a href="#" class="text-gray-600 text-sm font-medium hover:text-blue-500 ml-2 truncate">{{$seccion->idSeccion}}</a>
                                </div>
                            </td>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <span class="text-[13px] font-medium text-emerald-500">{{$seccion->nivel->nombreNivel}}</span>
                            </td>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <span class="text-[13px] font-medium text-emerald-500">{{$seccion->grado->nombreNivel}}</span>
                            </td>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <span class="text-[13px] font-medium text-emerald-500">{{$seccion->nombreSeccion}}</span>
                            </td>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <button class="inline-block p-2 rounded bg-emerald-500/10 text-emerald-500 font-medium text-[12px] leading-none">EDITAR</button>
                                <button class="inline-block p-2 rounded bg-red-400/10 text-red-500 font-medium text-[12px] leading-none">ELIMINAR</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
</div>
</section>

@endsection