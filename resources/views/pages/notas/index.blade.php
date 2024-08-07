@extends('layouts.layout')
@section('title', 'Notas Por Docente')

@section('content')
<section class="space-y-8">
    <div class="flex justify-between mr-10">
        <h1 class="font-bold">DOCENTES CONTRATADOS</h1>   
        <div>
            <form action="{{ route('notas.index') }}" method="GET" class="flex items-center">
                <select name="añoEscolar" class="border border-gray-300 py-1 px-2 rounded focus:outline-none focus:ring-red-500">
                    <option value="">Todos los Años Escolares</option>
                    @foreach ($añosEscolares as $año)
                        <option value="{{ $año }}" {{ request('añoEscolar') == $año ? 'selected' : '' }}>
                            {{ $año }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="ml-2 px-4 py-1 rounded bg-blue-500 text-white">Filtrar</button>
            </form>
        </div>
    </div>
    <table class="w-full">
        <thead>
            <tr>
                <th>Codigo</th>
                <th>DNI</th>
                <th>Apellidos</th>
                <th>Nombres</th>
                <th>Direccion</th>
                <th>Tipo Docente</th>
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