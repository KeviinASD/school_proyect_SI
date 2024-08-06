<?php

namespace App\Http\Controllers;

use App\Models\TipoDocente;
use Illuminate\Http\Request;

class TipoDocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipoDocentes = TipoDocente::where('estado', 1)->get();
        return view('pages.tipoDocente.index', compact('tipoDocentes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.tipoDocente.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombreTipo' => 'required|string|max:255',
        ]);

        TipoDocente::create(array_merge($request->all(), ['estado' => 1]));

        return redirect()->route('tipoDocente.index')->with('success', 'Tipo de Docente creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $tipoDocente = TipoDocente::where('estado', 1)->findOrFail($id);
        return view('pages.tipoDocente.show', compact('tipoDocente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tipoDocente = TipoDocente::where('estado', 1)->findOrFail($id);
        return view('pages.tipoDocente.edit', compact('tipoDocente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombreTipo' => 'required|string|max:255',
        ]);

        $tipoDocente = TipoDocente::where('estado', 1)->findOrFail($id);
        $tipoDocente->update($request->all());

        return redirect()->route('tipoDocente.index')->with('success', 'Tipo de Docente actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tipoDocente = TipoDocente::findOrFail($id);
        $tipoDocente->update(['estado' => 0]);

        return redirect()->route('tipoDocente.index')->with('success', 'Tipo de Docente eliminado exitosamente.');
    }
}
