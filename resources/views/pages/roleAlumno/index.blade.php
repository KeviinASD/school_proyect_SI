@extends('layouts.layout')

@section('title', 'MATRICULAS ALUMNOS')

@section('content')
    <section class="space-y-10">
        @php
            $codigoAlumno = Auth::user()->codigo;
        @endphp
        <div class="flex justify-between items-center">
            <h1 class="font-bold">CURSOS MATRICULADOS</h1>
        <!-- ComboBox para seleccionar el Año Escolar -->
            <form method="GET" action="{{ route('alumno.matriculas', ['codigoAlumno' => $codigoAlumno]) }}">
                <div class="form-group">
                    <label for="añoEscolar">SELECCIONAR AÑO ESCOLAR: </label>
                    <select name="añoEscolar" id="añoEscolar" class="form-control" onchange="this.form.submit()">
                        @foreach($añosEscolares as $año)
                            <option value="{{ $año }}" {{ $año == $selectedAnioEscolar ? 'selected' : '' }}>
                                {{ $año }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
        {{-- COMO SE COLOCAN LOS ERRORES --}}
        @if ($errors->has('error'))
            <div id="error-message" class="bg-red-500 text-white p-3 rounded mb-4">
                {{ $errors->first('error') }}
            </div>
        @endif
        <div class="grid grid-cols-3">
            <p class="">NIVEL: {{$fichaMatricula->nivel->nombreNivel}}</p>
            <p>GRADO: {{$fichaMatricula->grado->nombreGrado}}</p>
            <p>SECCION: {{$fichaMatricula->seccion->nombreSeccion}}</p>
        </div>
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