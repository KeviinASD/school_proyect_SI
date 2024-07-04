<?php

namespace App\Http\Controllers;

use App\Models\Grado;
use App\Models\Nivel;
use App\Models\Seccion;
use Illuminate\Http\Request;

class SeccionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $secciones = Seccion::all();
        return view('pages.gradosYSecciones.seccion_index', compact('secciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $grados = Grado::all();
        $niveles = Nivel::all();
        return view('pages.gradosYSecciones.seccion_create', compact('grados', 'niveles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombreSeccion' => 'required|string|max:4',
            'idNivel' => 'required|integer|exists:niveles,idNivel',
            'idGrado' => 'required|integer|exists:grados,idGrado'
        ]);

        Seccion::create([
            'nombreSeccion' => $request->input('nombreSeccion'),
            'idNivel' => $request->input('idNivel'),
            'idGrado' => $request->input('idGrado')
        ]);

        return redirect()->route('secciones.index')->with('success', 'Sección creada exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Seccion $seccion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($idSeccion)
    {
        $seccion = Seccion::find($idSeccion);
        $grados = Grado::all();
        $niveles = Nivel::all();
        return view('pages.gradosYSecciones.seccion_edit', compact('seccion', 'grados', 'niveles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $idSeccion)
    {
        $request = $request->validate([
            'nombreSeccion' => 'required',
            'idGrado' => 'required',
            'idNivel' => 'required',
        ]);

        $seccion = Seccion::findOrFail($idSeccion);
        $seccion->nombreSeccion = $request['nombreSeccion'];
        $seccion->idGrado = $request['idGrado'];
        $seccion->idNivel = $request['idNivel'];
        $seccion->save();

        return redirect()->route('secciones.index')->with('success', 'Sección actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($idSeccion)
    {
        $seccion = Seccion::find($idSeccion);
        $seccion->delete();
        return redirect()->route('secciones.index')->with('success', 'Sección eliminada exitosamente');
    }
}
