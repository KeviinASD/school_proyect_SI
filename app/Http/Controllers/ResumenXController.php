<?php

namespace App\Http\Controllers;

use App\Models\Grado;
use App\Models\Nivel;
use App\Models\Seccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\AssignOp\Concat;

class ResumenXController extends Controller
{
    public function index () {
        $niveles = Nivel::where('estado', 1)->get();
        $grados = Grado::where('estado', 1)->get();
        $secciones = Seccion::where('estado', 1)->get();
        

        return view('pages.gradosYSecciones.index', compact('grados', 'niveles', 'secciones'));
    }

    public function welcome() {

         // Recuperar los objetos de la sesión
        $ficha1 = Session::get('ficha1');
        $ficha2 = Session::get('ficha2');
        $ficha3 = Session::get('ficha3');


        return view('welcome', compact('ficha1', 'ficha2', 'ficha3'));
    }
}
