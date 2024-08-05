<?php

namespace App\Http\Controllers;

use App\Models\Catedra;
use Illuminate\Http\Request;

class CatedraController extends Controller
{
    public function index()
    {
        $catedras = Catedra::where('estado', 1)->get();
        return view('catedras.index', compact('catedras'));
    }

    public function create()
    {
        return view('catedras.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'idCatedra' => 'required',
            'codigo_docente' => 'required',
            'idSeccion' => 'required',
            'idGrado' => 'required',
            'idNivel' => 'required',
            'idAsignatura' => 'required',
            'idCurso' => 'required',
            'añoEscolar' => 'required',
        ]);

        Catedra::create($request->all() + ['estado' => 1]);

        return redirect()->route('catedras.index')->with('success', 'Cátedra creada exitosamente.');
    }

    public function edit(Catedra $catedra)
    {
        return view('catedras.edit', compact('catedra'));
    }

    public function update(Request $request, Catedra $catedra)
    {
        $request->validate([
            'idCatedra' => 'required',
            'codigo_docente' => 'required',
            'idSeccion' => 'required',
            'idGrado' => 'required',
            'idNivel' => 'required',
            'idAsignatura' => 'required',
            'idCurso' => 'required',
            'añoEscolar' => 'required',
        ]);

        $catedra->update($request->all());

        return redirect()->route('catedras.index')->with('success', 'Cátedra actualizada exitosamente.');
    }

    public function destroy(Catedra $catedra)
    {
        $catedra->update(['estado' => 0]);
        return redirect()->route('catedras.index')->with('success', 'Cátedra eliminada exitosamente.');
    }
}
