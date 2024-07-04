<?php

namespace App\Http\Controllers;

use App\Models\Grado;
use App\Models\Nivel;
use App\Models\Seccion;
use Illuminate\Http\Request;

class ResumenXController extends Controller
{
    public function index () {
        $niveles = Nivel::all();
        $grados = Grado::all();
        $secciones = Seccion::all();
        

        return view('pages.gradosYSecciones.index', compact('grados', 'niveles', 'secciones'));
    }
}
