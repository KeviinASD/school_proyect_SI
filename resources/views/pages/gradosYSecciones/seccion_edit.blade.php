@extends('layouts.layout')

@section('title', 'Editar Sección')

@section('content')
    <section class="space-y-4">
        <h1 class="text-2xl font-semibold">Editar Sección</h1>
        <div class="min-w-[300px] p-5 mx-auto border">
            @if (session('success'))
                <div id="success-message" class="bg-green-500 text-white p-2 rounded-md mb-4 opacity-100 transition-opacity duration-500 ease-out">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('secciones.update', $seccion->idSeccion) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <!-- Campo para el nombre de la sección -->
                <div class="space-y-2">
                    <label for="nombreSeccion" class="block text-gray-700 font-medium">Nombre de la Sección</label>
                    <input 
                        type="text" 
                        name="nombreSeccion" 
                        id="nombreSeccion" 
                        placeholder="Nombre de la Sección" 
                        class="focus:outline-none border border-gray-300 p-2 rounded-md w-full"
                        value="{{ old('nombreSeccion', $seccion->nombreSeccion) }}"
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
                            <option value="{{ $nivel->idNivel }}" {{ $nivel->idNivel == $seccion->idNivel ? 'selected' : '' }}>
                                {{ $nivel->nombreNivel }}
                            </option>
                        @endforeach
                    </select>
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
                        @foreach ($grados as $grado)
                            <option value="{{ $grado->idGrado }}" {{ $grado->idGrado == $seccion->idGrado ? 'selected' : '' }}>
                                {{ $grado->nombreGrado }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Botones de acción -->
                <div class="flex gap-3 mt-4">
                    <button 
                        type="submit" 
                        class="px-4 py-2 rounded bg-[#DEF4DB] font-semibold hover:bg-green-300 transition duration-300"
                    >
                        Actualizar Sección
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
            document.addEventListener('DOMContentLoaded', function () {
                const idNivel = document.getElementById('idNivel');
                const idGrado = document.getElementById('idGrado');

                idNivel.addEventListener('change', function () {
                    const nivelId = idNivel.value;

                    fetch(`/api/grados/${nivelId}`)
                        .then(response => response.json())
                        .then(data => {
                            idGrado.innerHTML = '<option value="">Selecciona un Grado</option>';
                            data.grados.forEach(grado => {
                                idGrado.innerHTML += `<option value="${grado.idGrado}">${grado.nombreGrado}</option>`;
                            });
                        })
                        .catch(error => console.error('Error fetching grados:', error));
                });

                // Cargar los grados iniciales si hay un nivel seleccionado
                if (idNivel.value) {
                    idNivel.dispatchEvent(new Event('change'));
                }

                // Timeout para desvanecer el mensaje de éxito
                const successMessage = document.getElementById('success-message');
                if (successMessage) {
                    setTimeout(() => {
                        successMessage.classList.add('opacity-0');
                        setTimeout(() => {
                            successMessage.remove();
                        }, 500);  // Tiempo igual al de la transición de desvanecimiento
                    }, 3000);  // Tiempo en milisegundos antes de comenzar el desvanecimiento (3 segundos)
                }
            });
        </script>
@endsection