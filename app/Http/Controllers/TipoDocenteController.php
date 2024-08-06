<?php

namespace App\Http\Controllers;

use App\Models\TipoDocente;
use Illuminate\Http\Request;

class TipoDocenteController extends Controller
{
    public function index()
    {
        $tiposDocentes = TipoDocente::all();
        return view('pages.tiposDocentes.index', compact('tiposDocentes'));
    }

    public function create()
    {
        return view('pages.tiposDocentes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombreTipo' => 'required|string|max:255',
        ]);

        TipoDocente::create($request->all());

        return redirect()->route('tiposDocentes.index')->with('success', 'Tipo de docente creado exitosamente.');
    }

    public function show(TipoDocente $tipoDocente)
    {
        return view('pages.tiposDocentes.show', compact('tipoDocente'));
    }

    public function edit(TipoDocente $tipoDocente)
    {
        return view('pages.tiposDocentes.edit', compact('tipoDocente'));
    }

    public function update(Request $request, TipoDocente $tipoDocente)
    {
        $request->validate([
            'nombreTipo' => 'required|string|max:255',
        ]);

        $tipoDocente->update($request->all());

        return redirect()->route('tiposDocentes.index')->with('success', 'Tipo de docente actualizado exitosamente.');
    }

    public function destroy(TipoDocente $tipoDocente)
    {
        $tipoDocente->delete();

        return redirect()->route('tiposDocentes.index')->with('success', 'Tipo de docente eliminado exitosamente.');
    }
}
