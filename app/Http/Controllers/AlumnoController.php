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
            'nombres' => 'required|string|max:30',
            'apellidos' => 'required|string|max:30',
            'DNI' => 'required|string|size:8',
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
    public function edit($codigoAlumno)
    {
        $alumno = Alumno::where('codigoAlumno', $codigoAlumno)->firstOrFail();
        return view('pages.alumnos.edit', compact('alumno'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'nombres' => 'required|string|max:30',
        'apellidos' => 'required|string|max:30',
        'DNI' => 'required|digits:8|unique:alumnos,DNI',
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

    $alumno = Alumno::findOrFail($id);
    $alumno->nombres = $request->nombres;
    $alumno->apellidos = $request->apellidos;
    $alumno->DNI = $request->DNI;
    $alumno->fechaNacimiento = $request->fechaNacimiento;
    $alumno->añoIngreso = $request->añoIngreso;
    $alumno->departamento = $request->departamento;
    $alumno->pais = $request->pais;
    $alumno->provincia = $request->provincia;
    $alumno->distrito = $request->distrito;
    $alumno->lenguaMaterna = $request->lenguaMaterna;
    $alumno->fechaBautizo = $request->fechaBautizo;
    $alumno->parroquiaDeBautizo = $request->parroquiaDeBautizo;
    $alumno->colegioProcedencia = $request->colegioProcedencia;
    $alumno->idDomicilio = $request->idDomicilio;
    $alumno->idEstadoCivil = $request->idEstadoCivil;
    $alumno->idReligion = $request->idReligion;
    $alumno->idEscala = $request->idEscala;
    $alumno->idSexo = $request->idSexo;
    
    $alumno->save();

    return redirect()->route('alumnos.index')->with('success', 'Alumno actualizado correctamente.');
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
