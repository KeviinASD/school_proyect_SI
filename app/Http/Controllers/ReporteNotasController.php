<?php

// app/Http/Controllers/ReporteNotasController.php

namespace App\Http\Controllers;

use App\Models\NotaCapacidad;
use App\Models\Asignatura;
use App\Models\Catedra;
use App\Models\DetalleNotas;
use App\Models\Docente;
use App\Models\FichaNotas;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteNotasController extends Controller
{
    public function index()
    {
        //años escolarares donde esten enseñando los profesores
        $añosEscolares = Catedra::select('añoEscolar')->distinct()->get();
        return view('pages.reporteDeNota.index', compact('añosEscolares'));
    }

    public function pdfNotas(Request $request)
    {
        $añoEscolar = $request->input('añoEscolar');
        $codigoDocente = $request->input('codigo_docente');
        $idAsignatura = $request->input('id_asignatura');
        $periodo = $request->input('periodo'); // Obtener el periodo del formulario
    
        // Procesar los datos como lo necesites
        $fichaDeNotas = FichaNotas::where('codigo_Docente', $codigoDocente)
            ->where('idAsignatura', $idAsignatura)
            ->where('periodo', $periodo)
            ->where('añoEscolar', $añoEscolar)
            ->first();
    
        // Verifica si se encontró la ficha de notas
        if (!$fichaDeNotas) {
            return redirect()->back()->withErrors(['message' => 'No se encontraron notas para este docente y asignatura.']);
        }

        $detallesDeNotas = DetalleNotas::where('idFicha', $fichaDeNotas->idFicha)->get();           
        
        //return view('pages.reporteDeNota.pdf', compact('fichaDeNotas', 'detallesDeNotas'));
        $pdf = PDF::loadView('pages.reporteDeNota.pdf', compact('fichaDeNotas', 'detallesDeNotas'));
        return $pdf->stream('reporte_de_notas.pdf');
    }

    public function docentesByAñoEscolar($añoEscolar)
    {
        // Obtener los códigos de docentes que tienen cátedras en el año escolar específico
        $catedras = Catedra::where('añoEscolar', $añoEscolar)
            ->distinct('codigo_docente')
            ->pluck('codigo_docente'); // Esto te dará una colección de códigos de docentes
    
        // Ahora obtener los docentes que están activos y cuyos códigos están en las cátedras obtenidas
        $docentes = Docente::whereIn('codigo_docente', $catedras)
            ->where('estado', 1) // Solo obtener docentes activos
            ->get(['codigo_docente', 'nombres', 'apellidos']); // Selecciona los campos que necesitas
    
        // Formatear los resultados para la respuesta JSON
        $docentesFormatted = $docentes->map(function ($docente) {
            return [
                'codigo_docente' => $docente->codigo_docente,
                'nombre' => $docente->nombres . ' ' . $docente->apellidos,
            ];
        });
    
        return response()->json(['docentes' => $docentesFormatted]);
    }

    public function asignaturasByDocente($codigoDocente)
    {
        // Obtener las cátedras del docente
        $catedras = Catedra::where('codigo_docente', $codigoDocente)
            ->with('asignatura') // Cargar las asignaturas relacionadas
            ->distinct('idAsignatura')
            ->get();
    
        // Extraer las asignaturas de las cátedras
        $asignaturas = $catedras->pluck('asignatura')->filter(); // Filtrar las asignaturas nulas
    
        return response()->json(['asignaturas' => $asignaturas]);
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


