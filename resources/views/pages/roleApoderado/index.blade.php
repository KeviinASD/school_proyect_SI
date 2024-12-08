@extends('layouts.layout')

@section('title', 'MATRICULAS ALUMNOS')

@section('content')
    <section class="space-y-10">
        
        {{-- COMO SE COLOCAN LOS ERRORES --}}
        @if ($errors->has('error'))
            <div id="error-message" class="bg-red-500 text-white p-3 rounded mb-4">
                {{ $errors->first('error') }}
            </div>
        @endif
        <div>
            <a href="{{ route('alumno.todasNotas', $fichaMatricula->codigoAlumno ) }}">
                <button class="bg-black text-white py-2 px-4 rounded-md font-semibold">Resumen Notas</button>
            </a>
        </div>
        <div class="grid grid-cols-3 gap-10">
            <p>ALUMNO: {{$fichaMatricula->alumno->nombres}}</p>
            <p>AÑO ESCOLAR: {{$añoEscolarActual}}</p>
            <p class="">NIVEL: {{$fichaMatricula->nivel->nombreNivel}}</p>
            <p>GRADO: {{$fichaMatricula->grado->nombreGrado}}</p>
            <p>SECCION: {{$fichaMatricula->seccion->nombreSeccion}}</p>
        </div>

        <section class="grid grid-cols-3 gap-4">
            @foreach($cursosDeEseAñoC as $curso)
            <div class="bg-white shadow-lg  p-4 rounded-lg">
                <img src="https://i.pinimg.com/736x/0a/69/25/0a69252d89192baa4761610d53225b8e.jpg" class="w-full h-[30svh] object-cover rounded-lg">
                <div class="my-5">
                    <p class="font-semibold text-lg">{{ $curso->asignatura->nombreAsignatura }} ( {{$curso->nivel->nombreNivel}} - {{$curso->grado->nombreGrado}} - {{$curso->seccion->nombreSeccion}} )</p>
                </div>
                
                {{-- ACCIONES --}}
                <div class="flex justify-between items-center">
                    {{-- DATOS DEL PROFESOR --}}
                    <div class="flex gap-4 mb-4">
                        <img src="https://i.pinimg.com/736x/de/f4/4e/def44e0cf9c972eb4fe43f833fac8185.jpg" class="w-16 rounded-full">
                        <div>
                            <p class="font-semibold">{{ $curso->docente->apellidos." ". $curso->docente->nombres }}</p>
                            <p class="text-gray-400">Profesor</p>
                        </div>
                    </div>
                    {{-- VER NOTAS PARTICULARES --}}
                    <form method="GET" action="{{ route('alumno.irANotas', $fichaMatricula->codigoAlumno) }}" class=" border">
                        <input type="hidden" name="añoEscolar" value="{{ $curso->añoEscolar }}">
                        <input type="hidden" name="codigoDocente" value="{{ $curso->codigo_docente }}">
                        <input type="hidden" name="idAsignatura" value="{{ $curso->idAsignatura }}">
                        <div class="form-group">
                            <select name="bimestre" id="bimestre" class="form-control" >
                                <option value="1">Primer Bimestre</option>
                                <option value="2">Segundo Bimestre</option>
                                <option value="3">Tercer Bimestre</option>
                            </select>
                        </div>
                        <button type="submit" class="py-1 px-2 rounded-sm bg-black-primary-200 text-white w-full">
                            Ver Nota
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </section>

    </section>

    <script>
        // Desaparece el mensaje de error después de 5 segundos
        setTimeout(function() {
            var errorMessage = document.getElementById('error-message');
            if (errorMessage) {
                errorMessage.style.display = 'none';
            }
        }, 5000); // 5000 milisegundos = 5 segundos
    </script>
@endsection