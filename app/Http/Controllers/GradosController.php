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
        $niveles = Nivel::all();
        return view('pages.gradosYSecciones.grado_create', compact('niveles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombreGrado' => 'required',
            'idNivel' => 'required',
        ]);
        //Creamos nuevo grado
        $grado = new Grado();
        $grado->nombreGrado = $validatedData['nombreGrado'];
        $grado->idNivel = $validatedData['idNivel'];
        $grado->save();

        return redirect()->route('grados.index')->with('success', 'Grado creado exitosamente');
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
    public function edit($idGrado)
    {
        $grado = Grado::find($idGrado);
        $niveles = Nivel::all();
        return view('pages.gradosYSecciones.grado_edit', compact('grado', 'niveles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $idGrado)
    {
        $validatedData = $request->validate([
            'nombreGrado' => 'required',
            'idNivel' => 'required',
        ]);

        $grado = Grado::findOrFail($idGrado);
        $grado->nombreGrado = $validatedData['nombreGrado'];
        $grado->idNivel = $validatedData['idNivel'];
        $grado->save();

        return redirect()->route('grados.index')->with('success', 'Grado actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grado $grado)
    {
        //
    }

    public function getGradosByNivel($nivelId)
    {
        $grados = Grado::where('idNivel', $nivelId)->get();
        return response()->json(['grados' => $grados]);
    }
}
