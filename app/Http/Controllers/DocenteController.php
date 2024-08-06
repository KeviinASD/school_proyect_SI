<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\DocenteProvicional;
use App\Models\TipoDocente;
use App\Models\EstadoCivil;
use Illuminate\Http\Request;

class DocenteController extends Controller
{
    public function index()
    {
        $docentes = DocenteProvicional::with('tipoDocente', 'estadoCivil')->get();
        return view('docentes.index', compact('docentes'));
    }

    public function create()
    {
        $tiposDocentes = TipoDocente::all();
        $estadosCiviles = EstadoCivil::all();
        $docentes = DocenteProvicional::all();
        return view('docentes.create', compact('tiposDocentes', 'estadosCiviles'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'DNI' => 'required|string|unique:DOCENTES,DNI',
            'apellidos' => 'required|string|max:255',
            'nombres' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'fechaIngreso' => 'required|date',
            'id_tipo_docente' => 'required|exists:TIPO_DOCENTE,id_tipo_docente',
            'idEstadoCivil' => 'required|exists:ESTADO_CIVIL,id_estado_civil',
        ]);

        DocenteProvicional::create($request->all());

        return redirect()->route('docentes.index')
            ->with('success', 'Docente creado exitosamente.');
    }

    public function edit(DocenteProvicional $docente)
    {
        $tiposDocentes = TipoDocente::all();
        $estadosCiviles = EstadoCivil::all();
        return view('docentes.edit', compact('docente', 'tiposDocentes', 'estadosCiviles'));
    }

    public function update(Request $request, DocenteProvicional $docente)
    {
        $request->validate([
            'DNI' => 'required|string|unique:DOCENTES,DNI,' . $docente->codigo_docente . ',codigo_docente',
            'apellidos' => 'required|string|max:255',
            'nombres' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'fechaIngreso' => 'required|date',
            'id_tipo_docente' => 'required|exists:TIPO_DOCENTE,id_tipo_docente',
            'idEstadoCivil' => 'required|exists:ESTADO_CIVIL,id_estado_civil',
        ]);

        $docente->update($request->all());

        return redirect()->route('docentes.index')
            ->with('success', 'Docente actualizado exitosamente.');
    }

    public function destroy(DocenteProvicional $docente)
    {
        $docente->delete();

        return redirect()->route('docentes.index')
            ->with('success', 'Docente eliminado exitosamente.');
    }
}
