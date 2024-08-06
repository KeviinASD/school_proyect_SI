<?php

namespace App\Http\Controllers;

use App\Models\Asignatura;
use App\Models\Curso;
use App\Models\Grado;
use App\Models\Nivel;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AsignaturaController extends Controller
{
    public function index()
{
    $asignaturas = Asignatura::with(['curso', 'grado', 'nivel'])->where('estado', 1)->get();
    return view('asignaturas.index', compact('asignaturas'));
}

    public function create()
    {
        $cursos = Curso::all();
        $grados = Grado::all();
        $niveles = Nivel::all();

        return view('asignaturas.create', compact('cursos', 'grados', 'niveles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombreAsignatura' => 'required|string|max:255',
            'idCurso' => 'required|exists:cursos,idCurso',
            'idGrado' => 'required|exists:grados,idGrado',
            'idNivel' => 'required|exists:niveles,idNivel',
        ]);

        // Verifica que el grado pertenece al nivel
        if (!Grado::where('idGrado', $request->input('idGrado'))
            ->where('idNivel', $request->input('idNivel'))
            ->exists()) {
            return redirect()->back()->withErrors([
                'idGrado' => 'El grado seleccionado no existe en el nivel seleccionado.'
            ])->withInput();
        }

        Asignatura::create([
            'nombreAsignatura' => $request->input('nombreAsignatura'),
            'idCurso' => $request->input('idCurso'),
            'idGrado' => $request->input('idGrado'),
            'idNivel' => $request->input('idNivel'),
            'estado' => 1, // Default state
        ]);

        return redirect()->route('asignaturas.index')->with('success', 'Asignatura creada exitosamente.');
    }

    public function edit(Asignatura $asignatura)
    {
        $cursos = Curso::all();
        $grados = Grado::all();
        $niveles = Nivel::all();

        return view('asignaturas.edit', compact('asignatura', 'cursos', 'grados', 'niveles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombreAsignatura' => 'required|string|max:255',
            'idCurso' => 'required|exists:cursos,idCurso',
            'idGrado' => 'required|exists:grados,idGrado',
            'idNivel' => 'required|exists:niveles,idNivel',
        ]);

        // Verifica que el grado pertenece al nivel
        if (!Grado::where('idGrado', $request->input('idGrado'))
            ->where('idNivel', $request->input('idNivel'))
            ->exists()) {
            return redirect()->back()->withErrors([
                'idGrado' => 'El grado seleccionado no existe en el nivel seleccionado.'
            ])->withInput();
        }

        $asignatura = Asignatura::findOrFail($id);

        $asignatura->update([
            'nombreAsignatura' => $request->input('nombreAsignatura'),
            'idCurso' => $request->input('idCurso'),
            'idGrado' => $request->input('idGrado'),
            'idNivel' => $request->input('idNivel'),
        ]);

        return redirect()->route('asignaturas.index')->with('success', 'Asignatura actualizada correctamente.');
    }

    public function destroy(Asignatura $asignatura)
    {
        $asignatura->update(['estado' => 0]);
        return redirect()->route('asignaturas.index')->with('success', 'Asignatura eliminada exitosamente.');
    }

    public function deleted()
    {
        $asignaturas = Asignatura::where('estado', 0)->get();
        return view('asignaturas.deleted', compact('asignaturas'));
    }
}
