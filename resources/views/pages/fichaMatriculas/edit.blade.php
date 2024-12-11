@extends('layouts.layout')

@section('title', 'Editar Ficha de Matrícula')

@section('content')
    <div class="container mx-auto py-8">
        <h2 class="text-2xl font-semibold mb-4">Editar Ficha de Matrícula</h2>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Error!</strong>
                <ul class="list-disc pl-5 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('fichaMatriculas.update', $fichaMatricula->nroMatricula) }}" method="POST" class="max-w-lg mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="codigoAlumno">
                    Código del Alumno
                </label>
                <select name="codigoAlumno" id="codigoAlumno" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    <option value="">Seleccione un alumno</option>
                    @foreach ($codigoAlumnos as $alumno)
                        <option value="{{ $alumno->codigoAlumno }}" {{ $fichaMatricula->codigoAlumno == $alumno->codigoAlumno ? 'selected' : '' }}>
                            {{ $alumno->codigoAlumno }} - {{ $alumno->nombres }} {{ $alumno->apellidos }}
                        </option>
                    @endforeach
                </select>
                @error('codigoAlumno')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="fechaMatricula">
                    Fecha de Matrícula
                </label>
                <input type="date" name="fechaMatricula" id="fechaMatricula" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('fechaMatricula', $fichaMatricula->fechaMatricula) }}" required>
                @error('fechaMatricula')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="idSeccion">
                    Sección
                </label>
                <select name="idSeccion" id="idSeccion" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    <option value="">Seleccione una sección</option>
                    @foreach ($secciones as $seccion)
                        <option value="{{ $seccion->idSeccion }}" {{ $fichaMatricula->idSeccion == $seccion->idSeccion ? 'selected' : '' }}>
                            {{ $seccion->nombreSeccion }}
                        </option>
                    @endforeach
                </select>
                @error('idSeccion')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="idGrado">
                    Grado
                </label>
                <select name="idGrado" id="idGrado" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    <option value="">Seleccione un grado</option>
                    @foreach ($grados as $grado)
                        <option value="{{ $grado->idGrado }}" {{ $fichaMatricula->idGrado == $grado->idGrado ? 'selected' : '' }}>
                            {{ $grado->nombreGrado }}
                        </option>
                    @endforeach
                </select>
                @error('idGrado')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="idNivel">
                    Nivel
                </label>
                <select name="idNivel" id="idNivel" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    <option value="">Seleccione un nivel</option>
                    @foreach ($niveles as $nivel)
                        <option value="{{ $nivel->idNivel }}" {{ $fichaMatricula->idNivel == $nivel->idNivel ? 'selected' : '' }}>
                            {{ $nivel->nombreNivel }}
                        </option>
                    @endforeach
                </select>
                @error('idNivel')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="añoEscolar">
                    Año Escolar
                </label>

                <label>{{$añoEscolarActual->año_escolar_id}}</label>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Actualizar</button>
                <a href="{{ route('fichaMatriculas.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
