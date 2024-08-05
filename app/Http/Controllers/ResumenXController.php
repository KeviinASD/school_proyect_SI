<?php

namespace App\Http\Controllers;

use App\Models\Grado;
use App\Models\Nivel;
use App\Models\Seccion;
use Illuminate\Http\Request;

class ResumenXController extends Controller
{
    public function index () {
        $niveles = Nivel::where('estado', 1)->get();
        $grados = Grado::where('estado', 1)->get();
        $secciones = Seccion::where('estado', 1)->get();
        

        return view('pages.gradosYSecciones.index', compact('grados', 'niveles', 'secciones'));
    }
}
