@extends('layouts.layout')
@section('title', 'Notas Por Docente')

@section('content')
<section class="space-y-8">
    <h1 class="font-bold">LISTA DE DOCENTES</h1>   
    <table class="w-full">
        <thead>
            <tr>
                <th>Codigo</th>
                <th>DNI</th>
                <th>Apellidos</th>
                <th>Nombres</th>
                <th>Direccion</th>
                <th>Tipo Docente</th>
                <th>Estado Civil</th>
                <th>Notas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($docentes as $docente)
                <tr class="">
                    <td class="p-4 border-l">{{ $docente->codigo_docente }}</td>
                    <td class="p-4 border-l">{{ $docente->DNI }}</td>
                    <td class="p-4 border-l">{{ $docente->apellidos }}</td>
                    <td class="p-4 border-l">{{ $docente->nombres }}</td>
                    <td class="p-4 border-l">{{ $docente->direccion }}</td>
                    <td class="p-4 border-l">{{ $docente->tipoDocente->nombreTipo }}</td>
                    <td class="p-4 border-l">{{ $docente->estadoCivil->nombreEstadoCivil }}</td>
                    <td class="p-4 border-l">
                        <a href="{{ route('notas.registro', $docente->codigo_docente) }}" class="bg-black-primary-100 hover:bg-blue-700  text-white font-bold py-2 px-4 rounded duration-300 animate-none">Editar Notas</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        {{ $docentes->links() }}
    </div>
</section>
@endsection