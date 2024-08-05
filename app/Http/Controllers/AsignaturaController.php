<?php
namespace App\Http\Controllers;

use App\Models\Asignatura;
use App\Models\Curso;
use App\Models\Grado;
use App\Models\Nivel;
use Illuminate\Http\Request;

class AsignaturaController extends Controller
{
    public function index()
    {
        $asignaturas = Asignatura::all();
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
        $validatedData = $request->validate([
            'idCurso' => 'required',
            'idGrado' => 'required',
            'idNivel' => 'required',
            'estado' => 'nullable',
        ]);

        Asignatura::create($validatedData);

        return redirect()->route('asignaturas.index')->with('success', 'Asignatura creada exitosamente.');
    }

    public function edit(Asignatura $asignatura)
    {
        $cursos = Curso::all();
        $grados = Grado::all();
        $niveles = Nivel::all();
        return view('asignaturas.edit', compact('asignatura', 'cursos', 'grados', 'niveles'));
    }

    public function update(Request $request, Asignatura $asignatura)
    {
        $validatedData = $request->validate([
            'idCurso' => 'required',
            'idGrado' => 'required',
            'idNivel' => 'required',
            'estado' => 'nullable',
        ]);

        $asignatura->update($validatedData);

        return redirect()->route('asignaturas.index')->with('success', 'Asignatura actualizada exitosamente.');
    }

    public function destroy(Asignatura $asignatura)
    {
        $asignatura->delete();
        return redirect()->route('asignaturas.index')->with('success', 'Asignatura eliminada exitosamente.');
    }
}
