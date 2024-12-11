@extends('layouts.layout')

@section('title', 'DetalleNotas')

@section('content')
    <div class="container mx-auto px-4">
        <div>
            <a href=" {{route('notas.pdf', [
                'añoEscolar' => $ficha->añoEscolar,
                'codigo_docente' => $ficha->codigo_Docente,
                'id_asignatura' => $ficha->idAsignatura,
                'periodo' => $bimestre
            ])}} "><button class="px-2 py-2 bg-black-primary-200 text-white">Generar Reporte</button></a>
        </div>

        <div class="grid grid-cols-3 gap-2">
            <!-- Información del curso y docente -->
            
            <div>
                <h2 class="text-xl font-semibold mt-4 mb-2">Nivel</h2>
                <input type="text" readonly name="nivel" class="w-18 py-1 px-2 border border-gray-300 rounded-md" value="{{ $ficha->nivel->nombreNivel }}">
            </div>
            <div>
                <h2 class="text-xl font-semibold mt-4 mb-2">Grado</h2>
                <input type="text" readonly name="grado" class="w-18 py-1 px-2 border border-gray-300 rounded-md" value="{{ $ficha->grado->nombreGrado}}">
            </div>
            <div>
                <h2 class="text-xl font-semibold mt-4 mb-2">Sección</h2>
                <input type="text" readonly name="seccion" class="w-18 py-1 px-2 border border-gray-300 rounded-md" value="{{ $ficha->seccion->nombreSeccion}}">
            </div>
            <div>
                <h2 class="text-xl font-semibold mt-4 mb-2">Año Escolar</h2>
                <input type="text" readonly name="añoEscolar" class="w-18 py-1 px-2 border border-gray-300 rounded-md" value="{{ $ficha->añoEscolar}}">
            </div>
            <div>
                <h2 class="text-xl font-semibold mt-4 mb-2">Asignatura</h2>
                <input type="text" readonly name="asignatura" class="w-18 py-1 px-2 border border-gray-300 rounded-md" value="{{ $ficha->asignatura->nombreAsignatura}}">
            </div>
            <div>
                <h2 class="text-xl font-semibold mt-4 mb-2">Docente</h2>
                <input type="text" readonly name="docente" class="w-18 py-1 px-2 border border-gray-300 rounded-md" value="{{ $ficha->docente->nombres }} {{ $ficha->docente->apellidos }}">
            </div>
        </div>

        <h2 class="text-xl font-bold mt-6 mb-2">Capacidades de {{ $ficha->asignatura->nombreAsignatura }}</h2>

        <div class="overflow-x-auto mt-4">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b-2 border-gray-200 text-left text-sm font-semibold text-gray-600">Capacidad</th>
                        <th class="py-2 px-4 border-b-2 border-gray-200 text-left text-sm font-semibold text-gray-600">Abreviatura</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ficha->asignatura->capacidades as $capacidad)
                        <tr class="hover:bg-gray-100">
                            <td class="py-2 px-4 border-b border-gray-200">{{ $capacidad->descripcion }}</td>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $capacidad->abreviatura }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="grid grid-cols-2 gap-2">
            <h2 class="text-xl font-bold mt-6 mb-2">Alumnos Matriculados</h2>
            <div class="mt-4">
                <form action="{{ route('detalle-notas.index') }}" method="GET" class="flex items-center">
                    <select id="bimestre" name="bimestre" class="w-full py-2 px-3 border border-gray-300 rounded-md">
                        <option value="1" {{ $bimestre == '1' ? 'selected' : '' }}>I Bimestre</option>
                        <option value="2" {{ $bimestre == '2' ? 'selected' : '' }}>II Bimestre</option>
                        <option value="3" {{ $bimestre == '3' ? 'selected' : '' }}>III Bimestre</option>
                    </select>
                    <button type="submit" class="ml-2 px-4 py-1 rounded bg-blue-500 text-white">Filtrar</button>
                </form>
            </div>
        </div>

        <form action="{{ route('nota-capacidad.store') }}" method="POST">
            @csrf
            <input type="hidden" name="fichaId" value="{{ $ficha->idFicha }}">
            <input type="hidden" name="asignatura_id" value="{{ $ficha->idAsignatura }}">
            <input type="hidden" name="codigo_Docente" value="{{ $ficha->codigo_Docente }}">
            
            <div class="overflow-x-auto mt-4">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b-2 border-gray-200 text-left text-sm font-semibold text-gray-600">Alumnos</th>
                            @foreach($ficha->asignatura->capacidades as $capacidad)
                                <th class="py-2 px-4 border-b-2 border-gray-200 text-left text-sm font-semibold text-gray-600">{{ $capacidad->abreviatura }}</th>
                            @endforeach
                            <th class="py-2 px-4 border-b-2 border-gray-200 text-left text-sm font-semibold text-gray-600">Promedio</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alumnos as $alumno)
                            <tr class="hover:bg-gray-100">
                                <td class="py-2 px-4 border-b border-gray-200">{{ $alumno->nombres }} {{ $alumno->apellidos }}</td>

                                @php
                                    $totalNotas = 0;
                                    $countCapacidades = 0;
                                @endphp

                                @foreach($ficha->asignatura->capacidades as $capacidad)
                                    @php
                                        $nota = $alumno->notasCapacidades->where('idCapacidad', $capacidad->idCapacidad)->where('idFicha', $ficha->idFicha)->first();
                                        $notaValor = $nota ? $nota->nota : '';
                                        $totalNotas += letterToValue($notaValor);
                                        $countCapacidades++;
                                    @endphp
                                    <td class="py-2 px-4 border-b border-gray-200">
                                        <input type="text" 
                                           name="notas[{{ $alumno->codigoAlumno }}][{{ $capacidad->idCapacidad }}]" 
                                           value="{{ old('notas.' . $alumno->codigoAlumno . '.' . $capacidad->idCapacidad, $notaValor) }}" 
                                           class="form-input" 
                                           placeholder="Ingrese una nota" 
                                           maxlength="2" 
                                           oninput="validarNota(this)"
                                           >

                                    </td>
                                @endforeach

                                @php
                                    // Calcular el promedio
                                    $promedio = $countCapacidades > 0 ? ($totalNotas / $countCapacidades) : 0;
                                    $promedioLetra = valueToLetter($promedio);
                                @endphp

                                <td class="py-2 px-4 border-b border-gray-200">
                                    {{ $promedioLetra }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="submit" class="py-2 px-4 bg-green-500 text-white rounded-md mt-4">Guardar cambios</button>
            </div>
        </form>
    </div>
@endsection

<script>
    function validarNota(input) {
        // Obtener el valor ingresado y convertirlo a mayúsculas
        const valor = input.value.toUpperCase();
        
        // Las combinaciones válidas
        const combinacionesValidas = ['AD', 'A', 'B', 'C'];
        // Si el valor es válido, lo dejamos tal como está
        if (combinacionesValidas.includes(valor)) {
            return;
        }
        // Si el valor no es válido, ajustamos el valor a una entrada vacía o al último valor válido
        input.value = ''; // Limpiar el valor si es inválido
    }
</script>



@php
    function letterToValue($letter) {
        switch (strtoupper($letter)) {
            case 'AD': return 20; // Logro Destacado (Excelente)
            case 'A':  return 17; // Logro Esperado (Bueno)
            case 'B':  return 13; // En Proceso (Regular)
            case 'C':  return 8;  // Deficiente (Reprobado)
            default:   return 0;
        }
    }

    function valueToLetter($value) {
        if (!$value) return '';

        if ($value == 20) return 'AD';
        if ($value >= 16 && $value <= 19) return 'A';
        if ($value >= 11 && $value <= 15) return 'B';
        return 'C';
    }
@endphp