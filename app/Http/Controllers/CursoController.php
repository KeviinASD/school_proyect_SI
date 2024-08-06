<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index()
    {
        // Obtén solo los cursos activos
        $cursos = Curso::where('estado', 1)->get();
        return view('cursos.index', compact('cursos'));
    }

    public function create()
    {
        return view('cursos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombreCurso' => 'required|string|max:255',
        ]);

        try {
            Curso::create([
                'nombreCurso' => $validated['nombreCurso'],
                'estado' => 1, 
            ]);
            return redirect()->route('cursos.index')->with('success', 'Curso creado exitosamente.');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->route('cursos.index')
                    ->with('error', 'Error al crear el curso. Inténtalo de nuevo.');
            }
            return redirect()->route('cursos.index')
                ->with('error', 'Error al crear el curso. Inténtalo de nuevo.');
        }
    }

    public function edit($idCurso)
    {
        $curso = Curso::findOrFail($idCurso);
        return view('cursos.edit', compact('curso'));
    }

    public function update(Request $request, $idCurso)
    {
        $request->validate([
            'nombreCurso' => 'required|max:255',
        ]);

        $curso = Curso::findOrFail($idCurso);
        $curso->update([
            'nombreCurso' => $request->nombreCurso,
            'estado' => $curso->estado, // Mantén el estado actual
        ]);

        return redirect()->route('cursos.index')->with('success', 'Curso actualizado correctamente.');
    }

    public function destroy($idCurso)
    {
        $curso = Curso::findOrFail($idCurso);
        $curso->update(['estado' => 0]); // Cambia el estado a inactivo en lugar de eliminar el registro

        return redirect()->route('cursos.index')
            ->with('success', 'Curso desactivado correctamente.');
    }
}
