@extends('layouts.layout')

@section('title', 'Editar Asignatura')

@section('content')
<div class="bg-white border border-gray-100 shadow-md p-6 rounded-md">
    <h2 class="text-xl font-medium mb-4">Editar Asignatura</h2>

    @if (session('success'))
        <div id="success-message" class="p-4 mb-4 text-green-700 bg-green-100 border border-green-200 rounded-md">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('asignaturas.update', $asignatura->idAsignatura) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Campo de Nombre de la Asignatura -->
        <div class="mb-4">
            <label for="nombreAsignatura" class="block text-gray-700">Nombre Asignatura</label>
            <input type="text" id="nombreAsignatura" name="nombreAsignatura" value="{{ old('nombreAsignatura', $asignatura->nombreAsignatura) }}" class="p-2 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
            @error('nombreAsignatura')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Campo de Nivel -->
        <div class="mb-4">
            <label for="idNivel" class="block text-gray-700">Nivel</label>
            <select id="idNivel" name="idNivel" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                <option value="" disabled>Seleccionar</option>
                @foreach($niveles as $nivel)
                    <option value="{{ $nivel->idNivel }}" {{ old('idNivel', $asignatura->idNivel) == $nivel->idNivel ? 'selected' : '' }}>
                        {{ $nivel->nombreNivel }}
                    </option>
                @endforeach
            </select>
            @error('idNivel')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Campo de Grado -->
        <div class="mb-4">
            <label for="idGrado" class="block text-gray-700">Grado</label>
            <select id="idGrado" name="idGrado" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                <option value="" disabled>Seleccionar grado</option>
                <!-- Los grados se cargarán aquí dinámicamente -->
            </select>
            @error('idGrado')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-6">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 disabled:opacity-60 transition">
                Actualizar Asignatura
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var nivelSelect = document.getElementById('idNivel');
        var gradoSelect = document.getElementById('idGrado');

        function fetchGrados(nivelId) {
            if (nivelId) {
                fetch(`/api/grados/${nivelId}`)
                    .then(response => response.json())
                    .then(data => {
                        gradoSelect.innerHTML = '<option value="" disabled>Seleccionar grado</option>';
                        data.grados.forEach(grado => {
                            gradoSelect.innerHTML += `<option value="${grado.idGrado}" ${grado.idGrado == "{{ old('idGrado', $asignatura->idGrado) }}" ? 'selected' : ''}>${grado.nombreGrado}</option>`;
                        });
                    })
                    .catch(error => console.error('Error:', error));
            } else {
                gradoSelect.innerHTML = '<option value="" disabled>Seleccionar grado</option>';
            }
        }

        nivelSelect.addEventListener('change', function () {
            fetchGrados(this.value);
        });

        // Cargar grados si hay un nivel seleccionado al cargar la página
        var nivelId = "{{ old('idNivel', $asignatura->idNivel) }}";
        if (nivelId) {
            fetchGrados(nivelId);
        }

        // Establecer el grado seleccionado
        gradoSelect.value = "{{ old('idGrado', $asignatura->idGrado) }}";

        // Mensaje de éxito
        var successMessage = document.getElementById('success-message');
        if (successMessage) {
            setTimeout(function () {
                successMessage.style.display = 'none';
            }, 1000); // Oculta el mensaje después de 1 segundo
        }
    });
</script>
@endsection