@extends('layouts.layout')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6 text-center">Registro Nuevo Alumno</h1>

    <div class="flex w-full px-28 gap-6 items-center">
        <div class="mb-4 w-3/4">
            <label for="DNI" class="block text-sm font-medium text-gray-700">DNI</label>
            <input type="text" id="dni" name="DNI" value="{{ old('DNI') }}" class="form-input border border-gray-600 w-full h-10 rounded-md p-2 @error('DNI') is-invalid @enderror">
            @error('DNI')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        <div class="button w-1/4 ">
            <button id="btnBuscar" class="bg-blue-700 p-2 rounded-md text-white justify-center w-full">BUSCAR</button>
        </div>
    </div>
    
    <form method="POST" action="{{route('alumnos.store')}}" class="flex flex-col items-center">
        @csrf

        <div class="flex w-full px-28 gap-6">
            <div class="w-1/2">
                <div class="mb-4">
                    <label for="DNI" class="block text-sm font-medium text-gray-700">DNI</label>
                    <input type="text" id="doc" name="DNI" value="{{ old('DNI') }}" class="form-input border border-gray-600 w-full h-10 rounded-md p-2 @error('DNI') is-invalid @enderror">
                    @error('DNI')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="nombres" class="block text-sm font-medium text-gray-700">Nombres</label>
                    <input type="text" id="nombres" name="nombres" value="{{ old('nombres') }}" class="form-input border border-gray-600 w-full h-10 rounded-md p-2 @error('nombres') is-invalid @enderror">
                    @error('nombres')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
        
                <div class="mb-4">
                    <label for="apellidos" class="block text-sm font-medium text-gray-700">Apellidos</label>
                    <input type="text" id="apellidos" name="apellidos" value="{{ old('apellidos') }}" class="form-input border border-gray-600 w-full h-10 rounded-md p-2 @error('apellidos') is-invalid @enderror">
                    @error('apellidos')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
        
                <div class="mb-4">
                    <label for="fechaNacimiento" class="block text-sm font-medium text-gray-700">Fecha de Nacimiento</label>
                    <input type="date" id="fechaNacimiento" name="fechaNacimiento" value="{{ old('fechaNacimiento') }}" class="form-input border border-gray-600 rounded-md p-2 h-10 w-full @error('fechaNacimiento') is-invalid @enderror">
                    @error('fechaNacimiento')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="añoIngreso" class="block text-sm font-medium text-gray-700">Año de Ingreso</label>
                    <input type="date" id="añoIngreso" name="añoIngreso" value="{{ old('añoIngreso') }}" class="form-input h-10 border border-gray-600 w-full rounded-md p-2 @error('añoIngreso') is-invalid @enderror">
                    @error('añoIngreso')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="pais" class="block text-sm font-medium text-gray-700">País</label>
                    <select id="pais" name="pais" class="form-select border border-gray-600 w-full h-10 rounded-md p-2 @error('pais') is-invalid @enderror">
                        <option value="">Seleccionar País</option>
                    </select>
                    @error('pais')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="departamento" class="block text-sm font-medium text-gray-700">Departamento</label>
                    <select id="departamento" name="departamento" class="form-select border border-gray-600 w-full h-10 rounded-md p-2 @error('departamento') is-invalid @enderror">
                        <option value="">Seleccionar Departamento</option>
                    </select>
                    @error('departamento')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="provincia" class="block text-sm font-medium text-gray-700">Provincia</label>
                    <select id="provincia" name="provincia" class="form-select border border-gray-600 w-full h-10 rounded-md p-2 @error('provincia') is-invalid @enderror">
                        <option value="">Seleccionar Provincia</option>
                    </select>
                    @error('provincia')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
        
                <div class="mb-4">
                    <label for="distrito" class="block text-sm font-medium text-gray-700">Distrito</label>
                    <select id="distrito" name="distrito" class="form-select border border-gray-600 w-full h-10 rounded-md p-2 @error('distrito') is-invalid @enderror">
                        <option value="">Seleccionar Distrito</option>
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
                    <select id="idReligion" name="idReligion" class="form-select border border-gray-600 w-full h-10 rounded-md p-2 @error('idReligion') is-invalid @enderror">
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
                    <select id="idEscala" name="idEscala" class="form-select border border-gray-600 w-full h-10 rounded-md p-2 @error('idEscala') is-invalid @enderror">
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
                    <select id="idSexo" name="idSexo" class="form-select border border-gray-600 w-full h-10 rounded-md p-2 @error('idSexo') is-invalid @enderror">
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

                <div class="mb-4">
                    <label for="lenguaMaterna" class="block text-sm font-medium text-gray-700">Lengua Materna</label>
                    <input type="text" id="lenguaMaterna" name="lenguaMaterna" value="{{ old('lenguaMaterna') }}" class="form-input border border-gray-600 w-full h-10 rounded-md p-2 @error('lenguaMaterna') is-invalid @enderror">
                    @error('lenguaMaterna')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
        
                <div class="mb-4">
                    <label for="fechaBautizo" class="block text-sm font-medium text-gray-700">Fecha de Bautizo</label>
                    <input type="date" id="fechaBautizo" name="fechaBautizo" value="{{ old('fechaBautizo') }}" class="form-input w-full border border-gray-600 rounded-md p-2 @error('fechaBautizo') is-invalid @enderror">
                    @error('fechaBautizo')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
        
                <div class="mb-4">
                    <label for="parroquiaDeBautizo" class="block text-sm font-medium text-gray-700">Parroquia de Bautizo</label>
                    <input type="text" id="parroquiaDeBautizo" name="parroquiaDeBautizo" value="{{ old('parroquiaDeBautizo') }}" class="form-input border border-gray-600 w-full h-10 rounded-md p-2 @error('parroquiaDeBautizo') is-invalid @enderror">
                    @error('parroquiaDeBautizo')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
        
                <div class="mb-4">
                    <label for="colegioProcedencia" class="block text-sm font-medium text-gray-700">Colegio de Procedencia</label>
                    <input type="text" id="colegioProcedencia" name="colegioProcedencia" value="{{ old('colegioProcedencia') }}" class="form-input border border-gray-600 w-full h-10 rounded-md p-2 @error('colegioProcedencia') is-invalid @enderror">
                    @error('colegioProcedencia')
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
                <a href="{{route('alumnos.index')}}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2">
                    <i class="fas fa-ban"></i> Cancelar
                </a>
            </div>


    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let boton = document.getElementById("btnBuscar");
        boton.addEventListener("click", traerDatos);
        function traerDatos() {
            console.log('si');
            let dni = document.getElementById("dni").value;
            let apiKey = "53e67e6cea17c3b1c1c4140e6e4c43cb489f48f1d3923dbe5546eacea85becc8";
            let url = `https://apiperu.dev/api/dni/${dni}?api_token=${apiKey}`;

            fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Error en la solicitud");
                    }
                    return response.json();
                })
                .then(datos => {
                    if (datos.success) {
                        document.getElementById("doc").value = datos.data.numero;
                        document.getElementById("nombres").value = datos.data.nombres;
                        document.getElementById("apellidos").value = `${datos.data.apellido_paterno} ${datos.data.apellido_materno}`;
                        //document.getElementById("cui").value = datos.data.codigo_verificacion;
                    } else {
                        alert("No se encontraron datos para el DNI proporcionado.");
                    }
                })
                .catch(error => {
                    console.error("Error al obtener los datos del DNI:", error);
                });
        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const paisSelect = document.getElementById('pais');
        const departamentoSelect = document.getElementById('departamento');
        const provinciaSelect = document.getElementById('provincia');
        const distritoSelect = document.getElementById('distrito');
        const countriesUrl = "{{ route('countries') }}";

        // Cargar países
        fetch('/countries')
            .then(response => response.json())
            .then(paises => {
                paises.sort((a, b) => a.countryName.localeCompare(b.countryName));
                paises.forEach(pais => {
                    const option = document.createElement('option');
                    option.value = pais.geonameId;
                    option.textContent = pais.countryName;
                    paisSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching countries:', error));

        // Evento para cargar departamentos
        paisSelect.addEventListener('change', function() {
            const countryId = this.value;
            if (countryId) {
                fetch(`/departamentos/${countryId}`)
                    .then(response => response.json())
                    .then(departamentos => {
                        departamentoSelect.innerHTML = '<option value="">Seleccionar Departamento</option>';
                        departamentos.forEach(depto => {
                            const option = document.createElement('option');
                            option.value = depto.geonameId;
                            option.textContent = depto.name;
                            departamentoSelect.appendChild(option);
                        });
                        provinciaSelect.innerHTML = '<option value="">Seleccionar Provincia</option>';
                        distritoSelect.innerHTML = '<option value="">Seleccionar Distrito</option>';
                    })
                    .catch(error => console.error('Error fetching departamentos:', error));
            }
        });

        // Evento para cargar provincias
        departamentoSelect.addEventListener('change', function() {
            const geonameId = this.value;
            if (geonameId) {
                fetch(`/provincias/${geonameId}`)
                    .then(response => response.json())
                    .then(provincias => {
                        provinciaSelect.innerHTML = '<option value="">Seleccionar Provincia</option>';
                        provincias.forEach(prov => {
                            const option = document.createElement('option');
                            option.value = prov.geonameId;
                            option.textContent = prov.name;
                            provinciaSelect.appendChild(option);
                        });
                        distritoSelect.innerHTML = '<option value="">Seleccionar Distrito</option>';
                    })
                    .catch(error => console.error('Error fetching provincias:', error));
            }
        });

        // Evento para cargar distritos
        provinciaSelect.addEventListener('change', function() {
            const geonameId = this.value;
            if (geonameId) {
                fetch(`/distritos/${geonameId}`)
                    .then(response => response.json())
                    .then(distritos => {
                        distritoSelect.innerHTML = '<option value="">Seleccionar Distrito</option>';
                        distritos.forEach(dist => {
                            const option = document.createElement('option');
                            option.value = dist.geonameId;
                            option.textContent = dist.name;
                            distritoSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error fetching distritos:', error));
            }
        });
    });
</script>

@endsection
