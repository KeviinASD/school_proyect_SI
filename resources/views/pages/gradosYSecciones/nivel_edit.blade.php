@extends('layouts.layout')
@section('title', 'Editar Nivel')
@section('content')

<section class="space-y-4">
        <h1 class="text-2xl font-semibold">Creacion nuevo nivel</h1>
        <div class="min-w-[300px] p-5 mx-auto border">
            <form action="{{ route('niveles.update', $nivel->idNivel) }}" method="POST" class="space-x-3">
                    @csrf
                    @method('PUT')
                    <input class="focus:outline-none border p-1 rounded-sm" type="text" name="nombreNivel" placeholder="Nombre del Nivel" required value="{{ $nivel->nombreNivel }}">
                    <button class="px-4 py-1 rounded bg-[#DEF4DB] font-semibold hover:bg-green-300 transition duration-300 hover:translate-x-1" type="submit">ACTUALIZAR</button>
                    <button class="px-4 py-1 rounded bg-red-500 font-semibold hover:bg-red-700 transition duration-300 hover:translate-x-1" ><a href="{{ route('niveles.index') }}">Cancelar</a></button>
            </form>
        </div>
</section>

@endsection