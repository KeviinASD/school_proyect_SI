@extends('layouts.layout')

@section('title', 'Alumnos Matriculados')

@section('content')
<section>
    <div>
        @if (session('success'))
        <div id="success-message" class="p-4 rounded bg-[#DEF4DB] font-semibold transition duration-300 hover:translate-x-1">
            {{ session('success') }}
        </div>
        @endif
        @if (session('error'))
        <div id="error-message" class="p-4 rounded bg-[#FDE2E2] font-semibold transition duration-300 hover:translate-x-1">
            {{ session('error') }}
        </div>
        @endif
        <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md space-y-4">
            <div class="flex justify-between mb-4 items-start">
                <div class="font-medium">LISTADO DE ALUMNOS MATRICULADOS</div>
                <form class="flex items-center space-x-2" method="GET" action="{{ route('alumnosMatriculados.index') }}">
                    <select name="añoEscolar" id="añoEscolar" class="border border-gray-300 py-1 px-2 rounded focus:outline-none focus:ring-red-500 h-[32.8px] w-[120px]">
                        <option value="">Año Escolar</option>
                        @foreach($añosEscolares as $año)
                            <option value="{{ $año->añoEscolar }}" {{ request()->input('añoEscolar') == $año->añoEscolar ? 'selected' : '' }}>{{ $año->añoEscolar }}</option>
                        @endforeach
                    </select>
                    <select name="idNivel" id="idNivel" class="border border-gray-300 py-1 px-2 rounded focus:outline-none focus:ring-red-500 h-[32.8px] w-[110px]">
                        <option value="">Nivel</option>
                        @foreach($niveles as $nivel)
                            <option value="{{ $nivel->idNivel }}" {{ request()->input('idNivel') == $nivel->idNivel ? 'selected' : '' }}>{{ $nivel->nombreNivel }}</option>
                        @endforeach
                    </select>
                    <select name="idGrado" id="idGrado" class="border border-gray-300 py-1 px-2 rounded focus:outline-none focus:ring-red-500 h-[32.8px] w-[150px]">
                        <option value="">Grado</option>
                    </select>
                    <select name="idSeccion" id="idSeccion" class="border border-gray-300 py-1 px-2 rounded focus:outline-none focus:ring-red-500 h-[32.8px] w-[110px]">
                        <option value="">Sección</option>
                    </select>
                    <button class="ml-2 px-4 py-1 rounded bg-blue-500 text-white">Filtrar</button>
                </form>
            </div>
            <div class="overflow-x-auto">
                @if ($fichasMatriculas->isEmpty())
                    <p class="p-4">No hay alumnos matriculados para los filtros seleccionados.</p>
                @else
                    <table class="w-full min-w-[600px]">
                        <thead>
                            <tr class="rounded-md">
                                <th class="text-[12px] uppercase tracking-wide font-medium text-gray-500 py-2 px-4 bg-gray-100 text-left rounded-tl-md rounded-bl-md">Nro Matrícula</th>
                                <th class="text-[12px] uppercase tracking-wide font-medium text-gray-500 py-2 px-4 bg-gray-100 text-left">Código Alumno</th>
                                <th class="text-[12px] uppercase tracking-wide font-medium text-gray-500 py-2 px-4 bg-gray-100 text-left">Fecha Matrícula</th>
                                <th class="text-[12px] uppercase tracking-wide font-medium text-gray-500 py-2 px-4 bg-gray-100 text-left">Sección</th>
                                <th class="text-[12px] uppercase tracking-wide font-medium text-gray-500 py-2 px-4 bg-gray-100 text-left">Grado</th>
                                <th class="text-[12px] uppercase tracking-wide font-medium text-gray-500 py-2 px-4 bg-gray-100 text-left">Nivel</th>
                                <th class="text-[12px] uppercase tracking-wide font-medium text-gray-500 py-2 px-4 bg-gray-100 text-left rounded-tr-md rounded-br-md">Año Escolar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($fichasMatriculas as $ficha)
                                <tr class="border-b border-b-gray-50">
                                    <td class="p-3 px-4">{{ $ficha->nroMatricula }}</td>
                                    <td class="py-3 px-4">{{ $ficha->codigoAlumno }}</td>
                                    <td class="py-3 px-4">{{ $ficha->fechaMatricula }}</td>
                                    <td class="py-3 px-4">{{ $ficha->seccion->nombreSeccion }}</td>
                                    <td class="py-3 px-4">{{ $ficha->grado->nombreGrado }}</td>
                                    <td class="py-3 px-4">{{ $ficha->nivel->nombreNivel }}</td>
                                    <td class="py-3 px-4">{{ $ficha->añoEscolar }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</section>

<script>
    function actualizarSecciones() {
        const gradoId = document.getElementById('idGrado').value;
        if (gradoId) {
            fetch(`/api/secciones/${gradoId}`)
                .then(response => response.json())
                .then(data => {
                    const seccionSelect = document.getElementById('idSeccion');
                    seccionSelect.innerHTML = '<option value="">Sección</option>';
                    data.secciones.forEach(seccion => {
                        seccionSelect.innerHTML += `<option value="${seccion.idSeccion}">${seccion.nombreSeccion}</option>`;
                    });
                });
        } else {
            const seccionSelect = document.getElementById('idSeccion');
            seccionSelect.innerHTML = '<option value="">Sección</option>';
        }
    }

    document.getElementById('idNivel').addEventListener('change', function() {
        const nivelId = this.value;
        fetch(`/api/grados/${nivelId}`)
            .then(response => response.json())
            .then(data => {
                const gradoSelect = document.getElementById('idGrado');
                gradoSelect.innerHTML = '<option value="">Grado</option>';
                data.grados.forEach(grado => {
                    gradoSelect.innerHTML += `<option value="${grado.idGrado}">${grado.nombreGrado}</option>`;
                });
                document.getElementById('idSeccion').innerHTML = '<option value="">Sección</option>';
            });
    });

    document.getElementById('idGrado').addEventListener('change', function() {
        actualizarSecciones();
    });

    document.getElementById('añoEscolar').addEventListener('change', function() {
        document.getElementById('idNivel').selectedIndex = 0;
        document.getElementById('idGrado').innerHTML = '<option value="">Grado</option>';
        document.getElementById('idSeccion').innerHTML = '<option value="">Sección</option>';
    });

    document.addEventListener('DOMContentLoaded', function() {
        actualizarSecciones();
    });
</script>
@endsection
