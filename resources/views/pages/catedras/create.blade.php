@extends('layouts.layout')

@section('title', 'Crear Cátedra')

@section('content')
<div class="bg-white border border-gray-100 shadow-md p-6 rounded-md">
    <h2 class="text-xl font-medium mb-4">Crear Nueva Cátedra</h2>
    <form action="{{ route('catedras.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="codigo_docente" class="block text-sm font-medium text-gray-700">Código del Docente</label>
            <select id="codigo_docente" name="codigo_docente" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="">Seleccione un código de docente</option>
                @foreach($docentes as $docente)
                <option value="{{ $docente->codigo_docente }}" {{ old('codigo_docente') == $docente->codigo_docente ? 'selected' : '' }}>
                    {{ $docente->codigo_docente }} - {{ $docente->nombres }} {{ $docente->apellidos }}
                </option>
                @endforeach
            </select>
            @error('codigo_docente')
            <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="idNivel" class="block text-sm font-medium text-gray-700">Nivel</label>
            <select id="idNivel" name="idNivel" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="">Seleccione un nivel</option>
                @foreach($niveles as $nivel)
                <option value="{{ $nivel->idNivel }}" {{ old('idNivel') == $nivel->idNivel ? 'selected' : '' }}>
                    {{ $nivel->nombreNivel }}
                </option>
                @endforeach
            </select>
            @error('idNivel')
            <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="idGrado" class="block text-sm font-medium text-gray-700">Grado</label>
            <select id="idGrado" name="idGrado" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="">Seleccione un grado</option>
            </select>
            @error('idGrado')
            <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="idSeccion" class="block text-sm font-medium text-gray-700">Sección</label>
            <select id="idSeccion" name="idSeccion" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="">Seleccione una sección</option>
            </select>
            @error('idSeccion')
            <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="idAsignatura" class="block text-sm font-medium text-gray-700">Asignatura</label>
            <select id="idAsignatura" name="idAsignatura" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="">Seleccione una asignatura</option>
            </select>
            @error('idAsignatura')
            <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="añoEscolar" class="block text-sm font-medium text-gray-700">Año Escolar</label>
            <label>{{$añoEscolarActual->año_escolar_id}}</label>
            @error('añoEscolar')
            <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            Guardar
        </button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const nivelSelect = document.getElementById('idNivel');
    const gradoSelect = document.getElementById('idGrado');
    const seccionSelect = document.getElementById('idSeccion');
    const asignaturaSelect = document.getElementById('idAsignatura');

    nivelSelect.addEventListener('change', function() {
        const nivelId = this.value;
        if (nivelId) {
            fetch(`/grados-by-nivel/${nivelId}`)
                .then(response => response.json())
                .then(data => {
                    gradoSelect.innerHTML = '<option value="">Seleccione un grado</option>';
                    data.forEach(grado => {
                        gradoSelect.innerHTML += `<option value="${grado.idGrado}">${grado.nombreGrado}</option>`;
                    });
                });
        }
    });

    gradoSelect.addEventListener('change', function() {
        const gradoId = this.value;
        if (gradoId) {
            fetch(`/secciones-by-grado/${gradoId}`)
                .then(response => response.json())
                .then(data => {
                    seccionSelect.innerHTML = '<option value="">Seleccione una sección</option>';
                    data.forEach(seccion => {
                        seccionSelect.innerHTML += `<option value="${seccion.idSeccion}">${seccion.nombreSeccion}</option>`;
                    });
                });
        }
    });

    gradoSelect.addEventListener('change', function() {
        const gradoId = this.value;
        const nivelId = nivelSelect.value; // Obtenemos el nivel seleccionado
        if (gradoId) {
            fetch(`/secciones-by-grado/${gradoId}`)
                .then(response => response.json())
                .then(data => {
                    seccionSelect.innerHTML = '<option value="">Seleccione una sección</option>';
                    data.forEach(seccion => {
                        seccionSelect.innerHTML += `<option value="${seccion.idSeccion}">${seccion.nombreSeccion}</option>`;
                    });
                });

            // Nueva lógica para obtener asignaturas según el grado y nivel
            if (nivelId) {
                fetch(`/asignaturas-by-nivel-grado/${nivelId}/${gradoId}`)
                    .then(response => response.json())
                    .then(data => {
                        asignaturaSelect.innerHTML = '<option value="">Seleccione una asignatura</option>';
                        data.forEach(asignatura => {
                            asignaturaSelect.innerHTML += `<option value="${asignatura.idAsignatura}">${asignatura.nombreAsignatura}</option>`;
                        });
                    });
            }
        }
    });
});
</script>
@endsection