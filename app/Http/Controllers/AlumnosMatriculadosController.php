<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FichaMatriculas;
use App\Models\AñoEscolar;
use App\Models\Nivel;
use App\Models\Grado;
use App\Models\Seccion;

class AlumnosMatriculadosController extends Controller
{
    public function index(Request $request)
    {
        $añoEscolar = $request->input('añoEscolar');
        $idNivel = $request->input('idNivel');
        $idGrado = $request->input('idGrado');
        $idSeccion = $request->input('idSeccion');

        $query = FichaMatriculas::query();

        if ($añoEscolar) {
            $query->where('añoEscolar', $añoEscolar);
        }

        if ($idNivel) {
            $query->whereHas('nivel', function ($q) use ($idNivel) {
                $q->where('idNivel', $idNivel);
            });
        }

        if ($idGrado) {
            $query->whereHas('grado', function ($q) use ($idGrado) {
                $q->where('idGrado', $idGrado);
            });
        }

        if ($idSeccion) {
            $query->whereHas('seccion', function ($q) use ($idSeccion) {
                $q->where('idSeccion', $idSeccion);
            });
        }

        $fichasMatriculas = $query->get();

        $añosEscolares = AñoEscolar::all();
        $niveles = Nivel::all();
        $grados = Grado::all();
        $secciones = Seccion::all();

        return view('pages.alumnosMatriculados.index', compact('fichasMatriculas', 'añosEscolares', 'niveles', 'grados', 'secciones'));
    }
}
