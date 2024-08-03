<?php

namespace App\Http\Controllers;

use App\Models\Nivel;
use Illuminate\Http\Request;

class NivelesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PAGINATION = 10;

    public function index()
    {
        $niveles = Nivel::where('estado', 1)->paginate(self::PAGINATION);
        return view('pages.gradosYSecciones.nivel_index', compact('niveles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.gradosYSecciones.nivel_create');
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
        return redirect()->route('niveles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($idNivel)
    {
        $nivel = Nivel::find($idNivel);
        return view('pages.gradosYSecciones.nivel_edit', compact('nivel'));
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
        return redirect()->route('niveles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($idNivel)
    {
        $grado = Nivel::find($idNivel);
        $grado->delete();
        return redirect()->route('niveles.index')->with('success', 'Nivel eliminado exitosamente');
    }
}
