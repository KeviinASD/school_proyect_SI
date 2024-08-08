@extends('layouts.layout')

@section('title', 'DetalleNotas')

@section('content')
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-3 gap-2">
            <div>
                <h2 class="text-xl font-semibold mt-4 mb-2">Nivel</h2>
                <input type="text" readonly name="nivel" class="w-18 py-1 px-2 border border-gray-300 rounded-md" value="{{ $ficha->nivel->nombreNivel }}">
            </div>
            <div>
                <h2 class="text-xl font-semibold mt-4 mb-2">Grado</h2>
                <input type="text" readonly name="grado" class="w-18 py-1 px-2 border border-gray-300 rounded-md" value="{{ $ficha->grado->nombreGrado}}">
            </div>
            <div>
                <h2 class="text-xl font-semibold mt-4 mb-2">Sección</h2>
                <input type="text" readonly name="seccion" class="w-18 py-1 px-2 border border-gray-300 rounded-md" value="{{ $ficha->seccion->nombreSeccion}}">
            </div>
            <div>
                <h2 class="text-xl font-semibold mt-4 mb-2">Año Escolar</h2>
                <input type="text" readonly name="añoEscolar" class="w-18 py-1 px-2 border border-gray-300 rounded-md" value="{{ $ficha->añoEscolar}}">
            </div>
            
            <div>
                <h2 class="text-xl font-semibold mt-4 mb-2">Asignatura</h2>
                <input type="text" readonly name="asignatura" class="w-18 py-1 px-2 border border-gray-300 rounded-md" value="{{ $ficha->asignatura->nombreAsignatura}}">
            </div>
            <div>
                <h2 class="text-xl font-semibold mt-4 mb-2">Docente</h2>
                <input type="text" readonly name="docente" class="w-18 py-1 px-2 border border-gray-300 rounded-md" value="{{ $ficha->docente->nombres}} {{ $ficha->docente->apellidos}}">
            </div>
        </div>

        <h2 class="text-xl font-bold mt-6 mb-2">Capacidades de {{ $ficha->asignatura->nombreAsignatura}}</h2>
        
        <div class="overflow-x-auto mt-4">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b-2 border-gray-200 text-left text-sm font-semibold text-gray-600">Capacidad</th>
                        <th class="py-2 px-4 border-b-2 border-gray-200 text-left text-sm font-semibold text-gray-600">Abreviatura</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ficha->asignatura->capacidades as $capacidad)
                        <tr class="hover:bg-gray-100">
                            <td class="py-2 px-4 border-b border-gray-200">{{ $capacidad->descripcion }}</td>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $capacidad->abreviatura }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="grid grid-cols-2 gap-2">
            <h2 class="text-xl font-bold mt-6 mb-2">Alumnos Matriculados</h2>
            <div class="mt-4">
                <form action="{{ route('detalle-notas.index') }}" method="GET" class="flex items-center">
                    <select id="bimestre" name="bimestre" class="w-full py-2 px-3 border border-gray-300 rounded-md">
                        <option value="1">I Bimestre</option>
                        <option value="2" >II Bimestre</option>
                        <option value="3" >III Bimestre</option>
                    </select>
                    <button type="submit" class="ml-2 px-4 py-1 rounded bg-blue-500 text-white">Filtrar</button>
                </form>

            </div>
        </div>
        
        <form action="{{ route('nota-capacidad.store') }}" method="POST">
            @csrf
            <input type="hidden" name="fichaId" value="{{ $ficha->idFicha }}">
            <input type="hidden" name="asignatura_id" value="{{ $ficha->idAsignatura }}">
            <input type="hidden" name="curso_id" value="{{ $ficha->idCurso }}">
            <input type="hidden" name="codigo_Docente" value="{{ $ficha->codigo_Docente }}">
            <div class="overflow-x-auto mt-4">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b-2 border-gray-200 text-left text-sm font-semibold text-gray-600">Alumnos</th>
                            @foreach($ficha->asignatura->capacidades as $capacidad)
                                <th class="py-2 px-4 border-b-2 border-gray-200 text-left text-sm font-semibold text-gray-600">{{$capacidad->abreviatura}}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alumnos as $alumno)
                            <tr class="hover:bg-gray-100">
                                <td class="py-2 px-4 border-b border-gray-200">{{ $alumno->nombres }} {{ $alumno->apellidos }}</td>
                                @foreach($ficha->asignatura->capacidades as $capacidad)
                                    <td class="py-2 px-4 border-b border-gray-200">
                                        <input type="number" 
                                               name="notas[{{ $alumno->codigoAlumno }}][{{ $capacidad->idCapacidad }}]" 
                                               class="w-18 py-1 px-2 border border-gray-300 rounded-md" 
                                               placeholder="Nota" min="0" max="20"
                                               value="{{ $alumno->notasCapacidades->where('idCapacidad', $capacidad->idCapacidad)->where('idFicha', $ficha->idFicha)->first()->nota ?? '' }}">
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="submit" class="py-2 px-4 bg-green-500 text-white rounded-md mt-4">Guardar cambios</button>
            </div>
        </form>
    </div>

@endsection
