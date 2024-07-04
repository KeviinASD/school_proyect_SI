<?php

namespace App\Http\Controllers;

use App\Models\Nivel;
use Illuminate\Http\Request;

class NivelesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $niveles = Nivel::all();
        return view('pages.gradosYSecciones.nivel_index', compact('niveles'));
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
        $request->validate([
            'nombreNivel' => 'required'
        ]);

        Nivel::create($request->all());
        return redirect()->route('grados.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Nivel $nivel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nivel $nivel)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $idNivel)
    {
        $data = $request->validate([
            'nombreNivel' => 'required'
        ]);

        Nivel::where('idNivel', $idNivel)->update($data);
        return redirect()->route('grados.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nivel $nivel)
    {
        //
    }
}
