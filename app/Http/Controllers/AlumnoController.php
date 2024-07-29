<?php

namespace App\Http\Controllers;
use App\Models\Alumno;
use Illuminate\Http\Request;
use App\Models\EstadoCivil;
use App\Models\Sexo;
use App\Models\Religion;
use App\Models\Escala;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        $alumnos = Alumno::with('sexo')->get(); // Recupera todos los alumnos

        return view('pages.alumnos.index', compact('alumnos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $estadosCiviles = EstadoCivil::all();
        $religiones = Religion::all();
        $escalas = Escala::all();
        $sexos = Sexo::all();


        return view('pages.alumnos.create', [
            'estadosCiviles' => $estadosCiviles,
            'religiones' => $religiones,
            'escalas' => $escalas,
            'sexos' => $sexos,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        // Validación de los datos
        $request->validate([
            'codigoAlumno' => 'required|string|max:10',
            'nombres' => 'required|string|max:30',
            'apellidos' => 'required|string|max:30',
            'DNI' => 'required|string|max:8',
            'fechaNacimiento' => 'nullable|date',
            'añoIngreso' => 'nullable|date',
            'departamento' => 'nullable|string|max:15',
            'pais' => 'nullable|string|max:15',
            'provincia' => 'nullable|string|max:15',
            'distrito' => 'nullable|string|max:15',
            'lenguaMaterna' => 'nullable|string|max:15',
            'fechaBautizo' => 'nullable|date',
            'parroquiaDeBautizo' => 'nullable|string|max:30',
            'colegioProcedencia' => 'nullable|string|max:30',
            'idDomicilio' => 'nullable|integer|exists:domicilio,idDomicilio',
            'idEstadoCivil' => 'nullable|integer|exists:estado_civil,idEstadoCivil',
            'idReligion' => 'nullable|integer|exists:religion,idReligion',
            'idEscala' => 'nullable|integer|exists:escala,idEscala',
            'idSexo' => 'nullable|integer|exists:sexo,idSexo',
        ]);

        // Crear un nuevo alumno
        Alumno::create($request->all());

        // Redirigir a la página deseada con un mensaje de éxito
        return redirect()->route('alumnos.index')->with('success', 'Alumno registrado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($codigoAlumno)
    {
        $alumno = Alumno::findOrFail($codigoAlumno);
        $alumno->delete();

        return redirect()->route('alumnos.index')->with('success', 'Alumno eliminado correctamente.');
    }
}
