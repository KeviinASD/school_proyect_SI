<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Reporte Matriculados</title>
</head>
<body>
    <div class="">
        <h2 class="text-center text-3xl mb-6">Reporte de Alumnos Matriculados</h2>
        <div class="text-center text-2xl font-bold">
            <p class=" text-center">
                Año Academico: {{ $añoActual }}
            </p>
        </div>
        <table class="w-full mt-4">
            <thead class="w-full">
                <tr class="">
                    @if($idNivel != -1)
                        <th class="border border-black">Nivel</th>
                    @endif
                    @if($idGrado != -1)
                        <th class="border border-black">Grado</th>
                    @endif
                    @if($idSeccion != -1)
                        <th class="border border-black">Sección</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                <tr>
                    @if($idNivel != -1)
                        <td class="border border-black">{{ $fichasMatriculas[0]->nivel->nombreNivel }}</td>
                    @endif
                    @if($idGrado != -1)
                        <td class="border border-black">{{ $fichasMatriculas[0]->grado->nombreGrado }}</td>
                    @endif
                    @if($idSeccion != -1)
                        <td class="border border-black">{{ $fichasMatriculas[0]->seccion->nombreSeccion }}</td>
                    @endif
                </tr>
            </tbody>
        </table>
    
        @if(session('error'))
            <p class="text-red-600">{{ session('error') }}</p>
        @endif
    
        @if(session('warning'))
            <p class="text-yellow-600">{{ session('warning') }}</p>
        @endif
    
        @if($fichasMatriculas->isNotEmpty())
            <table class="w-full mt-20">
                <thead class="">
                    <tr class="rounded-md">
                        <th class="border border-black">Nro Matrícula</th>
                        <th class="border border-black">Código Alumno</th>
                        <th class="border border-black">Fecha Matrícula</th>
                        <th class="border border-black">Sección</th>
                        <th class="border border-black">Grado</th>
                        <th class="border border-black">Nivel</th>
                        <th class="border border-black ">Año Escolar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($fichasMatriculas as $index => $ficha)
                    <tr class="">
                        <td class="border border-black">{{ $ficha->nroMatricula }}</td>
                        <td class="border border-black py-2">{{ $ficha->codigoAlumno }}</td>
                        <td class="border border-black py-2">{{ $ficha->fechaMatricula }}</td>
                        <td class="border border-black py-2">{{ $ficha->seccion->nombreSeccion }}</td>
                        <td class="border border-black py-2">{{ $ficha->grado->nombreGrado }}</td>
                        <td class="border border-black py-2">{{ $ficha->nivel->nombreNivel }}</td>
                        <td class="border border-black py-2">{{ $ficha->añoEscolar }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No hay datos para mostrar.</p>
        @endif
    </div>
</body>
</html>