<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Nivel;
use Illuminate\Http\Request;

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
            'idNivel' => 'required|exists:niveles,idNivel',
        ]);

        Curso::create($request->all());

        return redirect()->route('cursos.index')->with('success', 'Curso creado correctamente.');
    }

    public function edit($idCurso)
    {
        $curso = Curso::findOrFail($idCurso); // Utiliza findOrFail para buscar por idCurso
        $niveles = Nivel::all(); // Esto supone que tienes un modelo Nivel para acceder a los niveles

        return view('cursos.edit', compact('curso', 'niveles'));
    }

    public function update(Request $request, $idCurso)
    {
        $request->validate([
            'nombreCurso' => 'required|max:50',
            'idNivel' => 'required|exists:niveles,idNivel',
        ]);

        $curso = Curso::findOrFail($idCurso);
        $curso->update($request->all());

        return redirect()->route('cursos.index')->with('success', 'Curso actualizado correctamente');
    }
    
    public function destroy($idCurso)
    {
        $curso = Curso::findOrFail($idCurso);
        $curso->delete();

        return redirect()->route('cursos.index')
            ->with('success', 'Curso eliminado correctamente');
    }
        

}
