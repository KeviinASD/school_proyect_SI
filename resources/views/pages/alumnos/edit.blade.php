@extends('layouts.layout')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6 text-center">Editar Alumno</h1>

    <form method="POST" action="{{ route('alumnos.update', $alumno->codigoAlumno) }}" enctype="multipart/form-data" class="flex flex-col items-center">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="imagen" class="block text-gray-700 text-sm font-bold mb-2">Foto Alumno</label>
            <input type="file" name="imagen" id="imagen" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    
            @if ($alumno->imagen_url)
                <div class="mt-2">
                    <p class="text-gray-700 text-sm font-bold mb-2">Imagen actual:</p>
                    <img src="{{ asset('storage/alumnos/' . $alumno->imagen_url) }}" alt="Imagen del docente" class="w-32 h-32 object-cover rounded mx-auto">
                </div>
            @endif
        </div>

        <div class="flex w-full px-28 gap-6">
            <div class="w-1/2">

                <div class="mb-4">
                    <label for="DNI" class="block text-sm font-medium text-gray-700">DNI</label>
                    <input type="text" id="doc" name="DNI" readonly value="{{ old('DNI',$alumno->DNI) }}" class="form-input border border-gray-600 w-full h-10 rounded-md p-2 @error('DNI') is-invalid @enderror">
                    @error('DNI')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="nombres" class="block text-sm font-medium text-gray-700">Nombres</label>
                    <input type="text" id="nombres" name="nombres" readonly value="{{ old('nombres', $alumno->nombres) }}" class="form-input border border-gray-600 w-full h-10 rounded-md p-2 @error('nombres') is-invalid @enderror">
                    @error('nombres')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="apellidos" class="block text-sm font-medium text-gray-700">Apellidos</label>
                    <input type="text" id="apellidos" name="apellidos" readonly value="{{ old('apellidos', $alumno->apellidos) }}" class="form-input border border-gray-600 w-full h-10 rounded-md p-2 @error('apellidos') is-invalid @enderror">
                    @error('apellidos')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="fechaNacimiento" class="block text-sm font-medium text-gray-700">Fecha de Nacimiento</label>
                    <input type="date" id="fechaNacimiento" name="fechaNacimiento" value="{{ old('fechaNacimiento', $alumno->fechaNacimiento) }}" class="form-input border border-gray-600 rounded-md p-2 h-10 w-full @error('fechaNacimiento') is-invalid @enderror">
                    @error('fechaNacimiento')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="añoIngreso" class="block text-sm font-medium text-gray-700">Año de Ingreso</label>
                    <input type="date" id="añoIngreso" name="añoIngreso" value="{{ old('añoIngreso', $alumno->añoIngreso) }}" class="form-input h-10 border border-gray-600 w-full rounded-md p-2 @error('añoIngreso') is-invalid @enderror">
                    @error('añoIngreso')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="pais" class="block text-sm font-medium text-gray-700">País</label>
                    <select id="pais" name="pais" value="{{ old('pais', $alumno->pais) }}" class="form-select border border-gray-600 w-full h-10 rounded-md p-2 @error('pais') is-invalid @enderror">
                        <option value="">Seleccionar País</option>
                        <!-- Aquí deberías cargar los países y seleccionar el actual del alumno -->
                    </select>
                    @error('pais')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="departamento" class="block text-sm font-medium text-gray-700">Departamento</label>
                    <select id="departamento" name="departamento" class="form-select border border-gray-600 w-full h-10 rounded-md p-2 @error('departamento') is-invalid @enderror">
                        <option value="">Seleccionar Departamento</option>
                        <!-- Aquí deberías cargar los departamentos y seleccionar el actual del alumno -->
                    </select>
                    @error('departamento')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="provincia" class="block text-sm font-medium text-gray-700">Provincia</label>
                    <select id="provincia" name="provincia" class="form-select border border-gray-600 w-full h-10 rounded-md p-2 @error('provincia') is-invalid @enderror">
                        <option value="">Seleccionar Provincia</option>
                        <!-- Aquí deberías cargar las provincias y seleccionar la actual del alumno -->
                    </select>
                    @error('provincia')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="distrito" class="block text-sm font-medium text-gray-700">Distrito</label>
                    <select id="distrito" name="distrito" class="form-select border border-gray-600 w-full h-10 rounded-md p-2 @error('distrito') is-invalid @enderror">
                        <option value="">Seleccionar Distrito</option>
                        <!-- Aquí deberías cargar los distritos y seleccionar el actual del alumno -->
                    </select>
                    @error('distrito')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <div class="w-1/2">
                <div class="mb-4">
                    <label for="idEstadoCivil" class="block text-sm font-medium text-gray-700">Estado Civil</label>
                    <select id="idEstadoCivil" name="idEstadoCivil" class="form-select border border-gray-600 w-full h-10 rounded-md p-2 @error('idEstadoCivil') is-invalid @enderror">
                        <option value="">Seleccionar Estado Civil</option>
                        @foreach($estadosCiviles as $estadoCivil)
                            <option value="{{ $estadoCivil->idEstadoCivil }}" 
                                {{ old('idEstadoCivil', $alumno->idEstadoCivil) == $estadoCivil->idEstadoCivil ? 'selected' : '' }}>
                                {{ $estadoCivil->nombreEstadoCivil }}
                            </option>
                        @endforeach
                    </select>
                    @error('idEstadoCivil')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="idReligion" class="block text-sm font-medium text-gray-700">Religión</label>
                    <select id="idReligion" name="idReligion" class="form-select border border-gray-600 w-full h-10 rounded-md p-2 @error('idReligion') is-invalid @enderror">
                        <option value="">Seleccionar Religión</option>
                        @foreach($religiones as $religion)
                            <option value="{{ $religion->idReligion }}" 
                                {{ old('idReligion', $alumno->idReligion) == $religion->idReligion ? 'selected' : '' }}>
                                {{ $religion->nombreReligion }}
                            </option>
                        @endforeach
                    </select>
                    @error('idReligion')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="idEscala" class="block text-sm font-medium text-gray-700">Escala</label>
                    <select id="idEscala" name="idEscala" class="form-select border border-gray-600 w-full h-10 rounded-md p-2 @error('idEscala') is-invalid @enderror">
                        <option value="">Seleccionar Escala</option>
                        @foreach($escalas as $escala)
                            <option value="{{ $escala->idEscala }}" 
                                {{ old('idEscala', $alumno->idEscala) == $escala->idEscala ? 'selected' : '' }}>
                                {{ $escala->nombreEscala }}
                            </option>
                        @endforeach
                    </select>
                    @error('idEscala')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="idSexo" class="block text-sm font-medium text-gray-700">Sexo</label>
                    <select id="idSexo" name="idSexo" class="form-select border border-gray-600 w-full h-10 rounded-md p-2 @error('idSexo') is-invalid @enderror">
                        <option value="">Seleccionar Sexo</option>
                        @foreach($sexos as $sexo)
                            <option value="{{ $sexo->idSexo }}" 
                                {{ old('idSexo', $alumno->idSexo) == $sexo->idSexo ? 'selected' : '' }}>
                                {{ $sexo->nombreSexo }}
                            </option>
                        @endforeach
                    </select>
                    @error('idSexo')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="lenguaMaterna" class="block text-sm font-medium text-gray-700">Lengua Materna</label>
                    <input type="text" id="lenguaMaterna" name="lenguaMaterna" value="{{ old('lenguaMaterna', $alumno->lenguaMaterna) }}" class="form-input border border-gray-600 w-full h-10 rounded-md p-2 @error('lenguaMaterna') is-invalid @enderror">
                    @error('lenguaMaterna')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="fechaBautizo" class="block text-sm font-medium text-gray-700">Fecha de Bautizo</label>
                    <input type="date" id="fechaBautizo" name="fechaBautizo" value="{{ old('fechaBautizo', $alumno->fechaBautizo) }}" class="form-input w-full border border-gray-600 rounded-md p-2 @error('fechaBautizo') is-invalid @enderror">
                    @error('fechaBautizo')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="parroquiaDeBautizo" class="block text-sm font-medium text-gray-700">Parroquia de Bautizo</label>
                    <input type="text" id="parroquiaDeBautizo" name="parroquiaDeBautizo" value="{{ old('parroquiaDeBautizo', $alumno->parroquiaDeBautizo) }}" class="form-input border border-gray-600 w-full h-10 rounded-md p-2 @error('parroquiaDeBautizo') is-invalid @enderror">
                    @error('parroquiaDeBautizo')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="colegioProcedencia" class="block text-sm font-medium text-gray-700">Colegio de Procedencia</label>
                    <input type="text" id="colegioProcedencia" name="colegioProcedencia" value="{{ old('colegioProcedencia', $alumno->colegioProcedencia) }}" class="form-input border border-gray-600 w-full h-10 rounded-md p-2 @error('colegioProcedencia') is-invalid @enderror">
                    @error('colegioProcedencia')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-save"></i> Actualizar
            </button>
            <a href="{{ route('alumnos.index') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2">
                <i class="fas fa-ban"></i> Cancelar
            </a>
        </div>
    </form>
</div>

<script src="{{ asset('alumno/funciones.js') }}"></script>

@endsection