<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\DocenteProvicional;
use App\Models\TipoDocente;
use App\Models\EstadoCivil;
use Illuminate\Http\Request;

class DocenteController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('buscarpor');

        $docentesQuery = Docente::with('tipoDocente', 'estadoCivil')->where('estado', 1);

        if ($search) {
            $docentesQuery->where(function ($query) use ($search) {
                $query->where('nombres', 'LIKE', "%{$search}%")
                      ->orWhere('apellidos', 'LIKE', "%{$search}%");
            });
        }

        // Paginación: muestra 10 registros por página
        $docentes = $docentesQuery->paginate(8);

        return view('pages.docentes.index', compact('docentes'));
    }

    public function create()
    {
        $tiposDocentes = TipoDocente::all();
        $estadosCiviles = EstadoCivil::all();
        return view('pages.docentes.create', compact('tiposDocentes', 'estadosCiviles'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'DNI' => 'required|string|unique:DOCENTES,DNI',
            'apellidos' => 'required|string|max:255',
            'nombres' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'seguroSocial' => 'nullable|string|max:255',
            'fechaIngreso' => 'required|date',
            'id_tipo_docente' => 'required|exists:TIPO_DOCENTE,id_tipo_docente',
            'idEstadoCivil' => 'required|exists:ESTADO_CIVIL,idEstadoCivil',
        ]);

        $nombres = $request->input('nombres');
        $apellidos = $request->input('apellidos');
        $dni = $request->input('DNI');
        $codigo_docente = strtoupper(substr($nombres, 0, 1) . $dni . substr($apellidos, 0, 1));

        Docente::create(array_merge($request->all(), ['codigo_docente' => $codigo_docente, 'estado' => 1]));

        return redirect()->route('docentes.index')
            ->with('success', 'Docente creado exitosamente.');
    }

    public function edit(DocenteProvicional $docente)
    {
        $tiposDocentes = TipoDocente::all();
        $estadosCiviles = EstadoCivil::all();
        return view('pages.docentes.edit', compact('docente', 'tiposDocentes', 'estadosCiviles'));
    }

    public function update(Request $request, DocenteProvicional $docente)
    {
        $request->validate([
            'DNI' => 'required|string|unique:DOCENTES,DNI,' . $docente->codigo_docente . ',codigo_docente',
            'apellidos' => 'required|string|max:255',
            'nombres' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'seguroSocial' => 'nullable|string|max:255',
            'fechaIngreso' => 'required|date',
            'id_tipo_docente' => 'required|exists:TIPO_DOCENTE,id_tipo_docente',
            'idEstadoCivil' => 'required|exists:ESTADO_CIVIL,idEstadoCivil',
        ]);

        $docente->update($request->all());

        return redirect()->route('docentes.index')
            ->with('success', 'Docente actualizado exitosamente.');
    }

    public function destroy(DocenteProvicional $docente)
    {
        $docente->update(['estado' => 0]);

        return redirect()->route('docentes.index')
            ->with('success', 'Docente eliminado exitosamente.');
    }
}
