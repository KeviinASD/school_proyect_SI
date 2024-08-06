@extends('layouts.layout')

@section('title', 'Docentes')

@section('content')
<div class="container mx-auto">
    <h3 class="text-lg font-bold my-4">LISTADO DE DOCENTES</h3>
    <div class="my-4">
        <a href="{{ route('docentes.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            <i class="fas fa-plus"></i> Nuevo Docente
        </a>
        <nav class="float-right">
            <form class="form-inline my-2 my-lg-0" method="GET" action="{{ route('docentes.index') }}">
                <input name="buscarpor" class="form-input mr-2 p-2" type="search" placeholder="Búsqueda por nombre" aria-label="Search" value="{{ request()->input('buscarpor') }}">
                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" type="submit">Buscar</button>
            </form>
        </nav>
    </div>
    @if ($docentes->isEmpty())
        <p class="mt-4">No hay docentes registrados.</p>
    @else
        <table class="table-auto w-full bg-white border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-800 text-white">
                    <th class="px-4 py-2">Código</th>
                    <th class="px-4 py-2">DNI</th>
                    <th class="px-4 py-2">Apellidos</th>
                    <th class="px-4 py-2">Nombres</th>
                    <th class="px-4 py-2">Dirección</th>
                    <th class="px-4 py-2">Fecha de Ingreso</th>
                    <th class="px-4 py-2">Tipo de Docente</th>
                    <th class="px-4 py-2">Estado Civil</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($docentes as $docente)
                    <tr class="bg-gray-200">
                        <td class="border px-4 py-2">{{ $docente->codigo_docente }}</td>
                        <td class="border px-4 py-2">{{ $docente->DNI }}</td>
                        <td class="border px-4 py-2">{{ $docente->apellidos }}</td>
                        <td class="border px-4 py-2">{{ $docente->nombres }}</td>
                        <td class="border px-4 py-2">{{ $docente->direccion }}</td>
                        <td class="border px-4 py-2">{{ $docente->fechaIngreso }}</td>
                        <td class="border px-4 py-2">{{ $docente->tipoDocente->nombreTipo }}</td>
                        <td class="border px-4 py-2">{{ $docente->estadoCivil->nombreEstadoCivil }}</td>
                        <td class="border px-4 py-2">
                            <p class="mb-2 text-center">
                                <a href="{{ route('docentes.edit', $docente->codigo_docente) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                            </p>
                            <p class="text-center">
                                <form action="{{ route('docentes.destroy', $docente->codigo_docente) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" onclick="return confirm('¿Estás seguro de querer eliminar este docente?')">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            </p>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
