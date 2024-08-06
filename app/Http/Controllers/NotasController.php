<?php

namespace App\Http\Controllers;

use App\Models\DocenteProvicional;
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

    public function registro($codigo_Docente)
    {
        $docente = DocenteProvicional::where('codigo_Docente', $codigo_Docente)->where('estado', 1)->first();
        
        if (!$docente) {
            return redirect()->route('notas.index');
        }

        $catedras = DB::table('CATEDRAS as c')
                    ->join('ASIGNATURAS as a', 'c.idAsignatura', '=', 'a.idAsignatura')
                    ->where('codigo_docente', $codigo_Docente)->get();


        return view('pages.notas.registro', compact('docente', 'catedras'));
    }

    
}
