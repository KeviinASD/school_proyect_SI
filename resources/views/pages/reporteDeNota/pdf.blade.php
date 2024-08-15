<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    @vite('resources/css/app.css')
    <title>Registro de Notas</title>
</head>
<body>
    @php
        $count = 0;
    @endphp
    <section class="w-full">
        <h1 class="text-center text-3xl mb-6">REGISTRO DE NOTAS</h1>
        <div class="w-2/3 mx-auto space-y-4">
            <h1 class="text-center text-2xl font-bold">
                @if($fichaDeNotas->periodo == 1)
                    PRIMER BIMESTRE
                @elseif($fichaDeNotas->periodo == 2)
                    SEGUNDO BIMESTRE
                @elseif($fichaDeNotas->periodo == 3)
                    TERCER BIMESTRE
                @endif
            </h1>
            <p class="text-end">
                Año Academico: {{ $fichaDeNotas->añoEscolar }}
            </p>
        </div>
        <div class="w-2/3 mx-auto">
            <table class="w-full">
                <thead class="w-full">
                    <tr class="">
                        <th class="border border-black">Grado</th>
                        <th class="border border-black">Sección</th>
                        <th class="border border-black">Área</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border border-black">{{ $fichaDeNotas->grado->nombreGrado }}</td>
                        <td class="border border-black">{{ $fichaDeNotas->seccion->nombreSeccion }}</td>
                        <td class="border border-black">{{ $fichaDeNotas->asignatura->nombreAsignatura }}</td>
                    </tr>
                </tbody>
            </table>
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="border border-black">CODSTRA</th>
                        <th class="border border-black">Profesor</th>
                        <th class="border border-black">Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border border-black">{{ $fichaDeNotas->docente->codigo_docente }}</td>
                        <td class="border border-black">{{ $fichaDeNotas->docente->nombres }} {{ $fichaDeNotas->docente->apellidos }}</td>
                        <td class="border border-black">{{ $fichaDeNotas->fecha }}</td>
                    </tr>
            </table>

            <div class="mt-20">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="border border-black">Nro</th>
                            <th class="border border-black">Apellidos y nombres</th>
                            @foreach($fichaDeNotas->asignatura->capacidades as $capacidad)
                                <th class="border border-black">{{ $capacidad->abreviatura }}</th>
                            @endforeach
                            <th class="border border-black">Promedio</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($detallesDeNotas as $detalle)
                            @php
                                $totalNotas = 0;
                                $countCapacidades = 0;
                            @endphp
                            <tr>
                                <td class="border border-black">{{ ++$count }}</td>
                                <td class="border border-black">{{ $detalle->alumno->apellidos }} {{ $detalle->alumno->nombres }}</td>
                                @foreach($detalle->notasCapacidad as $nota)
                                    @php
                                        $notaValor = $nota->nota;
                                        $totalNotas += letterToValue($notaValor);
                                        $countCapacidades++;
                                    @endphp
                                    <td class="border border-black">{{ $notaValor }}</td>
                                @endforeach

                                @php
                                    // Calcular el promedio
                                    $promedio = $countCapacidades > 0 ? ($totalNotas / $countCapacidades) : 0;
                                    $promedioLetra = valueToLetter($promedio);
                                @endphp

                                <td class="border border-black">
                                    {{ $promedioLetra }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>   
    </section>     
</body>
</html>

@php
    function letterToValue($letter) {
        switch (strtoupper($letter)) {
            case 'AD': return 20;
            case 'A':  return 17;
            case 'B':  return 13;
            case 'C':  return 8;
            default:   return 0;
        }
    }

    function valueToLetter($value) {
        if ($value == 20) return 'AD';
        if ($value >= 16 && $value <= 19) return 'A';
        if ($value >= 11 && $value <= 15) return 'B';
        return 'C';
    }
@endphp