<?php
namespace App\Http\Controllers;

use App\Models\Capacidad;
use App\Models\Asignatura;
use App\Models\Curso;
use Illuminate\Http\Request;

class CapacidadController extends Controller
{
    public function index()
    {
        $capacidades = Capacidad::all();
        return view('capacidades.index', compact('capacidades'));
    }

    public function create()
    {
        $asignaturas = Asignatura::all();
        $cursos = Curso::all();
        return view('capacidades.create', compact('asignaturas', 'cursos'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'idAsignatura' => 'required',
            'idCurso' => 'required',
            'descripcion' => 'required',
            'abreviatura' => 'nullable',
            'orden' => 'nullable|integer',
            'estado' => 'nullable',
        ]);

        Capacidad::create($validatedData);

        return redirect()->route('capacidades.index')->with('success', 'Capacidad creada exitosamente.');
    }

    public function edit(Capacidad $capacidad)
    {
        $asignaturas = Asignatura::all();
        $cursos = Curso::all();
        return view('capacidades.edit', compact('capacidad', 'asignaturas', 'cursos'));
    }

    public function update(Request $request, Capacidad $capacidad)
    {
        $validatedData = $request->validate([
            'idAsignatura' => 'required',
            'idCurso' => 'required',
            'descripcion' => 'required',
            'abreviatura' => 'nullable',
            'orden' => 'nullable|integer',
            'estado' => 'nullable',
        ]);

        $capacidad->update($validatedData);

        return redirect()->route('capacidades.index')->with('success', 'Capacidad actualizada exitosamente.');
    }

    public function destroy(Capacidad $capacidad)
    {
        $capacidad->delete();
        return redirect()->route('capacidades.index')->with('success', 'Capacidad eliminada exitosamente.');
    }
}
