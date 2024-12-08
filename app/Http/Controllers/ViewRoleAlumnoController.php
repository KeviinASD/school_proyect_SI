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
            ->where('añoEscolar', $añoEscolarActual)
            ->get();


        return view('pages.roleApoderado.index', compact('añoEscolarActual', 'cursosDeEseAñoC', 'fichaMatricula'));
    }

    public function irANotas(Request $request)
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
            ->get();

        
        return view('pages.roleApoderado.notas', compact('fichaDeNotas', 'detallesDeNotas', 'bimestre'));
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