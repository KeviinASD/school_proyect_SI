@extends('layouts.layout')

@section('title', 'Cursos')

@section('content')
<div>
    <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
        <div class="flex justify-between mb-4 items-start">
            <div class="font-medium">DETALLES CURSOS</div>
            <a href="{{ route('cursos.create') }}" class="inline-block p-2 rounded bg-blue-500 text-white font-medium text-sm leading-none hover:bg-blue-600">Nuevo Curso</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full min-w-[460px]">
                <thead>
                    <tr>
                        <th class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tl-md rounded-bl-md">ID Curso</th>
                        <th class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left">Nombre</th>
                        <th class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left">Nivel</th>
                        <th class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tr-md rounded-br-md">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cursos as $curso)
                    <tr>
                        <td class="py-2 px-4 border-b border-b-gray-50">
                            <div class="flex items-center">
                                <a href="#" class="text-gray-600 text-sm font-medium hover:text-blue-500 ml-2 truncate">{{ $curso->idCurso }}</a>
                            </div>
                        </td>
                        <td class="py-2 px-4 border-b border-b-gray-50">
                            <span class="text-[13px] font-medium text-emerald-500">{{ $curso->nombreCurso }}</span>
                        </td>
                        <td class="py-2 px-4 border-b border-b-gray-50">
                            <span class="text-[13px] font-medium">{{ $curso->nivel->nombreNivel }}</span>
                        </td>
                        <td class="py-2 px-4 border-b border-b-gray-50">
                            <a href="{{ route('cursos.edit', $curso->idCurso) }}" class="inline-block p-2 rounded bg-blue-500 text-white font-medium text-[12px] leading-none hover:bg-blue-600">Editar</a>
                            <form action="{{ route('cursos.destroy', $curso->idCurso) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-block p-2 rounded bg-red-400 text-red-500 font-medium text-[12px] leading-none hover:bg-red-500 hover:text-white ml-2">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
