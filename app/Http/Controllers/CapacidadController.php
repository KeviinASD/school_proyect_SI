<?php

namespace App\Http\Controllers;

use App\Models\Asignatura;
use Illuminate\Http\Request;
use App\Models\Capacidad;
use App\Models\Curso;

class CapacidadController extends Controller
{
    public function index()
    {
        // Obtener todas las capacidades activas
        $capacidades = Capacidad::where('estado', 1)->get();
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
        // Validar los datos
        $validatedData = $request->validate([
            'descripcion' => 'required|string|max:255',
            'idAsignatura' => 'required|integer',
            'idCurso' => 'required|integer',
            'orden' => 'required|integer',
            'estado' => 'nullable|boolean'
        ]);

        // Establecer el estado por defecto a 1 si no está presente
        if (!isset($validatedData['estado'])) {
            $validatedData['estado'] = 1;
        }

        // Verificar si la asignatura está en el curso
        $asignatura = Asignatura::where('idAsignatura', $validatedData['idAsignatura'])
            ->where('idCurso', $validatedData['idCurso'])
            ->first();

        if (!$asignatura) {
            // Si la asignatura no está en el curso, redirigir con un mensaje de error
            return redirect()->route('capacidades.create')
                ->withErrors(['idAsignatura' => 'La asignatura no se encuentra dentro del curso.'])
                ->withInput(); // Mantener los datos de entrada
        }

        // Crear una nueva capacidad si la asignatura es válida
        Capacidad::create($validatedData);

        return redirect()->route('capacidades.index')->with('success', 'Capacidad creada correctamente');
    }


    public function edit($id)
    {
        // Obtener la capacidad por su ID
        $capacidad = Capacidad::findOrFail($id);

        // Obtener todas las asignaturas y cursos para el dropdown
        $asignaturas = Asignatura::all();
        $cursos = Curso::all();

        // Pasar las variables a la vista
        return view('asignaturas.edit', compact('capacidad', 'asignaturas', 'cursos'));
    }


    public function update(Request $request, $id)
    {
        // Validar los datos
        $validatedData = $request->validate([
            'descripcion' => 'required|string|max:255',
            'idAsignatura' => 'required|integer',
            'idCurso' => 'required|integer',
            'orden' => 'required|integer',
            'estado' => 'nullable|boolean'
        ]);

        // Obtener la capacidad por su ID
        $capacidad = Capacidad::findOrFail($id);

        // Verificar si la asignatura está en el curso
        $asignatura = Asignatura::where('idAsignatura', $validatedData['idAsignatura'])
            ->where('idCurso', $validatedData['idCurso'])
            ->first();

        if (!$asignatura) {
            // Si la asignatura no está en el curso, redirigir con un mensaje de error
            return redirect()->route('capacidades.edit', $id)
                ->withErrors(['idAsignatura' => 'La asignatura no se encuentra dentro del curso.'])
                ->withInput();
        }

        // Si la asignatura es válida, actualizar la capacidad con los datos validados
        $capacidad->update([
            'descripcion' => $validatedData['descripcion'],
            'idAsignatura' => $validatedData['idAsignatura'],
            'idCurso' => $validatedData['idCurso'],
            'orden' => $validatedData['orden'],
            'estado' => $validatedData['estado'] ?? $capacidad->estado,
        ]);

        return redirect()->route('capacidades.index')->with('success', 'Capacidad actualizada correctamente');
    }


    public function destroy($id)
    {
        // Obtener la capacidad por su ID
        $capacidad = Capacidad::findOrFail($id);

        // Cambiar el estado a 0 (inactivo) en lugar de eliminar
        $capacidad->estado = 0;
        $capacidad->save();

        return redirect()->route('capacidades.index')->with('success', 'Capacidad eliminada correctamente');
    }
}
