<?php

namespace App\Http\Controllers;

use App\Models\Asignatura;
use Illuminate\Http\Request;
use App\Models\Capacidad;
use App\Models\Curso;

class CapacidadController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('buscarpor');
    
        $capacidadesQuery = Capacidad::with('asignatura')->where('estado', 1);
    
        if ($search) {
            $capacidadesQuery->where(function ($query) use ($search) {
                $query->where('descripcion', 'LIKE', "%{$search}%")
                      // Nueva condición para buscar por nombre de asignatura
                      ->orWhereHas('asignatura', function ($query) use ($search) {
                          $query->where('nombreAsignatura', 'LIKE', "%{$search}%");
                      });
            });
        }
    
        $capacidades = $capacidadesQuery->paginate(8);
        return view('pages.capacidades.index', compact('capacidades'));
    }

    public function create()
    {
        // Obtener todas las asignaturas para el dropdown
        $asignaturas = Asignatura::where('estado', 1)->get();
        
        return view('pages.capacidades.create', compact('asignaturas'));
    }
    public function store(Request $request)
    {
        // Validar los datos
        $validatedData = $request->validate([
            'descripcion' => 'required|string|max:255',
            'abreviatura' => 'required|string|max:10', // Agregar validación para abreviatura
            'idAsignatura' => 'required|integer',
            'orden' => 'required|integer',
            'estado' => 'nullable|boolean'
        ]);
    
        // Establecer el estado por defecto a 1 si no está presente
        if (!isset($validatedData['estado'])) {
            $validatedData['estado'] = 1;
        }
    
        // Verificar si ya existe una capacidad para la asignatura
        $existingCapacidad = Capacidad::where('descripcion', $validatedData['descripcion'])
            ->where('idAsignatura', $validatedData['idAsignatura'])
            ->where('estado', 1)
            ->first();
    
        if ($existingCapacidad) {
            return redirect()->route('capacidades.create')
                ->withErrors(['idAsignatura' => 'Ya existe una capacidad para la asignatura seleccionada.'])
                ->withInput();
        }
    
        // Crear una nueva capacidad si la asignatura es válida
        Capacidad::create($validatedData);
    
        return redirect()->route('capacidades.index')->with('success', 'Capacidad creada correctamente');
    }

    public function edit($id)
    {
        // Obtener la capacidad por su ID
        $capacidad = Capacidad::findOrFail($id);
    
        // Obtener todas las asignaturas para el dropdown
        $asignaturas = Asignatura::where('estado', 1)->get();
    
        // Pasar las variables a la vista
        return view('pages.capacidades.edit', compact('capacidad', 'asignaturas'));
    }
    
    public function update(Request $request, $id)
    {
        // Validar los datos
        $validatedData = $request->validate([
            'descripcion' => 'required|string|max:255',
            'abreviatura' => 'required|string|max:10', // Agregar validación para abreviatura
            'idAsignatura' => 'required|integer',
            'orden' => 'required|integer',
            'estado' => 'nullable|boolean'
        ]);
    
        // Obtener la capacidad por su ID
        $capacidad = Capacidad::findOrFail($id);
    
        // Verificar si ya existe otra capacidad para la misma asignatura
        $existingCapacidad = Capacidad::where('idAsignatura', $validatedData['idAsignatura'])
            ->where('estado', 1)
            ->where('idCapacidad', '!=', $id) // Excluir la capacidad actual
            ->first();
    
        if ($existingCapacidad) {
            return redirect()->route('capacidades.edit', $id)
                ->withErrors(['idAsignatura' => 'Ya existe una capacidad para la asignatura seleccionada.'])
                ->withInput();
        }
    
        // Si la asignatura es válida, actualizar la capacidad con los datos validados
        $capacidad->update([
            'descripcion' => $validatedData['descripcion'],
            'abreviatura' => $validatedData['abreviatura'], // Actualizar el campo de abreviatura
            'idAsignatura' => $validatedData['idAsignatura'],
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

    public function getCapacidadesPorAsignatura($idAsignatura)
    {
        $capacidades = Capacidad::where('idAsignatura', $idAsignatura)->get();
        return response()->json($capacidades);
    }
}
