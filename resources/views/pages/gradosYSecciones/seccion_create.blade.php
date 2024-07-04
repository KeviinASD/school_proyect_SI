@extends('layouts.layout')

@section('title', 'Crear Sección')

@section('content')
    <section class="space-y-4">
        <h1 class="text-2xl font-semibold">Crear Nueva Sección</h1>
        <div class="min-w-[300px] p-5 mx-auto border">
            <form action="{{ route('secciones.store') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Campo para el nombre de la sección -->
                <div class="space-y-2">
                    <label for="nombreSeccion" class="block text-gray-700 font-medium">Nombre de la Sección</label>
                    <input 
                        type="text" 
                        name="nombreSeccion" 
                        id="nombreSeccion" 
                        placeholder="Nombre de la Sección" 
                        class="focus:outline-none border border-gray-300 p-2 rounded-md w-full"
                        value="{{ old('nombreSeccion') }}"
                        required
                    >
                    @error('nombreSeccion')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Campo para seleccionar el nivel -->
                <div class="space-y-2">
                    <label for="idNivel" class="block text-gray-700 font-medium">Nivel</label>
                    <select 
                        name="idNivel" 
                        id="idNivel" 
                        class="focus:outline-none border border-gray-300 p-2 rounded-md w-full" 
                        required
                    >
                        <option value="">Selecciona un Nivel</option>
                        @foreach ($niveles as $nivel)
                            <option value="{{ $nivel->idNivel }}">{{ $nivel->nombreNivel }}</option>
                        @endforeach
                    </select>
                    @error('idNivel')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Campo para seleccionar el grado -->
                <div class="space-y-2">
                    <label for="idGrado" class="block text-gray-700 font-medium">Grado</label>
                    <select 
                        name="idGrado" 
                        id="idGrado" 
                        class="focus:outline-none border border-gray-300 p-2 rounded-md w-full" 
                        required
                    >
                        <option value="">Selecciona un Grado</option>
                    </select>
                    @error('idGrado')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Botones de acción -->
                <div class="flex gap-3 mt-4">
                    <button 
                        type="submit" 
                        class="px-4 py-2 rounded bg-[#DEF4DB] font-semibold hover:bg-green-300 transition duration-300"
                    >
                        Crear Sección
                    </button>
                    <a 
                        href="{{ route('secciones.index') }}" 
                        class="px-4 py-2 rounded bg-red-300 font-semibold hover:bg-red-500 transition duration-300"
                    >
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </section>

    <script>
        // Actualiza el listado de grados basado en el nivel seleccionado
        document.getElementById('idNivel').addEventListener('change', function() {
            const nivelId = this.value;
            fetch(`/api/grados/${nivelId}`)
                .then(response => response.json())
                .then(data => {
                    const gradoSelect = document.getElementById('idGrado');
                    gradoSelect.innerHTML = '<option value="">Selecciona un Grado</option>';
                    data.grados.forEach(grado => {
                        gradoSelect.innerHTML += `<option value="${grado.idGrado}">${grado.nombreGrado}</option>`;
                    });
                });
        });
    </script>
@endsection