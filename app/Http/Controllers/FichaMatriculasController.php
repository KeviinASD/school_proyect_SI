<?php

namespace App\Http\Controllers;

use App\Models\FichaMatriculas;
use App\Models\Alumno;
use App\Models\Seccion;
use App\Models\Grado;
use App\Models\Nivel;
use App\Models\AñoEscolarActual;

use Illuminate\Http\Request;

class FichaMatriculasController extends Controller
{
    // Mostrar una lista de todas las fichas de matrícula
    public function index(Request $request)
    {
        // Obtener el término de búsqueda
        $añosActual = AñoEscolarActual::first()->año_escolar_id;

        $buscarPor = $request->input('buscarpor');

        
        // Construir la consulta
        $query = FichaMatriculas::query();
        $query->where('añoEscolar', $añosActual);

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
        // Obtener el año escolar actual
        $añoEscolarActual = AñoEscolarActual::first();
        if (!$añoEscolarActual) {
            return redirect()->back()->with('error', 'No se ha configurado un año escolar actual.');
        }
    
        $añoEscolarId = $añoEscolarActual->año_escolar_id;
    
        // Obtener los alumnos que no están matriculados en el año escolar actual
        $codigoAlumnos = Alumno::whereDoesntHave('matriculas', function ($query) use ($añoEscolarId) {
            $query->where('añoEscolar', $añoEscolarId);
        })->get();
    
        // Obtener las demás entidades necesarias para la vista
        $secciones = Seccion::all();
        $grados = Grado::all();
        $niveles = Nivel::all();
    
        // Retornar la vista con los datos necesarios
        return view('pages.fichaMatriculas.create', compact('codigoAlumnos', 'secciones', 'grados', 'niveles', 'añoEscolarActual'));
    }
    

    // Guardar una nueva ficha de matrícula en la base de datos
    public function store(Request $request)
    {
        // Validación de los datos de entrada
        $validatedData = $request->validate([
            'codigoAlumno' => 'required|exists:alumnos,codigoAlumno',
            'fechaMatricula' => 'required|date',
            'idSeccion' => 'required|exists:secciones,idSeccion',
            'idGrado' => 'required|exists:grados,idGrado',
            'idNivel' => 'required|exists:niveles,idNivel',
        ]);
        $validatedData['añoEscolar'] = AñoEscolarActual::first()->año_escolar_id;
    
        // Verificar si ya existe una matrícula con la misma combinación
        $existingMatricula = FichaMatriculas::where([
            ['codigoAlumno', '=', $request->input('codigoAlumno')],
            ['idSeccion', '=', $request->input('idSeccion')],
            ['idGrado', '=', $request->input('idGrado')],
            ['idNivel', '=', $request->input('idNivel')],
            ['añoEscolar', '=', AñoEscolarActual::first()->año_escolar_id],
        ])->first();
    
        if ($existingMatricula) {
            // Si ya existe, redirigir con un mensaje de error
            return redirect()->back()->withErrors(['error' => 'El alumno ya está matriculado en esta combinación de sección, grado, nivel y año escolar.']);
        }
    
        // Crear la ficha de matrícula si no existe una duplicada
        FichaMatriculas::create($validatedData);
    
        return redirect()->route('fichaMatriculas.index')->with('success', 'Ficha de Matrícula creada exitosamente.');
    }

    // Mostrar el formulario para editar una ficha de matrícula existente
    public function edit(FichaMatriculas $fichaMatricula)
    {
        $codigoAlumnos = Alumno::all();
        $secciones = Seccion::all();
        $grados = Grado::all();
        $niveles = Nivel::all();
        $añoEscolarActual = AñoEscolarActual::first();
        return view('pages.fichaMatriculas.edit', compact('fichaMatricula', 'codigoAlumnos', 'secciones', 'grados', 'niveles', 'añoEscolarActual'));
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
        ]);
        $validatedData['añoEscolar'] = AñoEscolarActual::first()->año_escolar_id;
        $fichaMatricula->update($validatedData);

        return redirect()->route('fichaMatriculas.index')->with('success', 'Ficha de Matrícula actualizada exitosamente.');
    }

    // Eliminar una ficha de matrícula específica de la base de datos
    public function destroy(FichaMatriculas $fichaMatricula)
    {
        $fichaMatricula->delete();

        return redirect()->route('fichaMatriculas.index')->with('success', 'Ficha de Matrícula eliminada exitosamente.');
    }
}
