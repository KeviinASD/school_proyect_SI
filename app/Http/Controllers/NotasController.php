<?php

namespace App\Http\Controllers;

use App\Models\AñoEscolarActual;
use App\Models\Catedra;
use App\Models\DocenteProvicional;
use App\Models\FichaNotas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotasController extends Controller
{

    const PAGINATION = 10;

    public function index(Request $request)
    {
        $query = Catedra::where('estado', 1);
        $añoEscolarActual = AñoEscolarActual::first()->año_escolar_id;

        $query->where('añoEscolar', $añoEscolarActual);
    
        $docenteCodes = $query->pluck('codigo_docente')->unique();
        
        $docentes = DocenteProvicional::whereIn('codigo_docente', $docenteCodes)->paginate(self::PAGINATION);
    
        return view('pages.notas.index', compact('docentes', 'añoEscolarActual'));
    }
                                    
    public function registro(Request $request, $codigo_Docente)
    {
        $docente = DocenteProvicional::where('codigo_Docente', $codigo_Docente)->where('estado', 1)->first();
        
        if (!$docente) {
            return redirect()->route('notas.index');
        }

        // Obtener años escolares únicos
        // Obtener años escolares únicos en los que ha trabajado el docente

        $añoEscolarActual = AñoEscolarActual::first()->año_escolar_id;
        $query = Catedra::where('codigo_docente', $codigo_Docente)->where('estado', 1);
        $query->where('añoEscolar', $añoEscolarActual);
        // Filtrar por añoEscolar si se pasa como parámetro

        $catedras = $query->get(); // Puedes usar paginate() si lo necesitas

        return view('pages.notas.registro', compact('docente', 'catedras', 'añoEscolarActual'));
    }

    public function crear_ficha_notas(Request $request, $idCatedra)
    {
        $catedra = Catedra::where('idCatedra', $idCatedra)->where('estado', 1)->first();
        
        if (!$catedra) {
            return redirect()->route('notas.index');
        }
    
        // Buscar si ya existen las fichas para los tres periodos
        $fichas = FichaNotas::where('idAsignatura', $catedra->idAsignatura)
            ->where('codigo_Docente', $catedra->codigo_docente)
            ->where('añoEscolar', $catedra->añoEscolar)
            ->where('estado', 1)
            ->get();

    
        if ($fichas->count() === 3) {
            // Si ya existen las fichas, guardarlas en la sesión

            $ficha1 = $fichas->where('periodo', 1)->first();
            $ficha2 = $fichas->where('periodo', 2)->first();
            $ficha3 = $fichas->where('periodo', 3)->first();

            session([
                'ficha1' => $ficha1->idFicha,
                'ficha2' => $ficha2->idFicha,
                'ficha3' => $ficha3->idFicha,
            ]);

            return redirect()->route('detalle-notas.index');
        } else {
            // Crear los tres periodos de la ficha de notas
            $ficha1 = FichaNotas::create([
                'idAsignatura' => $catedra->idAsignatura,
                'codigo_Docente' => $catedra->codigo_docente,
                'fecha' => now(),
                'idSeccion' => $catedra->idSeccion,
                'idGrado' => $catedra->idGrado,
                'idNivel' => $catedra->idNivel,
                'añoEscolar' => $catedra->añoEscolar,
                'periodo' => 1,
                'estado' => 1
            ]);
    
            $ficha2 = FichaNotas::create([
                'idAsignatura' => $catedra->idAsignatura,
                'codigo_Docente' => $catedra->codigo_docente,
                'fecha' => now(),
                'idSeccion' => $catedra->idSeccion,
                'idGrado' => $catedra->idGrado,
                'idNivel' => $catedra->idNivel,
                'añoEscolar' => $catedra->añoEscolar,
                'periodo' => 2,
                'estado' => 1
            ]);
    
            $ficha3 = FichaNotas::create([
                'idAsignatura' => $catedra->idAsignatura,
                'codigo_Docente' => $catedra->codigo_docente,
                'fecha' => now(),
                'idSeccion' => $catedra->idSeccion,
                'idGrado' => $catedra->idGrado,
                'idNivel' => $catedra->idNivel,
                'añoEscolar' => $catedra->añoEscolar,
                'periodo' => 3,
                'estado' => 1
            ]);
    
            // Guardar los nuevos objetos en la sesión
            session([
                'ficha1' => $ficha1->idFicha,
                'ficha2' => $ficha2->idFicha,
                'ficha3' => $ficha3->idFicha,
            ]);

    
            return redirect()->route('detalle-notas.index');
        }
    }

    
}
