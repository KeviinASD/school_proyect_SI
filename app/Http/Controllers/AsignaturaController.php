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
        return view('pages.asignaturas.index', compact('asignaturas'));
    }

    public function create()
    {
        $niveles = Nivel::where('estado', 1)->get();
        $cursos = Curso::where('estado', 1)->get();
        return view('pages.asignaturas.create', compact('niveles', 'cursos'));
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

    public function edit($id)
    {
        $asignatura = Asignatura::findOrFail($id);
        $niveles = Nivel::where('estado', 1)->get();
        $cursos = Curso::where('estado', 1)->get();
        return view('pages.asignaturas.edit', compact('asignatura', 'niveles', 'cursos'));
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
        return view('pages.asignaturas.deleted', compact('asignaturas'));
    }

    public function getGradosByNivel($nivelId)
    {
        $grados = Grado::where('idNivel', $nivelId)->where('estado', 1)->get(['idGrado', 'nombreGrado']);
        return response()->json(['grados' => $grados]);
    }
}
