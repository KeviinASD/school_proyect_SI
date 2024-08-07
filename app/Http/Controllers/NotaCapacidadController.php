<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\FichaNotas;
use App\Models\FichaMatriculas;
use App\Models\Alumno;
use App\Models\DetalleNotas;
use App\Models\NotaCapacidad;

class NotaCapacidadController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        
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
        //dd($request->all());
        $notas = $request->input('notas', []);
    
        foreach ($notas as $codigoAlumno => $capacidades) {
            foreach ($capacidades as $idCapacidad => $nota) {
                if (!is_null($nota)) { // Asegúrate de que hay una nota válida
                    
                    NotaCapacidad::where('idCapacidad', $idCapacidad)
                        ->where('codigoAlumno', $codigoAlumno)
                        ->where('idFicha', $request->input('fichaId'))
                        ->where('idAsignatura', $request->input('asignatura_id'))
                        ->where('idCurso', $request->input('curso_id'))
                        ->where('codigo_Docente', $request->input('codigo_Docente'))
                        ->update(['nota' => $nota]);
                }
            }
        }
    
        return redirect()->route('detalle-notas.index')->with('success', 'Notas guardadas exitosamente.');
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
