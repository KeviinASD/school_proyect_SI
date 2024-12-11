<?php

namespace App\Http\Controllers;

use App\Models\EstadoCivil;
use Illuminate\Http\Request;

class EstadoCivilController extends Controller
{
    public function index()
    {
        $estadosCiviles = EstadoCivil::all();
        return view('estadosCiviles.index', compact('estadosCiviles'));
    }

    public function create()
    {
        return view('estadosCiviles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombreEstadoCivil' => 'required|string|max:255',
        ]);

        EstadoCivil::create($request->all());

        return redirect()->route('estados-civiles.index')
            ->with('success', 'Estado civil creado exitosamente.');
    }

    public function edit(EstadoCivil $estadoCivil)
    {
        return view('estadosCiviles.edit', compact('estadoCivil'));
    }

    public function update(Request $request, EstadoCivil $estadoCivil)
    {
        $request->validate([
            'nombreEstadoCivil' => 'required|string|max:255',
        ]);

        $estadoCivil->update($request->all());

        return redirect()->route('estados-civiles.index')
            ->with('success', 'Estado civil actualizado exitosamente.');
    }

    public function destroy(EstadoCivil $estadoCivil)
    {
        $estadoCivil->delete();

        return redirect()->route('estados-civiles.index')
            ->with('success', 'Estado civil eliminado exitosamente.');
    }
}
