@extends('layouts.layout')

@section('title', 'Nueva Ficha de Matrícula')

@section('content')
    <div class="container mx-auto py-8">
        <h2 class="text-2xl font-semibold mb-4">Crear Nueva Ficha de Matrícula</h2>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">¡Error!</strong>
                <span class="block sm:inline">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </span>
            </div>
        @endif

        <form action="{{ route('fichaMatriculas.store') }}" method="POST" class="max-w-lg mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="codigoAlumno">
                    Código del Alumno
                </label>
                <select name="codigoAlumno" id="codigoAlumno" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    <option value="">Seleccione un alumno</option>
                    @foreach ($codigoAlumnos as $alumno)
                        <option value="{{ $alumno->codigoAlumno }}" {{ old('codigoAlumno') == $alumno->codigoAlumno ? 'selected' : '' }}>
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
                <input type="date" id="fechaMatricula" name="fechaMatricula" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('fechaMatricula') }}" required>
                @error('fechaMatricula')
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
                        <option value="{{ $nivel->idNivel }}">{{ $nivel->nombreNivel }}</option>
                    @endforeach
                </select>
                @error('idNivel')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="idGrado">
                    Grado
                </label>
                <select name="idGrado" id="idGrado" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    <option value="">Seleccione un grado</option>
                </select>
                @error('idGrado')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="idSeccion">
                    Sección
                </label>
                <select name="idSeccion" id="idSeccion" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    <option value="">Seleccione una Sección</option>
                </select>
                @error('idSeccion')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="añoEscolar">
                    Año Escolar
                </label>
                <label>{{$añoEscolarActual->año_escolar_id}}</label>
                
                @error('añoEscolarActual')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Guardar</button>
                <a href="{{ route('fichaMatriculas.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">Cancelar</a>
            </div>
        </form>
    </div>

    <script>
    function actualizarSecciones() {
        const gradoId = document.getElementById('idGrado').value;
        if (gradoId) {
            fetch(`/api/secciones/${gradoId}`)
                .then(response => response.json())
                .then(data => {
                    const seccionSelect = document.getElementById('idSeccion');
                    seccionSelect.innerHTML = '<option value="">Seleccione una Sección</option>';
                    data.secciones.forEach(seccion => {
                        seccionSelect.innerHTML += `<option value="${seccion.idSeccion}">${seccion.nombreSeccion}</option>`;
                    });
                });
        } else {
            // Si no hay grado seleccionado, vacía las secciones
            const seccionSelect = document.getElementById('idSeccion');
            seccionSelect.innerHTML = '<option value="">Seleccione una Sección</option>';
        }
    }

    // Actualiza el listado de grados basado en el nivel seleccionado
    document.getElementById('idNivel').addEventListener('change', function() {
        const nivelId = this.value;
        fetch(`/api/grados/${nivelId}`)
            .then(response => response.json())
            .then(data => {
                const gradoSelect = document.getElementById('idGrado');
                gradoSelect.innerHTML = '<option value="">Seleccione un Grado</option>';
                data.grados.forEach(grado => {
                    gradoSelect.innerHTML += `<option value="${grado.idGrado}">${grado.nombreGrado}</option>`;
                });
                // Limpia las secciones cuando se cambie el nivel
                document.getElementById('idSeccion').innerHTML = '<option value="">Seleccione una Sección</option>';
            });
    });

    // Actualiza el listado de secciones basado en el grado seleccionado
    document.getElementById('idGrado').addEventListener('change', function() {
        actualizarSecciones();
    });

    // Ejecuta la función al cargar la página si ya hay un grado seleccionado
    document.addEventListener('DOMContentLoaded', function() {
        actualizarSecciones();
    });
    </script>
@endsection
