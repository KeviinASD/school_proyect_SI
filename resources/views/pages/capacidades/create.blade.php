@extends('layouts.layout')

@section('title', 'Crear Capacidad')

@section('content')
<div class="bg-white border border-gray-200 shadow-lg p-6 rounded-lg">
    <h2 class="text-2xl font-semibold mb-4">Crear Nueva Capacidad</h2>
    <form method="POST" action="{{ route('capacidades.store') }}">
        @csrf
        <div class="space-y-4">
            <!-- Curso -->
            <div>
                <label for="idCurso" class="block text-sm font-medium text-gray-700">Curso</label>
                <select id="idCurso" name="idCurso" class="mt-1 block w-full h-10 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                    <option value="">Selecciona un Curso</option>
                    @foreach($cursos as $curso)
                        <option value="{{ $curso->idCurso }}">{{ $curso->nombreCurso }}</option>
                    @endforeach
                </select>
                @error('idCurso')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Asignatura -->
            <div>
                <label for="idAsignatura" class="block text-sm font-medium text-gray-700">Asignatura</label>
                <select id="idAsignatura" name="idAsignatura" class="mt-1 block w-full h-10 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                    <option value="">Selecciona una Asignatura</option>
                </select>
                @error('idAsignatura')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Descripción -->
            <div>
                <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                <input type="text" id="descripcion" name="descripcion" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                @error('descripcion')
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
    // Actualiza el listado de asignaturas basado en el curso seleccionado
    document.getElementById('idCurso').addEventListener('change', function() {
        const cursoId = this.value;
        fetch(`/api/asignaturas/${cursoId}`)
            .then(response => response.json())
            .then(data => {
                const asignaturaSelect = document.getElementById('idAsignatura');
                asignaturaSelect.innerHTML = '<option value="">Selecciona una Asignatura</option>';
                data.asignaturas.forEach(asignatura => {
                    asignaturaSelect.innerHTML += `<option value="${asignatura.idAsignatura}">${asignatura.nombreAsignatura}</option>`;
                });
            });
    });
</script>
@endsection
