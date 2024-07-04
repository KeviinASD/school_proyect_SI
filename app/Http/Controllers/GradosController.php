<?php

namespace App\Http\Controllers;

use App\Models\Grado;
use App\Models\Nivel;
use Illuminate\Http\Request;

class GradosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $niveles = Nivel::all();
        $query = Grado::query(); 

        if ($request->has('nivel_id') && $request->nivel_id != '') {
            $query->where('idNivel', $request->nivel_id);
        }

        $grados = $query->get();

        return view('pages.gradosYSecciones.grado_index', compact('grados', 'niveles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Grado $grado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grado $grado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Grado $grado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grado $grado)
    {
        //
    }
}
