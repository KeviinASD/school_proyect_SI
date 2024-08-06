<?php

namespace App\Http\Controllers;

use App\Models\Catedra;
use App\Models\Seccion;
use App\Models\Grado;
use App\Models\Nivel;
use App\Models\Curso;
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
        return view('catedras.index', compact('catedras'));
    }

    // Método para mostrar el formulario de creación
    public function create()
    {
        $docentes = DocenteProvicional::all();
        $secciones = Seccion::all();
        $grados = Grado::all();
        $niveles = Nivel::all();
        $cursos = Curso::all();
        $asignaturas = Asignatura::all();
        $añosEscolares = AñoEscolar::all();

        return view('catedras.create', compact('docentes', 'secciones', 'grados', 'niveles', 'cursos', 'asignaturas', 'añosEscolares'));
    }

    // Método para buscar un docente por código
    public function buscarDocente(Request $request)
    {
        $codigoDocente = $request->input('codigo_docente');

        $docente = DocenteProvicional::where('codigo_docente', $codigoDocente)->first();

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
            'idCurso' => 'required|integer',
            'idAsignatura' => 'required|integer',
            'añoEscolar' => 'required|string',
        ]);

        // Crear la nueva cátedra
        $catedra = new Catedra();
        $catedra->codigo_docente = $validated['codigo_docente'];
        $catedra->idSeccion = $validated['idSeccion'];
        $catedra->idGrado = $validated['idGrado'];
        $catedra->idNivel = $validated['idNivel'];
        $catedra->idCurso = $validated['idCurso'];
        $catedra->idAsignatura = $validated['idAsignatura'];
        $catedra->añoEscolar = $validated['añoEscolar'];
        $catedra->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('catedras.index')->with('success', 'Cátedra creada exitosamente.');
    }

    public function edit($id)
    {
        $docentes = DocenteProvicional::all();
        $secciones = Seccion::all();
        $grados = Grado::all();
        $niveles = Nivel::all();
        $cursos = Curso::all();
        $asignaturas = Asignatura::all();
        $añosEscolares = AñoEscolar::all();

        return view('catedras.create', compact('docentes', 'secciones', 'grados', 'niveles', 'cursos', 'asignaturas', 'añosEscolares'));
    }

    public function update(Request $request, Catedra $catedra)
    {
        $request->validate([
            'codigo_docente' => 'required',
            'idSeccion' => 'required',
            'idGrado' => 'required',
            'idNivel' => 'required',
            'idAsignatura' => 'required',
            'idCurso' => 'required',
            'añoEscolar' => 'required',
        ]);

        $catedra->update($request->all());

        return redirect()->route('catedras.index')->with('success', 'Cátedra actualizada exitosamente.');
    }

    public function destroy(Catedra $catedra)
    {
        $catedra->update(['estado' => 0]);
        return redirect()->route('catedras.index')->with('success', 'Cátedra eliminada exitosamente.');
    }
}
