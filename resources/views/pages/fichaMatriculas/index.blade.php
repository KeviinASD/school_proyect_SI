@extends('layouts.layout')

@section('title', 'Fichas de Matrícula')

@section('content')
<div class="container mx-auto">
    <h3 class="text-lg font-bold my-4">LISTADO DE FICHAS DE MATRÍCULA</h3>
    <div class="my-4">
        <a href="{{ route('fichaMatriculas.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            <i class="fas fa-plus"></i> Nueva Ficha de Matrícula
        </a>
        <nav class="float-right">
            <form class="form-inline my-2 my-lg-0" method="GET" action="{{ route('fichaMatriculas.index') }}">
                <input name="buscarpor" class="form-input mr-2 p-2" type="search" placeholder="Búsqueda por código de alumno" aria-label="Search" value="{{ request()->input('buscarpor') }}">
                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" type="submit">Buscar</button>
            </form>
        </nav>
    </div>
    @if ($fichasMatriculas->isEmpty())
        <p class="mt-4">No hay fichas de matrícula registradas.</p>
    @else
        <table class="table-auto w-full bg-white border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-800 text-white">
                    <th class="px-4 py-2">Nro Matricula</th>
                    <th class="px-4 py-2">Código Alumno</th>
                    <th class="px-4 py-2">Fecha Matrícula</th>
                    <th class="px-4 py-2">Sección</th>
                    <th class="px-4 py-2">Grado</th>
                    <th class="px-4 py-2">Nivel</th>
                    <th class="px-4 py-2">Año Escolar</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fichasMatriculas as $fichaMatricula)
                    <tr class="bg-gray-200">
                        <td class="border px-4 py-2">{{ $fichaMatricula->nroMatricula }}</td>
                        <td class="border px-4 py-2">{{ $fichaMatricula->codigoAlumno }}</td>
                        <td class="border px-4 py-2">{{ $fichaMatricula->fechaMatricula }}</td>
                        <td class="border px-4 py-2">{{ $fichaMatricula->seccion->nombreSeccion }}</td>
                        <td class="border px-4 py-2">{{ $fichaMatricula->grado->nombreGrado }}</td>
                        <td class="border px-4 py-2">{{ $fichaMatricula->nivel->nombreNivel }}</td>
                        <td class="border px-4 py-2">{{ $fichaMatricula->añoEscolar }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('fichaMatriculas.edit', $fichaMatricula->nroMatricula) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <form action="{{ route('fichaMatriculas.destroy', $fichaMatricula->nroMatricula) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded ml-2" onclick="return confirm('¿Estás seguro de querer eliminar esta ficha de matrícula?')">
                                    <i class="fas fa-trash"></i> Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
