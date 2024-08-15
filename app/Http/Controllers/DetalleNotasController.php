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
        $bimestre = $request->input('bimestre', '1');

        $idFicha = Session::get('ficha1');
        
        if ($bimestre == '1') {
            $idFicha = Session::get('ficha1');
        } elseif ($bimestre == '2') {
            $idFicha = Session::get('ficha2');
        } elseif ($bimestre == '3') {
            $idFicha = Session::get('ficha3');
        }

        /* $bimestre = $request->input('bimestre', '2');
     
         // Obtener los IDs de las fichas desde los parámetros de la solicitud
         $idFicha1 = $request->input('ficha1');
         $idFicha2 = $request->input('ficha2');
         $idFicha3 = $request->input('ficha3');
     
         // Determinar el idFicha basado en el bimestre
         $idFicha = $bimestre === '1' ? $idFicha1 : ($bimestre === '2' ? $idFicha2 : $idFicha3);
      */


        $ficha = FichaNotas::where('periodo', $bimestre)->where('idFicha', $idFicha)->first();
        

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
                ->where('codigo_Docente', $ficha->codigo_Docente)
                ->first();

            if (!$existe) {
                DetalleNotas::create([
                    'codigoAlumno' => $alumno->codigoAlumno,
                    'idFicha' => $ficha->idFicha,
                    'idAsignatura' => $asignatura->idAsignatura,
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
                    ->where('codigo_Docente', $ficha->codigo_Docente)
                    ->first();

                if (!$existeCapacidad) {
                    NotaCapacidad::create([
                        'idCapacidad' => $capacidad->idCapacidad,
                        'codigoAlumno' => $alumno->codigoAlumno,
                        'idFicha' => $ficha->idFicha,
                        'idAsignatura' => $asignatura->idAsignatura,
                        'codigo_Docente' => $ficha->codigo_Docente,
                        'nota' => null
                    ]);
                }
            }
        }

        return view('pages.detalleNotas.index', compact('alumnos', 'ficha', 'bimestre'));
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
