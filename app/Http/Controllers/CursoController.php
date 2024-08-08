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
            'nombreCurso' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    // Verificar si existe un curso activo con el mismo nombre
                    $cursoActivo = Curso::where('nombreCurso', $value)->where('estado', 1)->exists();
                    if ($cursoActivo) {
                        $fail('El nombre del curso ya está en uso por un curso activo.');
                    }

                    // Opcionalmente, puedes informar si el curso está inactivo, si lo deseas
                    $cursoInactivo = Curso::where('nombreCurso', $value)->where('estado', 0)->exists();
                    if ($cursoInactivo) {
                        // Puedes personalizar el mensaje si quieres notificar sobre la existencia de un curso inactivo
                        // En este caso, no hacemos nada para prevenir la creación del curso.
                    }
                },
            ],
        ]);

        try {
            // Crear un nuevo curso con estado 1
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
        $validated = $request->validate([
            'nombreCurso' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) use ($idCurso) {
                    // Verificar si existe un curso activo con el mismo nombre
                    $cursoActivo = Curso::where('nombreCurso', $value)->where('estado', 1)->where('idCurso', '!=', $idCurso)->exists();
                    if ($cursoActivo) {
                        $fail('El nombre del curso ya está en uso por un curso activo.');
                    }

                    // Opcionalmente, puedes informar si el curso está inactivo, si lo deseas
                    $cursoInactivo = Curso::where('nombreCurso', $value)->where('estado', 0)->where('idCurso', '!=', $idCurso)->exists();
                    if ($cursoInactivo) {
                        // Puedes personalizar el mensaje si quieres notificar sobre la existencia de un curso inactivo
                        // En este caso, no hacemos nada para prevenir la edición del curso.
                    }
                },
            ],
        ]);

        try {
            $curso = Curso::findOrFail($idCurso);
            $curso->update([
                'nombreCurso' => $validated['nombreCurso'],
                // Mantener el estado actual del curso
                'estado' => $curso->estado,
            ]);

            return redirect()->route('cursos.index')->with('success', 'Curso actualizado correctamente.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('cursos.index')
                ->with('error', 'Error al actualizar el curso. Inténtalo de nuevo.');
        }
    }

    public function destroy($idCurso)
    {
        $curso = Curso::findOrFail($idCurso);
        $curso->update(['estado' => 0]); // Cambia el estado a inactivo en lugar de eliminar el registro

        return redirect()->route('cursos.index')
            ->with('success', 'Curso desactivado correctamente.');
    }
}
