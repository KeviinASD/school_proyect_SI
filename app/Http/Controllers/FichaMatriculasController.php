<?php

namespace App\Http\Controllers;

use App\Models\FichaMatriculas;
use App\Models\Alumno;
use App\Models\Seccion;
use App\Models\Grado;
use App\Models\Nivel;
use App\Models\AñoEscolar;

use Illuminate\Http\Request;

class FichaMatriculasController extends Controller
{
    // Mostrar una lista de todas las fichas de matrícula
    public function index(Request $request)
    {
        // Obtener el término de búsqueda
        $buscarPor = $request->input('buscarpor');

        // Construir la consulta
        $query = FichaMatriculas::query();

        // Filtrar por código de alumno si se proporciona un término de búsqueda
        if ($buscarPor) {
            $query->where('codigoAlumno', 'like', '%' . $buscarPor . '%');
        }

        // Obtener los registros con paginación
        $fichasMatriculas = $query->paginate(8); // Cambia 10 por el número de registros por página que desees

        return view('pages.fichaMatriculas.index', compact('fichasMatriculas'));
    }

    // Mostrar el formulario para crear una nueva ficha de matrícula
    public function create()
    {
        $codigoAlumnos = Alumno::all();
        $secciones = Seccion::all();
        $grados = Grado::all();
        $niveles = Nivel::all();
        $añoEscolares = AñoEscolar::all();
        return view('pages.fichaMatriculas.create', compact('codigoAlumnos', 'secciones', 'grados', 'niveles', 'añoEscolares'));
    }

    // Guardar una nueva ficha de matrícula en la base de datos
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'codigoAlumno' => 'required|exists:alumnos,codigoAlumno',
            'fechaMatricula' => 'required|date',
            'idSeccion' => 'required|exists:secciones,idSeccion',
            'idGrado' => 'required|exists:grados,idGrado',
            'idNivel' => 'required|exists:niveles,idNivel',
            'añoEscolar' => 'required|exists:AÑO_ESCOLAR,añoEscolar'
        ]);

        // Generar nroMatricula
        $codigoAlumno = $request->input('codigoAlumno');
        $fechaMatricula = $request->input('fechaMatricula');

        // Extraer solo el año de la fecha de matrícula
        $anioMatricula = date('Y', strtotime($fechaMatricula));

        $nroMatricula = strtoupper(substr($codigoAlumno, 1, 8) . $anioMatricula);

        FichaMatriculas::create(array_merge($request->all(), ['nroMatricula' => $nroMatricula]));

        return redirect()->route('fichaMatriculas.index')->with('success', 'Ficha de Matrícula creada exitosamente.');
    }

    // Mostrar el formulario para editar una ficha de matrícula existente
    public function edit(FichaMatriculas $fichaMatricula)
    {
        $codigoAlumnos = Alumno::all();
        $secciones = Seccion::all();
        $grados = Grado::all();
        $niveles = Nivel::all();
        $añoEscolares = AñoEscolar::all();
        return view('pages.fichaMatriculas.edit', compact('fichaMatricula', 'codigoAlumnos', 'secciones', 'grados', 'niveles', 'añoEscolares'));
    }

    // Actualizar una ficha de matrícula específica en la base de datos
    public function update(Request $request, FichaMatriculas $fichaMatricula)
    {
        $validatedData = $request->validate([
            'codigoAlumno' => 'required|exists:alumnos,codigoAlumno',
            'fechaMatricula' => 'required|date',
            'idSeccion' => 'required|exists:secciones,idSeccion',
            'idGrado' => 'required|exists:grados,idGrado',
            'idNivel' => 'required|exists:niveles,idNivel',
            'añoEscolar' => 'required|exists:AÑO_ESCOLAR,añoEscolar'
        ]);

        $fichaMatricula->update($request->all());

        return redirect()->route('fichaMatriculas.index')->with('success', 'Ficha de Matrícula actualizada exitosamente.');
    }

    // Eliminar una ficha de matrícula específica de la base de datos
    public function destroy(FichaMatriculas $fichaMatricula)
    {
        $fichaMatricula->delete();

        return redirect()->route('fichaMatriculas.index')->with('success', 'Ficha de Matrícula eliminada exitosamente.');
    }
}
