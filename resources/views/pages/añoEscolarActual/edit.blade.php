@extends('layouts.layout')
@section('title', 'Año Escolar Actual')
@section('content')
<div class="container mx-auto py-8 px-4">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Actualizar Año Escolar Actual</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('año_escolar_actual.update') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="año_escolar_id" class="block text-gray-700 text-sm font-bold mb-2">Año Escolar</label>
            <select name="año_escolar_id" id="año_escolar_id" class="block w-full bg-gray-50 border border-gray-300 text-gray-700 py-2 px-3 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                @foreach($añosEscolares as $añoEscolar)
                    <option value="{{ $añoEscolar->añoEscolar }}" {{ $añoEscolarActual && $añoEscolarActual->año_escolar_id == $añoEscolar->añoEscolar ? 'selected' : '' }}>
                        {{ $añoEscolar->añoEscolar }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Actualizar
            </button>
        </div>
    </form>
</div>
@endsection
