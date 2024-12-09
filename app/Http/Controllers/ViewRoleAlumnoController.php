<?php

namespace App\Http\Controllers;
use App\Models\Alumno;
use App\Models\Catedra;
use App\Models\DetalleNotas;
use Illuminate\Http\Request;
use App\Models\EstadoCivil;
use App\Models\Sexo;
use App\Models\Religion;
use App\Models\Escala;
use App\Models\FichaMatriculas;
use App\Models\FichaNotas;
use App\Models\NotaCapacidad;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ViewRoleAlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function hijos(Request $request, $dniApoderado)
     {
        $añoEscolarActual = "2024";
     
         $alumnos = Alumno::where('dniApoderado', $dniApoderado)
             ->where('estado', 1)
             ->get()
             ->filter(function ($alumno) use ($añoEscolarActual) {
                 $fichaMatricula = FichaMatriculas::where('codigoAlumno', $alumno->codigoAlumno)
                     ->where('añoEscolar', $añoEscolarActual)
                     ->first();
     
                 if ($fichaMatricula) {
                     $alumno->fichaMatricula = $fichaMatricula; // Agregar la ficha al alumno
                     return true; // Mantener este alumno
                 }
     
                 return false; // Eliminar este alumno
             });
     
        return view('pages.roleApoderado.home', compact('alumnos', 'añoEscolarActual'));
     }
    
     public function index(Request $request, $codigoAlumno)
     {
         // Obtener el año escolar seleccionado o el más alto por defecto
        $añoEscolarActual = "2024";
        
        $fichaMatricula = FichaMatriculas::where('codigoAlumno', $codigoAlumno)
            ->where('añoEscolar', $añoEscolarActual)
            ->first();

        $cursosDeEseAñoC = Catedra::where('idGrado', $fichaMatricula->idGrado)
            ->where('idNivel', $fichaMatricula->idNivel)
            ->where('idSeccion', $fichaMatricula->idSeccion)
            ->where('añoEscolar', $añoEscolarActual)
            ->get();


        return view('pages.roleApoderado.index', compact('añoEscolarActual', 'cursosDeEseAñoC', 'fichaMatricula'));
    }

    public function irANotas(Request $request, $codigoAlumno)
    {
        $bimestre = $request->input('bimestre', '1');
        $añoEscolar = $request->input('añoEscolar');
        $codigoDocente = $request->input('codigoDocente');
        $idAsignatura = $request->input('idAsignatura');
        
        $fichaDeNotas = FichaNotas::where('codigo_Docente', $codigoDocente)
            ->where('idAsignatura', $idAsignatura)
            ->where('periodo', $bimestre)
            ->where('añoEscolar', $añoEscolar)
            ->first();

        
        if (!$fichaDeNotas) {
            return redirect()->back()->withErrors(['error' => 'No se encontraron notas para este docente y asignatura.']);
        }// Retornar una vista con las notas
    
        $detallesDeNotas = DetalleNotas::where('idFicha', $fichaDeNotas->idFicha)
            ->where('codigoAlumno', $codigoAlumno)
            ->get();

        
        return view('pages.roleApoderado.notas', compact('fichaDeNotas', 'detallesDeNotas', 'bimestre'));
    }

    public function todasNotas(Request $request, $codigoAlumno)
    {
        $añoEscolarActual = "2024";
        $periodo = $request->input('periodo', '1');
    
        // Obtener ficha de matrícula del alumno
        $fichaMatricula = FichaMatriculas::where('codigoAlumno', $codigoAlumno)
            ->where('añoEscolar', $añoEscolarActual)
            ->first();
    
        if (!$fichaMatricula) {
            return response()->json(['error' => 'Ficha de matrícula no encontrada'], 404);
        }
    
        // Obtener los cursos correspondientes al grado, nivel y sección
        $cursosDeEseAñoC = Catedra::where('idGrado', $fichaMatricula->idGrado)
            ->where('idNivel', $fichaMatricula->idNivel)
            ->where('idSeccion', $fichaMatricula->idSeccion)
            ->where('añoEscolar', $añoEscolarActual)
            ->get();

    
        // Inicializar el array de notas de los cursos
        $notas_cursos = [];
    
        foreach ($cursosDeEseAñoC as $curso) {
            $idAsignatura = $curso->idAsignatura;
            $codigoDocente = $curso->codigo_docente;

            $fichaNota = FichaNotas::where('codigo_docente', $codigoDocente)
                ->where('idAsignatura', $idAsignatura)
                ->where('periodo', $periodo)
                ->where('añoEscolar', $añoEscolarActual)
                ->where('periodo', $periodo)
                ->where('idSeccion', $fichaMatricula->idSeccion)
                ->first();
            
            // Obtener las notas de las capacidades relacionadas a este curso
            $notasCapacidades = NotaCapacidad::where('codigoAlumno', $codigoAlumno)
                ->where('idFicha', $fichaNota->idFicha)
                ->where('idAsignatura', $idAsignatura)
                ->where('codigo_Docente', $codigoDocente)
                ->get();
            
            // Construir un array de las capacidades con sus nombres y notas
            $notas_capacidad = $notasCapacidades->map(function ($notaCapacidad) {
                return [
                    'nombre_capacidad' => $notaCapacidad->capacidad->abreviatura ?? 'N/A', // Asegúrate de que la relación 'capacidad' devuelva un nombre
                    'nota' => $notaCapacidad->nota,
                ];
            });
    
            // Agregar el curso con sus notas al array de resultados
            $notas_cursos[] = [
                'nombre_curso' => $curso->asignatura->nombreAsignatura ?? 'Curso sin nombre', // Asume que el modelo Catedra tiene un campo 'nombre'
                'notas_capacidad' => $notas_capacidad,
            ];
        }
    
        return view('pages.roleApoderado.resumen_notas', compact('notas_cursos', 'añoEscolarActual', 'periodo', 'codigoAlumno'));
    }

    public function reporteDeNotas(Request $request, $codigoAlumno){
         // Obtener el año escolar seleccionado o el más alto por defecto
        $selectedAnioEscolar = $request->input('añoEscolar', FichaMatriculas::where('codigoAlumno', $codigoAlumno)
         ->max('añoEscolar'));
        //quiero obtener los años escolares donde el alumno estuvo matriculado
        $añosEscolares = FichaMatriculas::where('codigoAlumno', $codigoAlumno)
            ->distinct('añoEscolar')
            ->pluck('añoEscolar');

        $fichaMatricula = FichaMatriculas::where('codigoAlumno', $codigoAlumno);

        $cursosDeEseAñoC = Catedra::where('idGrado', $fichaMatricula->idGrado)
            ->where('idNivel', $fichaMatricula->idNivel)
            ->where('añoEscolar', $selectedAnioEscolar)
            ->get();

        // cada curso tiene su ficha de notas quiero hacer un foreach para obtener las notas de cada curso
        
    }
}