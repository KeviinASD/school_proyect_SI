<?php

namespace App\Http\Controllers;

use App\Models\TipoDocente;
use Illuminate\Http\Request;

class TipoDocenteController extends Controller
{
    public function index()
    {
        $tiposDocentes = TipoDocente::all();
        return view('tiposDocente.index', compact('tiposDocentes'));
    }

    public function create()
    {
        return view('tiposDocentes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombreTipo' => 'required|string|max:255',
        ]);

        TipoDocente::create($request->all());

        return redirect()->route('tipos-docentes.index')
            ->with('success', 'Tipo de docente creado exitosamente.');
    }

    public function edit(TipoDocente $tipoDocente)
    {
        return view('tiposDocentes.edit', compact('tipoDocente'));
    }

    public function update(Request $request, TipoDocente $tipoDocente)
    {
        $request->validate([
            'nombreTipo' => 'required|string|max:255',
        ]);

        $tipoDocente->update($request->all());

        return redirect()->route('tipos-docentes.index')
            ->with('success', 'Tipo de docente actualizado exitosamente.');
    }

    public function destroy(TipoDocente $tipoDocente)
    {
        $tipoDocente->delete();

        return redirect()->route('tipos-docentes.index')
            ->with('success', 'Tipo de docente eliminado exitosamente.');
    }
}
