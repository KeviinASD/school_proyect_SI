<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FichaMatriculas;
use App\Models\AñoEscolar;
use App\Models\AñoEscolarActual;
use App\Models\Nivel;
use App\Models\Grado;
use App\Models\Seccion;

class AlumnosMatriculadosController extends Controller
{
    public function index(Request $request)
    {

        $nameNivel = '';
        $nameGrado = '';
        $nameSeccion = '';

        $añoActual = AñoEscolarActual::first()->año_escolar_id;
        $idNivel = $request->input('idNivel') ? $request->input('idNivel') : -1;
        $idGrado = $request->input('idGrado') ? $request->input('idGrado') : -1;
        $idSeccion = $request->input('idSeccion') ? $request->input('idSeccion') : -1;


        $query = FichaMatriculas::query();
        $query->where('añoEscolar', $añoActual);        

        if ($idNivel != -1) {
            $query->whereHas('nivel', function ($q) use ($idNivel) {
                $q->where('idNivel', $idNivel);
            });
            $nameNivel = Nivel::find($idNivel)->nombreNivel;
        }

        if ($idGrado != -1) {
            $query->whereHas('grado', function ($q) use ($idGrado) {
                $q->where('idGrado', $idGrado);
            });
            $nameGrado = Grado::find($idGrado)->nombreGrado;
        }

        if ($idSeccion != -1) {
            $query->whereHas('seccion', function ($q) use ($idSeccion) {
                $q->where('idSeccion', $idSeccion);
            });
            $nameSeccion = Seccion::find($idSeccion)->nombreSeccion;
        }

        $fichasMatriculas = $query->get();

        $niveles = Nivel::all();
        $grados = Grado::all();
        $secciones = Seccion::all();



        return view('pages.alumnosMatriculados.index', compact('fichasMatriculas', 'añoActual', 'niveles', 'grados', 'secciones', 'nameNivel', 'nameGrado', 'nameSeccion', 'idNivel', 'idGrado', 'idSeccion'));
    }

    public function reporte(Request $request, $idNivel, $idGrado, $idSeccion)
    {
        // Obtener el año escolar actual
        $añoActual = AñoEscolarActual::first()->año_escolar_id;
    
        if (!$añoActual) {
            return redirect()->back()->with('error', 'No se ha configurado un año escolar actual.');
        }
    
        // Construir la consulta
        $query = FichaMatriculas::query();
        $query->where('añoEscolar', $añoActual);


        if ($idNivel != -1) {
            $query->whereHas('nivel', function ($q) use ($idNivel) {
                $q->where('idNivel', $idNivel);
            });
        }

        if ($idGrado != -1) {
            $query->whereHas('grado', function ($q) use ($idGrado) {
                $q->where('idGrado', $idGrado);
            });
        }
        if ($idSeccion != -1) {
            $query->whereHas('seccion', function ($q) use ($idSeccion) {
                $q->where('idSeccion', $idSeccion);
            });
        }
    
        // Cargar relaciones necesarias para optimizar consultas
        $fichasMatriculas = $query->get();
    
        if ($fichasMatriculas->isEmpty()) {
            return redirect()->back()->with('warning', 'No se encontraron alumnos matriculados para los parámetros seleccionados.');
        }
    
        // Retornar la vista con los datos del reporte
        return view('pages.alumnosMatriculados.reporte', compact('fichasMatriculas', 'añoActual', 'idNivel', 'idGrado', 'idSeccion'));
    }
    
}
