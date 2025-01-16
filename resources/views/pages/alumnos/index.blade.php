@extends('layouts.layout')
@section('title', 'Alumnos')
@section('content')
<div class="container mx-auto">
    <h3 class="text-lg font-bold my-4">LISTADO DE ALUMNOS</h3>
    <div class="my-4 flex justify-between items-center">
        <a href="{{ route('alumnos.create') }}" class="bg-blue-500 hover:bg-blue-700 h-10 text-white font-bold py-2 px-4 rounded">
            <i class="fas fa-plus"></i> Nuevo Registro
        </a>
        <nav class="float-right">
            <form class="form-inline my-2 my-lg-0 h-10" method="GET">
                <input name="buscarpor" class="form-input mr-2 border border-gray-700 p-2 w-80 rounded-md" type="search" placeholder="Búsqueda por nombre-apellido-código" aria-label="Search" value="">
                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" type="submit">Buscar</button>
            </form>
        </nav>
    </div>
    <table class="table-auto w-full">
        <thead>
            <tr class="bg-gray-800 text-white">
                <th class="px-4 py-2">Código</th>
                <th class="px-4 py-2">Nombre</th>
                <th class="px-4 py-2">DNI</th>
                <th class="px-4 py-2">Sexo</th>
                <th class="px-4 py-2">DNI Apoderado</th>
                <th class="px-4 py-2">Imagen</th> <!-- Nueva columna de imagen -->
                <th class="px-4 py-2">Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($alumnos as $alumno)
            <tr class="bg-gray-200">
                <td class="border px-4 py-2">{{ $alumno->codigoAlumno }}</td>
                <td class="border px-4 py-2">{{ $alumno->nombres }} {{ $alumno->apellidos }}</td>
                <td class="border px-4 py-2">{{ $alumno->DNI }}</td>
                <td class="border px-4 py-2">{{ $alumno->sexo?->nombreSexo ?? 'No Especifica'}}</td>
                <td class="border px-4 py-2">{{ $alumno->dniApoderado }}</td>
                <td class="border px-4 py-2">
                    <!-- Verificar si el alumno tiene imagen -->
                    @if($alumno->imagen_url)
                        <img src="{{ asset('storage/alumnos/' . $alumno->imagen_url) }}" alt="Imagen de {{ $alumno->nombres }}" class="w-16 h-16 rounded-full">
                    @else
                        <img src="https://i.pinimg.com/736x/61/f7/5e/61f75ea9a680def2ed1c6929fe75aeee.jpg" alt="" class="w-16 h-16 rounded-full">
                    @endif
                </td>
                <td class="border px-4 py-2">
                    <a href="{{ route('alumnos.edit', $alumno->codigoAlumno) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                    <form action="{{ route('alumnos.destroy', $alumno->codigoAlumno) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este registro?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded ml-2">
                            <i class="fas fa-trash"></i> Eliminar
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
