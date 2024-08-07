<?php

namespace App\Http\Controllers;

use App\Models\Catedra;
use App\Models\DocenteProvicional;
use App\Models\FichaNotas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotasController extends Controller
{

    const PAGINATION = 10;

    public function index()
    {
        $docentes = DocenteProvicional::where('estado', 1)->paginate(self::PAGINATION);
        return view('pages.notas.index', compact('docentes'));
    }

    public function registro(Request $request, $codigo_Docente)
    {
        $docente = DocenteProvicional::where('codigo_Docente', $codigo_Docente)->where('estado', 1)->first();
        
        if (!$docente) {
            return redirect()->route('notas.index');
        }

        // Obtener años escolares únicos
        $añosEscolares = Catedra::select('añoEscolar')
        ->distinct()
        ->orderBy('añoEscolar', 'desc') // Ordenar de mayor a menor
        ->pluck('añoEscolar');
        
        $query = Catedra::where('codigo_docente', $codigo_Docente)->where('estado', 1);

        // Filtrar por añoEscolar si se pasa como parámetro
        if ($request->has('añoEscolar') && $request->añoEscolar != '') {
            $query->where('añoEscolar', $request->añoEscolar);
        }

        $catedras = $query->get(); // Puedes usar paginate() si lo necesitas

        return view('pages.notas.registro', compact('docente', 'catedras', 'añosEscolares'));
    }

    public function crear_ficha_notas(Request $request, $idCatedra)
    {
        $catedra = Catedra::where('idCatedra', $idCatedra)->where('estado', 1)->first();
        
        if (!$catedra) {
            return redirect()->route('notas.index');
        }
    
        // Buscar si ya existen las fichas para los tres periodos
        $fichas = FichaNotas::where('idAsignatura', $catedra->idAsignatura)
            ->where('idCurso', $catedra->idCurso)
            ->where('codigo_Docente', $catedra->codigo_docente)
            ->where('añoEscolar', $catedra->añoEscolar)
            ->where('estado', 1)
            ->get();
    
        if ($fichas->count() === 3) {
            // Si ya existen las fichas, guardarlas en la sesión
            session([
                'ficha1' => $fichas->where('periodo', 1)->first()->idFicha,
                'ficha2' => $fichas->where('periodo', 2)->first()->idFicha,
                'ficha3' => $fichas->where('periodo', 3)->first()->idFicha,
            ]);
    
            return redirect()->route('detalle-notas.index');
        } else {
            // Crear los tres periodos de la ficha de notas
            $ficha1 = FichaNotas::create([
                'idAsignatura' => $catedra->idAsignatura,
                'idCurso' => $catedra->idCurso,
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
                'idCurso' => $catedra->idCurso,
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
                'idCurso' => $catedra->idCurso,
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
