@extends('layouts.layout')
@section('title', 'Registro Notas')

@section('content')
<section>
    <div class="space-y-4">
        <h1 class="font-bold">REGISTRO DE NOTAS POR DOCENTE</h1>
        <div>
           <select name="" id="" class="w-full rounded-lg border-2 px-5 py-2">
                <option value="">Seleccione un docente</option>
                @foreach($docentes as $docente)
                    <option value="{{ $docente->codigo_docente }}">{{ $docente->apellidos }}, {{ $docente->nombres }}</option>
                @endforeach
            </select>
        </div>
        <div class="grid grid-cols-3 gap-6">
            <div class="bg-sky-700/10 rounded-lg flex justify-start items-center shadow-md">
                <ul class="pl-8">
                    <li> <span class="font-mono font-semibold">Docente:</span> {{ $docente->apellidos }}, {{ $docente->nombres }} </li>
                    <li> <span class="font-mono font-semibold">DNI:</span> {{ $docente->DNI }} </li>
                    <li> <span class="font-mono font-semibold">Direccion:</span> {{ $docente->direccion }} </li>
                </ul>
            </div>
            <div class=" space-y-4 col-span-2">
                <div class="w-full rounded-lg border-2 px-5 flex justify-center items-center">
                    <svg class="h-5 w-5 text-gray-200 inline-block"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <circle cx="10" cy="10" r="7" />  <line x1="8" y1="8" x2="12" y2="12" />  <line x1="12" y1="8" x2="8" y2="12" />  <line x1="21" y1="21" x2="15" y2="15" /></svg>
                    <input type="text" class="inline-block p-2 outline-none" placeholder="Buscar Asignaturas">
                </div>
                <table class="w-full">
                    <thead>
                        <tr>
                            <th>Asignatura</th>
                            <th>Curso ID</th>
                            {{-- <th>Nivel</th>
                            <th>Grado</th>
                            <th>Seccion</th> --}}
                            <th>Registrar Notas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($catedras) == 0)
                            <tr>
                                <td colspan="2">No hay registros</td>
                            </tr>
                        @else
                        @foreach($catedras as $catedra)
                            <tr>
                                <td class="p-2 border-l">{{ $catedra->nombreAsignatura }}</td>
                                <td class="p-2 border-l">{{ $catedra->idCurso }}</td>
                                {{-- <td class="p-2 border-l">{{ $catedra->idNivel }}</td>
                                <td class="p-2 border-l">{{ $catedra->idGrado }}</td>
                                <td class="p-2 border-l">{{ $catedra->idSeccion }}</td> --}}
                                <td class="p-2 pl-4 border-l text-center">
                                    <a href="{{ route('notas.registro', $docente->codigo_docente) }}" class="bg-black-primary-100 hover:bg-blue-700  text-white font-bold py-2 px-4 rounded duration-300 animate-none">Registrar</a>
                                </td>
                            </tr>
                        @endforeach
                        @endif
                            
                    </tbody>
                </table>
            </div>
            <div class="col-span-3 space-y-4 mt-4">
                <h1 class="font-bold">DETALLE MIS ASIGNATURAS</h1>
                <div class="grid grid-cols-3 gap-4">
                    @forEach($catedras as $catedra)
                    <div class="bg-white shadow-md rounded-lg flex justify-start items-center border">
                        <div class="w-full">
                            <img src="https://www.w3schools.com/css/img_forest.jpg" alt="" class="w-full rounded-t-lg h-[200px] object-cover">
                            <div class="p-4 space-y-2">
                                {{ $catedra->nombreAsignatura }} (  {{ $catedra->idNivel }} - {{$catedra->idGrado}} - {{$catedra->idSeccion}} )
                                <p class="rounded-x">
                                    <span class="inline-block w-full rounded-xl bg-gray-200 h-2 relative">
                                        <span class="rounded-xl inline-block h-2 bg-sky-700 w-5 absolute top-0"></span>
                                    </span>
                                </p>
                                <p class="text-xs text-gray-400">4% completada</p>
                            </div>
                        </div>
                    </div>
                    @endForEach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
