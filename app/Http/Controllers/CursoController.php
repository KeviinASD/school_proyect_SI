<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Nivel;

class CursoController extends Controller
{
    public function index()
    {
        $cursos = Curso::with('nivel')->get();
        return view('cursos.index', compact('cursos'));
    }

    public function create()
    {
        $niveles = Nivel::all();
        return view('cursos.create', compact('niveles'));
    }

    public function store(Request $request)
{
    $request->validate([
        'nombreCurso' => 'required|string|max:50',
        'idNivel' => 'required|exists:NIVELES,idNivel',
    ]);

    $curso = new Curso();
    $curso->nombreCurso = $request->nombreCurso;
    $curso->idNivel = $request->idNivel;
    $curso->save();

    return redirect()->route('cursos.index')->with('success', 'Curso creado correctamente.');
}
    public function edit($id)
    {
        $curso = Curso::findOrFail($id);
        $niveles = Nivel::all();
        return view('cursos.edit', compact('curso', 'niveles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombreCurso' => 'required|max:50',
            'idNivel' => 'required|exists:niveles,idNivel',
        ]);

        $curso = Curso::findOrFail($id);
        $curso->update($request->all());

        return redirect()->route('cursos.index')
            ->with('success', 'Curso actualizado correctamente');
    }

    public function destroy($id)
    {
        $curso = Curso::findOrFail($id);
        $curso->delete();

        return redirect()->route('cursos.index')
            ->with('success', 'Curso eliminado correctamente');
    }
}
