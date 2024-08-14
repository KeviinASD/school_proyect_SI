<?php

namespace App\Http\Controllers;

use App\Models\Catedra;
use App\Models\Seccion;
use App\Models\Grado;
use App\Models\Nivel;
use App\Models\Asignatura;
use App\Models\AñoEscolar;
use App\Models\Docente;
use App\Models\DocenteProvicional;
use Illuminate\Http\Request;

class CatedraController extends Controller
{
    public function index()
    {
        $catedras = Catedra::where('estado', 1)->get();
        return view('pages.catedras.index', compact('catedras'));
    }

    public function create()
    {
        $docentes = DocenteProvicional::where('estado', 1)->get();
        $secciones = Seccion::where('estado', 1)->get();
        $grados = Grado::where('estado', 1)->get();
        $niveles = Nivel::where('estado', 1)->get();
        $asignaturas = Asignatura::where('estado', 1)->get();
        $añosEscolares = AñoEscolar::where('estado', 1)->get();

        return view('pages.catedras.create', compact('docentes', 'secciones', 'grados', 'niveles', 'asignaturas', 'añosEscolares'));
    }

    public function buscarDocente(Request $request)
    {
        $codigoDocente = $request->input('codigo_docente');

        $docente = DocenteProvicional::where('codigo_docente', $codigoDocente)
            ->where('estado', 1) // Solo buscar docentes activos
            ->first();

        if ($docente) {
            return response()->json([
                'success' => true,
                'nombre_docente' => $docente->nombres . ' ' . $docente->apellidos
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No se encontró el docente con el código proporcionado.'
            ]);
        }
    }

    public function store(Request $request)
    {
        // Validar la solicitud
        $validated = $request->validate([
            'codigo_docente' => 'required|string',
            'idSeccion' => 'required|integer',
            'idGrado' => 'required|integer',
            'idNivel' => 'required|integer',
            'idAsignatura' => 'required|integer',
            'añoEscolar' => 'required|string',
        ]);

        // Verificar si ya existe una cátedra con el mismo docente, sección y asignatura
        $exists = Catedra::where('codigo_docente', $validated['codigo_docente'])
            ->where('idSeccion', $validated['idSeccion'])
            ->where('idAsignatura', $validated['idAsignatura'])
            ->where('estado', 1) // Solo verificar las cátedras activas
            ->exists();

        if ($exists) {
            return redirect()->back()->withInput()->withErrors([
                'codigo_docente' => 'El docente ya está asignado a la misma asignatura en esta sección.'
            ]);
        }

        // Crear la nueva cátedra
        $catedra = new Catedra();
        $catedra->codigo_docente = $validated['codigo_docente'];
        $catedra->idSeccion = $validated['idSeccion'];
        $catedra->idGrado = $validated['idGrado'];
        $catedra->idNivel = $validated['idNivel'];
        $catedra->idAsignatura = $validated['idAsignatura'];
        $catedra->añoEscolar = $validated['añoEscolar'];
        $catedra->estado = 1; // Asegúrate de establecer el estado a 1
        $catedra->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('catedras.index')->with('success', 'Cátedra creada exitosamente.');
    }

    public function edit($id)
    {
        $catedra = Catedra::findOrFail($id);
        $docentes = Docente::all();
        $niveles = Nivel::all();
        $grados = Grado::all(); // Asegúrate de que esto devuelva todos los grados
        $secciones = Seccion::all(); // Asegúrate de que esto devuelva todas las secciones
        $asignaturas = Asignatura::all(); // Asegúrate de que esto devuelva todas las asignaturas
        $añosEscolares = AñoEscolar::all();
    
        return view('pages.catedras.edit', compact('catedra', 'docentes', 'niveles', 'grados', 'secciones', 'asignaturas', 'añosEscolares'));
    }

    public function update(Request $request, $id)
    {
        // Validar la solicitud
        $validated = $request->validate([
            'codigo_docente' => 'required|string',
            'idSeccion' => 'required|integer',
            'idGrado' => 'required|integer',
            'idNivel' => 'required|integer',
            'idAsignatura' => 'required|integer',
            'añoEscolar' => 'required|string',
        ]);

        // Obtener la cátedra que se está editando
        $catedra = Catedra::find($id);

        // Verificar si ya existe una cátedra con el mismo docente, sección y asignatura, excluyendo la cátedra actual
        $exists = Catedra::where('codigo_docente', $validated['codigo_docente'])
            ->where('idSeccion', $validated['idSeccion'])
            ->where('idAsignatura', $validated['idAsignatura'])
            ->where('estado', 1) // Solo verificar las cátedras activas
            ->where('idCatedra', '<>', $id) // Excluir la cátedra actual
            ->exists();

        if ($exists) {
            return redirect()->back()->withInput()->withErrors([
                'codigo_docente' => 'El docente ya está asignado a la misma asignatura en esta sección.'
            ]);
        }

        // Actualizar la cátedra
        $catedra->codigo_docente = $validated['codigo_docente'];
        $catedra->idSeccion = $validated['idSeccion'];
        $catedra->idGrado = $validated['idGrado'];
        $catedra->idNivel = $validated['idNivel'];
        $catedra->idAsignatura = $validated['idAsignatura'];
        $catedra->añoEscolar = $validated['añoEscolar'];
        $catedra->estado = 1; // Asegúrate de mantener el estado
        $catedra->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('catedras.index')->with('success', 'Cátedra actualizada exitosamente.');
    }

    public function destroy($id)
    {
        // Encuentra el registro por ID
        $catedra = Catedra::findOrFail($id);

        // Cambia el estado a 0 en lugar de eliminar el registro
        $catedra->estado = 0;
        $catedra->save();

        // Redirige con un mensaje de éxito
        return redirect()->route('catedras.index')->with('success', 'Cátedra eliminada correctamente.');
    }

    public function getGradosByNivel($nivelId)
    {
        $grados = Grado::where('idNivel', $nivelId)->where('estado', 1)->get();
        return response()->json($grados);
    }

    public function getSeccionesByGrado($gradoId)
    {
        $secciones = Seccion::where('idGrado', $gradoId)->where('estado', 1)->get();
        return response()->json($secciones);
    }

    // Este método se puede eliminar ya que 'Curso' ya no existe
    // public function getAsignaturasByCurso($cursoId)
    // {
    //     $asignaturas = Asignatura::where('idCurso', $cursoId)->where('estado', 1)->get();
    //     return response()->json($asignaturas);
    // }

    public function getAsignaturasByNivelYGrado($nivelId, $gradoId)
    {
    $asignaturas = Asignatura::where('idNivel', $nivelId) // Asegúrate de que tienes la relación correcta
        ->where('idGrado', $gradoId)
        ->where('estado', 1)
        ->get();

    return response()->json($asignaturas);
    }
}