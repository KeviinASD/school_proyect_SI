@extends('layouts.layout')

@section('title', 'Crear Capacidad')

@section('content')
<div class="bg-white border border-gray-200 shadow-lg p-6 rounded-lg">
    <h2 class="text-2xl font-semibold mb-4">Crear Nueva Capacidad</h2>
    <form method="POST" action="{{ route('capacidades.store') }}">
        @csrf
        <div class="space-y-4">
            <!-- Asignatura -->
            <div>
                <label for="idAsignatura" class="block text-sm font-medium text-gray-700">Asignatura</label>
                <select id="idAsignatura" name="idAsignatura" class="mt-1 block w-full h-10 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                    <option value="">Selecciona una Asignatura</option>
                    @foreach($asignaturas as $asignatura)
                        <option value="{{ $asignatura->idAsignatura }}">{{$asignatura->nivel->nombreNivel}} - {{$asignatura->grado->nombreGrado}} -  {{ $asignatura->nombreAsignatura }}</option>
                    @endforeach
                </select>
                @error('idAsignatura')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Capacidades existentes -->
            <div class="py-4 px-3 rounded border">
                <label class="block text-sm font-medium text-gray-700">Capacidades existentes</label>
                <ul id="capacidadesList" class="mt-1 list-disc list-inside text-gray-700">
                    <li class="text-gray-500">Selecciona una asignatura para ver sus capacidades.</li>
                </ul>
            </div>

            <!-- Descripción -->
            <div>
                <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                <input type="text" id="descripcion" name="descripcion" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                @error('descripcion')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Abreviatura -->
            <div>
                <label for="abreviatura" class="block text-sm font-medium text-gray-700">Abreviatura</label>
                <input type="text" id="abreviatura" name="abreviatura" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                @error('abreviatura')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Orden -->
            <div>
                <label for="orden" class="block text-sm font-medium text-gray-700">Orden</label>
                <input type="number" id="orden" name="orden" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                @error('orden')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">Crear Capacidad</button>
            </div>
        </div>
    </form>
</div>

<script>
    document.getElementById('idAsignatura').addEventListener('change', function() {
        const idAsignatura = this.value;
        const capacidadesList = document.getElementById('capacidadesList');

        // Limpiar la lista de capacidades
        capacidadesList.innerHTML = '';

        if (idAsignatura) {
            fetch(`/capacidades/asignatura/${idAsignatura}`)
                .then(response => response.json())
                .then(capacidades => {
                    if (capacidades.length > 0) {
                        capacidades.forEach(capacidad => {
                            const li = document.createElement('li');
                            li.textContent = `${capacidad.descripcion} (Abreviatura: ${capacidad.abreviatura}, Orden: ${capacidad.orden})`;
                            capacidadesList.appendChild(li);
                        });
                    } else {
                        capacidadesList.innerHTML = '<li class="text-gray-500">No hay capacidades registradas para esta asignatura.</li>';
                    }
                })
                .catch(error => {
                    capacidadesList.innerHTML = '<li class="text-red-500">Error al cargar las capacidades.</li>';
                });
        } else {
            capacidadesList.innerHTML = '<li class="text-gray-500">Selecciona una asignatura para ver sus capacidades.</li>';
        }
    });
</script>

@endsection