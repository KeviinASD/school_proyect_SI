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

    const PAGINATION = 10;

    public function index(Request $request)
    {
        $niveles = Nivel::where('estado', 1)->get();
        $query = Grado::query(); 
        if ($request->has('nivel_id') && $request->nivel_id != '') {
            $query->where('idNivel', $request->nivel_id);
        }

        $query->where('estado', 1);
        $grados = $query->paginate(self::PAGINATION);

        return view('pages.gradosYSecciones.grado_index', compact('grados', 'niveles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $niveles = Nivel::where('estado', 1)->get();
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
        
        $gradoFound = Grado::where('nombreGrado', $validatedData['nombreGrado'])->where('estado', 1)->where('idNivel', $validatedData['idNivel'])->first();

        if ($gradoFound) {
            return redirect()->route('grados.index')->with('error', 'El grado ya existe');
        }
        
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

        $gradoFound = Grado::where('nombreGrado', $validatedData['nombreGrado'])->where('estado', 1)->first();

        if ($gradoFound) {
            return redirect()->route('grados.index')->with('error', 'El grado ya existe');
        }

        $grado = Grado::findOrFail($idGrado);
        $grado->nombreGrado = $validatedData['nombreGrado'];
        $grado->idNivel = $validatedData['idNivel'];
        $grado->save();

        return redirect()->route('grados.index')->with('success', 'Grado actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($idGrado)
    {
        $grado = Grado::find($idGrado);
        $grado->estado = 0;
        $grado->save();
        return redirect()->route('grados.index')->with('success', 'Grado eliminado exitosamente');
    }

    public function getGradosByNivel($nivelId)
    {
        $grados = Grado::where('idNivel', $nivelId)->where('estado', 1)->get();
        return response()->json(['grados' => $grados]);
    }
}
