<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Nivel;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index()
    {
        // Obtén solo los cursos activos
        $cursos = Curso::where('estado', 1)->get();
        return view('pages.cursos.index', compact('cursos'));
    }

    public function create()
    {
        // Obtener niveles para la vista de creación
        $niveles = Nivel::all();
        return view('pages.cursos.create', compact('niveles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombreCurso' => 'required|string|max:255|unique:cursos,nombreCurso',
        ], [
            'nombreCurso.unique' => 'El nombre del curso ya existe.',
        ]);

        try {
            Curso::create([
                'nombreCurso' => $validated['nombreCurso'],
                'estado' => 1,
            ]);
            return redirect()->route('cursos.index')->with('success', 'Curso creado exitosamente.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('cursos.index')
                ->with('error', 'Error al crear el curso. Inténtalo de nuevo.');
        }
    }
    public function edit($idCurso)
    {
        $curso = Curso::findOrFail($idCurso);
        $niveles = Nivel::all(); // Obtener niveles para la vista de edición
        return view('pages.cursos.edit', compact('curso', 'niveles'));
    }

    public function update(Request $request, $idCurso)
    {
        $request->validate([
            'nombreCurso' => 'required|max:255|unique:cursos,nombreCurso,' . $idCurso . ',idCurso',
        ], [
            'nombreCurso.unique' => 'El nombre del curso ya existe.',
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
