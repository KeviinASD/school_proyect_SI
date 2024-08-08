<?php

// app/Http/Controllers/ReporteNotasController.php

namespace App\Http\Controllers;

use App\Models\NotaCapacidad;
use App\Models\Asignatura;
use Illuminate\Http\Request;

class ReporteNotasController extends Controller
{
    public function index()
    {
        $asignaturas = Asignatura::where('estado', 1)->get();
        return view('pages.reporteDeNota.index', compact('asignaturas'));
    }

    public function reportePorAsignatura(Request $request)
    {
        $request->validate([
            'idAsignatura' => 'required|exists:asignaturas,idAsignatura'
        ]);

        $notas = NotaCapacidad::where('idAsignatura', $request->idAsignatura)
            ->join('alumnos', 'nota_capacidad.codigoAlumno', '=', 'alumnos.codigoAlumno')
            ->select('alumnos.nombres', 'alumnos.apellidos', 'nota_capacidad.nota')
            ->get();

        $asignatura = Asignatura::find($request->idAsignatura);

        return view('pages.reporteDeNota.reporte', compact('notas', 'asignatura'));
    }
}


