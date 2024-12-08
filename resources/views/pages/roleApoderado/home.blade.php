@extends('layouts.layout')

@section('title', 'MIS CACHORROS')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Tus Cachorros</h1>

    @if($alumnos->isEmpty())
        <p class="text-center text-gray-500">No hay hijos registrados en este año escolar {{$añoEscolarActual}} .</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($alumnos as $alumno)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <img src="https://i.pinimg.com/736x/da/9a/f1/da9af1c2fc1c1152b2a0fb10e0ad7761.jpg" alt="Foto de {{ $alumno->nombres }}" class="w-full h-[50svh] object-cover">
                    <div class="py-8 px-4 bg-[#0A0A0A] rounded-lg -translate-y-2">
                        <h2 class="text-lg font-semibold text-white">{{ $alumno->nombres }} {{ $alumno->apellidos }}</h2>
                        <p class="text-gray-400 mt-2">
                            <strong>Código:</strong> {{ $alumno->codigoAlumno }}<br>
                            <strong>DNI:</strong> {{ $alumno->DNI }}<br>
                        </p>
                        <div class="h-[1px] my-3 bg-gray-500"></div>
                        <p class="text-white text-center font-bold text-xl">{{ $alumno->fichaMatricula->nivel->nombreNivel}}</p>
                        <div class="flex justify-between">
                            <p class="text-gray-400">{{ $alumno->fichaMatricula->grado->nombreGrado}}</p>
                            <p class="text-gray-400"> Seccion {{ $alumno->fichaMatricula->seccion->nombreSeccion}}</p>
                        </div>
                        <div class="h-[1px] my-3 bg-gray-500"></div>
                        <a href="{{ route('alumno.matriculas', $alumno->codigoAlumno ) }}">
                            <button class="text-black font-semibold bg-[#5ECCA0] py-2 px-4 rounded-md">Consultar Cursos</button>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
