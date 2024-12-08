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
                {{-- DATOS DEL PROFESOR --}}
                <div class="flex gap-4">
                    <img src="https://i.pinimg.com/736x/de/f4/4e/def44e0cf9c972eb4fe43f833fac8185.jpg" class="w-16 rounded-full">
                    <div>
                        <p class="font-semibold">{{ $curso->docente->apellidos." ". $curso->docente->nombres }}</p>
                        <p class="text-gray-400">Profesor</p>
                    </div>
                </div>
                {{-- ACCIONES --}}
                <div>
                    
                </div>
            </div>
            @endforeach
        </section>


        <div>
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="text-start">AÑO ESCOLAR</th>
                        <th class="text-start">ID CURSO</th>
                        <th class="text-start">NOMBRE DEL CURSO</th>
                        <th class="text-start">DOCENTE</th>
                        <th class="text-start">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cursosDeEseAñoC as $curso)
                        <tr>
                            <td>{{ $curso->añoEscolar }}</td>
                            <td>{{ $curso->idAsignatura }}</td>                            
                            <td>{{ $curso->asignatura->nombreAsignatura }}</td>
                            <td>{{ $curso->docente->apellidos." ". $curso->docente->nombres }}</td>
                            <td>
                                <form method="GET" action="{{ route('alumno.irANotas') }}">
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
                                    <button type="submit" class="py-1 px-2 rounded-sm bg-black-primary-200 text-white">
                                        VER AVANCE DE NOTAS
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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