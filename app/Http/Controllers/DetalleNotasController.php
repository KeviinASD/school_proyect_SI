<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\FichaNotas;
use App\Models\FichaMatriculas;
use App\Models\Alumno;
use App\Models\DetalleNotas;
use App\Models\NotaCapacidad;

class DetalleNotasController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $bimestre = $request->input('bimestre', '2');

        $ficha = FichaNotas::where('periodo', $bimestre)->first();
        //dd($ficha);

        // Obtener los alumnos matriculados que coinciden con los criterios de la ficha
        $alumnos = Alumno::with('notasCapacidades')
            ->join('ficha_matriculas', 'alumnos.codigoAlumno', '=', 'ficha_matriculas.codigoAlumno')
            ->where('ficha_matriculas.idGrado', $ficha->idGrado)
            ->where('ficha_matriculas.añoEscolar', $ficha->añoEscolar)
            ->where('ficha_matriculas.idNivel', $ficha->idNivel)
            ->get();

        $asignatura = $ficha->asignatura;
        $capacidades = $asignatura ? $asignatura->capacidades : collect();

        // Procesar los alumnos
        foreach ($alumnos as $alumno) {
            $existe = DetalleNotas::where('codigoAlumno', $alumno->codigoAlumno)
                ->where('idFicha', $ficha->idFicha)
                ->where('idAsignatura', $asignatura->idAsignatura)
                ->where('idCurso', $ficha->idCurso)
                ->where('codigo_Docente', $ficha->codigo_Docente)
                ->first();

            if (!$existe) {
                DetalleNotas::create([
                    'codigoAlumno' => $alumno->codigoAlumno,
                    'idFicha' => $ficha->idFicha,
                    'idAsignatura' => $asignatura->idAsignatura,
                    'idCurso' => $ficha->idCurso,
                    'codigo_Docente' => $ficha->codigo_Docente
                ]);
            }
        }

        // Procesar las capacidades
        foreach ($capacidades as $capacidad) {
            foreach ($alumnos as $alumno) {
                $existeCapacidad = NotaCapacidad::where('idCapacidad', $capacidad->idCapacidad)
                    ->where('codigoAlumno', $alumno->codigoAlumno)
                    ->where('idFicha', $ficha->idFicha)
                    ->where('idAsignatura', $asignatura->idAsignatura)
                    ->where('idCurso', $ficha->idCurso)
                    ->where('codigo_Docente', $ficha->codigo_Docente)
                    ->first();

                if (!$existeCapacidad) {
                    NotaCapacidad::create([
                        'idCapacidad' => $capacidad->idCapacidad,
                        'codigoAlumno' => $alumno->codigoAlumno,
                        'idFicha' => $ficha->idFicha,
                        'idAsignatura' => $asignatura->idAsignatura,
                        'idCurso' => $ficha->idCurso,
                        'codigo_Docente' => $ficha->codigo_Docente,
                        'nota' => null
                    ]);
                }
            }
        }

        return view('pages.detalleNotas.index', compact('alumnos', 'ficha'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
