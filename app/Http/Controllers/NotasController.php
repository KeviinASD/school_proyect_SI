<?php

namespace App\Http\Controllers;

use App\Models\DocenteProvicional;
use Illuminate\Http\Request;

class NotasController extends Controller
{

    const PAGINATION = 10;
    public function index()
    {
        $docentes = DocenteProvicional::where('estado', 1)->paginate(self::PAGINATION);
        return view('pages.notas.index', compact('docentes'));
    }

    
}
