@extends('layouts.layout')

@section('title', 'Editar Cátedra')

@section('content')
<div class="bg-white border border-gray-100 shadow-md p-6 rounded-md">
    <h2 class="text-xl font-medium mb-4">Editar Cátedra</h2>
    <form action="{{ route('catedras.update', $catedra->idCatedra) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="codigo_docente" class="block text-sm font-medium text-gray-700">Código del Docente</label>
            <select id="codigo_docente" name="codigo_docente" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @foreach($docentes as $docente)
                <option value="{{ $docente->codigo_docente }}" {{ $catedra->codigo_docente == $docente->codigo_docente ? 'selected' : '' }}>
                    {{ $docente->codigo_docente }} - {{ $docente->nombres }} {{ $docente->apellidos }}
                </option>
                @endforeach
            </select>
            @error('codigo_docente')
            <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="idSeccion" class="block text-sm font-medium text-gray-700">Sección</label>
            <select id="idSeccion" name="idSeccion" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @foreach($secciones as $seccion)
                <option value="{{ $seccion->idSeccion }}" {{ $catedra->idSeccion == $seccion->idSeccion ? 'selected' : '' }}>
                    {{ $seccion->nombreSeccion }}
                </option>
                @endforeach
            </select>
            @error('idSeccion')
            <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="idGrado" class="block text-sm font-medium text-gray-700">Grado</label>
            <select id="idGrado" name="idGrado" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @foreach($grados as $grado)
                <option value="{{ $grado->idGrado }}" {{ $catedra->idGrado == $grado->idGrado ? 'selected' : '' }}>
                    {{ $grado->nombreGrado }}
                </option>
                @endforeach
            </select>
            @error('idGrado')
            <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="idNivel" class="block text-sm font-medium text-gray-700">Nivel</label>
            <select id="idNivel" name="idNivel" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @foreach($niveles as $nivel)
                <option value="{{ $nivel->idNivel }}" {{ $catedra->idNivel == $nivel->idNivel ? 'selected' : '' }}>
                    {{ $nivel->nombreNivel }}
                </option>
                @endforeach
            </select>
            @error('idNivel')
            <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="idCurso" class="block text-sm font-medium text-gray-700">Curso</label>
            <select id="idCurso" name="idCurso" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @foreach($cursos as $curso)
                <option value="{{ $curso->idCurso }}" {{ $catedra->idCurso == $curso->idCurso ? 'selected' : '' }}>
                    {{ $curso->nombreCurso }}
                </option>
                @endforeach
            </select>
            @error('idCurso')
            <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="idAsignatura" class="block text-sm font-medium text-gray-700">Asignatura</label>
            <select id="idAsignatura" name="idAsignatura" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @foreach($asignaturas as $asignatura)
                <option value="{{ $asignatura->idAsignatura }}" {{ $catedra->idAsignatura == $asignatura->idAsignatura ? 'selected' : '' }}>
                    {{ $asignatura->nombreAsignatura }}
                </option>
                @endforeach
            </select>
            @error('idAsignatura')
            <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="añoEscolar" class="block text-sm font-medium text-gray-700">Año Escolar</label>
            <select id="añoEscolar" name="añoEscolar" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @foreach($añosEscolares as $añoEscolar)
                <option value="{{ $añoEscolar->añoEscolar }}" {{ $catedra->añoEscolar == $añoEscolar->añoEscolar ? 'selected' : '' }}>
                    {{ $añoEscolar->añoEscolar }}
                </option>
                @endforeach
            </select>
            @error('añoEscolar')
            <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-end">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Actualizar
            </button>
        </div>
    </form>
</div>
@endsection
