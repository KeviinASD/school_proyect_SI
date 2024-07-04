@extends('layouts.layout')
@section('title', 'Crear Grado')
@section('content')
    <section class="space-y-4">
        <h1 class="text-2xl font-semibold">Creacion nuevo grado</h1>
        <div class="min-w-[300px] p-5 mx-auto border">
        <form action="{{ route('grados.store') }}" method="POST" class="space-y-4">
                @csrf
                <div class="space-y-2">
                    <label for="nombreGrado" class="block text-gray-700">Nombre del Grado</label>
                    <input class="focus:outline-none border border-gray-300 p-2 rounded-sm w-full" type="text" name="nombreGrado" id="nombreGrado" placeholder="Nombre del Grado" required>
                    @error('nombreGrado')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="space-y-2">
                    <label for="idNivel" class="block text-gray-700">Nivel</label>
                    <select name="idNivel" id="idNivel" class="focus:outline-none border border-gray-300 p-2 rounded-sm w-full" required>
                        @foreach ($niveles as $nivel)
                            <option value="{{ $nivel->idNivel }}">{{ $nivel->nombreNivel }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex justify-between">
                    <button class="px-4 py-2 rounded bg-[#DEF4DB] font-semibold hover:bg-green-300 transition duration-300" type="submit">Crear Grado</button>
                    <a href="{{ route('grados.index') }}" class="px-4 py-2 rounded bg-red-300 font-semibold hover:bg-red-500 transition duration-300">Cancelar</a>
                </div>
            </form>
        </div>
    </section>
@endsection