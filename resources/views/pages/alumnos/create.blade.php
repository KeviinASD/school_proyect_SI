@extends('layouts.layout')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6 text-center">Registro Nuevo Alumno</h1>
    <form method="POST" action="{{route('alumnos.store')}}">
        @csrf

        <div class="flex w-full px-28 gap-6">
            <div class="w-1/2">
                <div class="mb-4">
                    <label for="codigoAlumno" class="block text-sm font-medium text-gray-700">Código de Alumno</label>
                    <input type="text" id="codigoAlumno" name="codigoAlumno" value="{{ old('codigoAlumno') }}" class="form-input border border-gray-600 w-full h-8 rounded-md p-2 @error('codigoAlumno') is-invalid @enderror">
                    @error('codigoAlumno')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
        
                <div class="mb-4">
                    <label for="nombres" class="block text-sm font-medium text-gray-700">Nombres</label>
                    <input type="text" id="nombres" name="nombres" value="{{ old('nombres') }}" class="form-input border border-gray-600 w-full h-8 rounded-md p-2 @error('nombres') is-invalid @enderror">
                    @error('nombres')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
        
                <div class="mb-4">
                    <label for="apellidos" class="block text-sm font-medium text-gray-700">Apellidos</label>
                    <input type="text" id="apellidos" name="apellidos" value="{{ old('apellidos') }}" class="form-input border border-gray-600 w-full h-8 rounded-md p-2 @error('apellidos') is-invalid @enderror">
                    @error('apellidos')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
        
                <div class="mb-4">
                    <label for="DNI" class="block text-sm font-medium text-gray-700">DNI</label>
                    <input type="text" id="DNI" name="DNI" value="{{ old('DNI') }}" class="form-input border border-gray-600 w-full h-8 rounded-md p-2 @error('DNI') is-invalid @enderror">
                    @error('DNI')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
        
                <div class="mb-4">
                    <label for="fechaNacimiento" class="block text-sm font-medium text-gray-700">Fecha de Nacimiento</label>
                    <input type="date" id="fechaNacimiento" name="fechaNacimiento" value="{{ old('fechaNacimiento') }}" class="form-input w-full @error('fechaNacimiento') is-invalid @enderror">
                    @error('fechaNacimiento')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
        
                <div class="mb-4">
                    <label for="añoIngreso" class="block text-sm font-medium text-gray-700">Año de Ingreso</label>
                    <input type="date" id="añoIngreso" name="añoIngreso" value="{{ old('añoIngreso') }}" class="form-input border border-gray-600 w-full h-8 rounded-md p-2 @error('añoIngreso') is-invalid @enderror">
                    @error('añoIngreso')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
        
                <div class="mb-4">
                    <label for="departamento" class="block text-sm font-medium text-gray-700">Departamento</label>
                    <input type="text" id="departamento" name="departamento" value="{{ old('departamento') }}" class="form-input border border-gray-600 w-full h-8 rounded-md p-2 @error('departamento') is-invalid @enderror">
                    @error('departamento')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
        
                <div class="mb-4">
                    <label for="pais" class="block text-sm font-medium text-gray-700">País</label>
                    <input type="text" id="pais" name="pais" value="{{ old('pais') }}" class="form-input border border-gray-600 w-full h-8 rounded-md p-2 @error('pais') is-invalid @enderror">
                    @error('pais')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
        
                <div class="mb-4">
                    <label for="provincia" class="block text-sm font-medium text-gray-700">Provincia</label>
                    <input type="text" id="provincia" name="provincia" value="{{ old('provincia') }}" class="form-input border border-gray-600 w-full h-8 rounded-md p-2 @error('provincia') is-invalid @enderror">
                    @error('provincia')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
        
                <div class="mb-4">
                    <label for="distrito" class="block text-sm font-medium text-gray-700">Distrito</label>
                    <input type="text" id="distrito" name="distrito" value="{{ old('distrito') }}" class="form-input border border-gray-600 w-full h-8 rounded-md p-2 @error('distrito') is-invalid @enderror">
                    @error('distrito')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
        
                <div class="mb-4">
                    <label for="lenguaMaterna" class="block text-sm font-medium text-gray-700">Lengua Materna</label>
                    <input type="text" id="lenguaMaterna" name="lenguaMaterna" value="{{ old('lenguaMaterna') }}" class="form-input border border-gray-600 w-full h-8 rounded-md p-2 @error('lenguaMaterna') is-invalid @enderror">
                    @error('lenguaMaterna')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
        
                <div class="mb-4">
                    <label for="fechaBautizo" class="block text-sm font-medium text-gray-700">Fecha de Bautizo</label>
                    <input type="date" id="fechaBautizo" name="fechaBautizo" value="{{ old('fechaBautizo') }}" class="form-input w-full @error('fechaBautizo') is-invalid @enderror">
                    @error('fechaBautizo')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
        
                <div class="mb-4">
                    <label for="parroquiaDeBautizo" class="block text-sm font-medium text-gray-700">Parroquia de Bautizo</label>
                    <input type="text" id="parroquiaDeBautizo" name="parroquiaDeBautizo" value="{{ old('parroquiaDeBautizo') }}" class="form-input border border-gray-600 w-full h-8 rounded-md p-2 @error('parroquiaDeBautizo') is-invalid @enderror">
                    @error('parroquiaDeBautizo')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
        
                <div class="mb-4">
                    <label for="colegioProcedencia" class="block text-sm font-medium text-gray-700">Colegio de Procedencia</label>
                    <input type="text" id="colegioProcedencia" name="colegioProcedencia" value="{{ old('colegioProcedencia') }}" class="form-input border border-gray-600 w-full h-8 rounded-md p-2 @error('colegioProcedencia') is-invalid @enderror">
                    @error('colegioProcedencia')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <div class="w-1/2">
                <div class="mb-4">
                    <label for="idEstadoCivil" class="block text-sm font-medium text-gray-700">Estado Civil</label>
                    <select id="idEstadoCivil" name="idEstadoCivil" class="form-select border border-gray-600 w-1/2 h-8 rounded-md p-2 @error('idEstadoCivil') is-invalid @enderror">
                        <option value="">Seleccionar Estado Civil</option>
                        @foreach($estadosCiviles as $estadoCivil)
                            <option value="{{ $estadoCivil->idEstadoCivil }}" {{ old('idEstadoCivil') == $estadoCivil->idEstadoCivil ? 'selected' : '' }}>
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
                    <select id="idReligion" name="idReligion" class="form-select border border-gray-600 w-1/2 h-8 rounded-md p-2 @error('idReligion') is-invalid @enderror">
                        <option value="">Seleccionar Religión</option>
                        @foreach($religiones as $religion)
                            <option value="{{ $religion->idReligion }}" {{ old('idReligion') == $religion->idReligion ? 'selected' : '' }}>
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
                    <select id="idEscala" name="idEscala" class="form-select border border-gray-600 w-1/2 h-8 rounded-md p-2 @error('idEscala') is-invalid @enderror">
                        <option value="">Seleccionar Escala</option>
                        @foreach($escalas as $escala)
                            <option value="{{ $escala->idEscala }}" {{ old('idEscala') == $escala->idEscala ? 'selected' : '' }}>
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
                    <select id="idSexo" name="idSexo" class="form-select border border-gray-600 w-1/2 h-8 rounded-md p-2 @error('idSexo') is-invalid @enderror">
                        <option value="">Seleccionar Sexo</option>
                        @foreach($sexos as $sexo)
                            <option value="{{ $sexo->idSexo }}" {{ old('idSexo') == $sexo->idSexo ? 'selected' : '' }}>
                                {{ $sexo->nombreSexo }}
                            </option>
                        @endforeach
                    </select>
                    @error('idSexo')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
        </div>
        

        <!-- Otros campos del formulario -->

            <div class="mt-6">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-save"></i> Grabar
                </button>
                <a href="" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2">
                    <i class="fas fa-ban"></i> Cancelar
                </a>
            </div>


        </form>
    </div>

    
@endsection
