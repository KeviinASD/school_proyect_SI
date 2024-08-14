<?php

namespace App\Http\Controllers;

use App\Models\AnioEscolar;
use App\Models\AñoEscolar;
use Illuminate\Http\Request;

class AnioEscolarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aniosEscolares = AñoEscolar::all();
        return view('anioEscolar.index', compact('aniosEscolares'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('anioEscolar.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'anioEscolar' => 'required|string|max:10|unique:AÑO_ESCOLAR,anioEscolar',
        ]);

        AñoEscolar::create([
            'anioEscolar' => $request->input('anioEscolar'),
        ]);

        return redirect()->route('anioEscolar.index')->with('success', 'Año Escolar creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AñoEscolar $anioEscolar)
    {
        return view('anioEscolar.show', compact('anioEscolar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AñoEscolar $anioEscolar)
    {
        return view('anioEscolar.edit', compact('anioEscolar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AñoEscolar $anioEscolar)
    {
        $request->validate([
            'anioEscolar' => 'required|string|max:10|unique:AÑO_ESCOLAR,anioEscolar,' . $anioEscolar->anioEscolar,
        ]);

        $anioEscolar->update([
            'anioEscolar' => $request->input('anioEscolar'),
        ]);

        return redirect()->route('anioEscolar.index')->with('success', 'Año Escolar actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AñoEscolar $anioEscolar)
    {
        $anioEscolar->delete();

        return redirect()->route('anioEscolar.index')->with('success', 'Año Escolar eliminado exitosamente.');
    }
}
