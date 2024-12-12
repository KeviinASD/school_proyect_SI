<?php

namespace App\Http\Controllers;
use App\Models\Alumno;
use Illuminate\Http\Request;
use App\Models\EstadoCivil;
use App\Models\Sexo;
use App\Models\Religion;
use App\Models\Escala;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
     public function index(Request $request)


{
    $buscarpor = $request->get('buscarpor');
    $estado = $request->get('estado');


    // Filtrar alumnos por estado = 1 y aplicar búsqueda por nombre si es necesario
    $alumnos = Alumno::where('estado', 1)
        ->where(function($query) use ($buscarpor) {
            if (!empty($buscarpor)) {
                $query->where('nombres', 'like', '%' . $buscarpor . '%')
                      ->orWhere('apellidos', 'like', '%' . $buscarpor . '%')
                      ->orWhere('codigoAlumno', 'like', '%' . $buscarpor . '%');
            }
        })
        ->get();

    // Pasar los datos a la vista
    return view('pages.alumnos.index', compact('alumnos', 'estado', 'buscarpor'));
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
            'DNI' => 'required|string|size:8|unique:alumnos,DNI',
            'dniApoderado' => 'required|string|size:8',
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
            'estado' => 'nullable|boolean',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validación para la imagen
        ]);

        $alumno = new Alumno();
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
        $alumno->dniApoderado = $request->dniApoderado;

        // Asignar estado basado en el checkbox
        $alumno->estado = $request->has('estado') ? 1 : 0;

        // Manejo de la imagen
        $imagenNombre = null;
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $imagenNombre = $imagen->hashName(); // Genera un nombre único
            $imagen->storeAs('public/alumnos', $imagenNombre); // Guarda la imagen
        }

        $alumno->imagen_url = $imagenNombre;
        
        $alumno->save();

        // Verificar si el apoderado ya existe
        $email = $request->dniApoderado. '@gmail.com';
        $existingUser = User::where('email', $email)->first();

        if ($existingUser) {
            return redirect()->route('alumnos.index')->with('success', 'Alumno registrado correctamente.');
        }

        // quiero crear un usario con el DNI del alumno y el codigo del alumno con el role de alumno y su contraseña hash
        $user = User::create([
            'name' => $request->dniApoderado,
            'email' => $request->dniApoderado. '@gmail.com', // Correo temporal
            'password' => Hash::make($request->input('dniApoderado')),
            'role' => 'apoderado', // Asignar rol
            'codigo' => $request->dniApoderado,
        ]);

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
        
        $estadosCiviles = EstadoCivil::all();
        $religiones = Religion::all();
        $escalas = Escala::all();
        $sexos = Sexo::all();

        return view('pages.alumnos.edit', compact('alumno', 'estadosCiviles', 'religiones', 'escalas', 'sexos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $codigoAlumno)
    {
        $request->validate([
            'nombres' => 'required|string|max:30',
            'apellidos' => 'required|string|max:30',
            'DNI' => 'required|digits:8',
            'dniApoderado' => 'required|string|size:8',
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
            'estado' => 'nullable|boolean',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validación para la imagen
        ]);


        $alumno = Alumno::where('codigoAlumno', $codigoAlumno)->firstOrFail();

        // Mantener la imagen actual por defecto
        $imagenNombre = $alumno->imagen_url;
    
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $imagenNombre = $imagen->hashName();
            $imagen->storeAs('public/alumnos', $imagenNombre);
    
            // Eliminar la imagen anterior si existe
            if ($alumno->imagen_url) {
                Storage::delete('public/alumnos/' . $alumno->imagen_url);
            }
        }


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
        $alumno->dniApoderado = $request->dniApoderado;
        $alumno->imagen_url = $imagenNombre;


        $alumno->save();

        return redirect()->route('alumnos.index')->with('success', 'Alumno actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    /**public function destroy($codigoAlumno)
    {
        $alumno = Alumno::findOrFail($codigoAlumno);
        $alumno->delete();

        return redirect()->route('alumnos.index')->with('success', 'Alumno eliminado correctamente.');
    }**/
    public function destroy($codigoAlumno)
{
    // Encuentra al alumno por su código
    $alumno = Alumno::where('codigoAlumno', $codigoAlumno)->first();

    if ($alumno) {
        // Cambia el estado del alumno a 0
        $alumno->estado = 0;
        $alumno->save();

        return redirect()->route('alumnos.index')->with('success', 'El estado del alumno ha sido actualizado a 0.');
    }

    return redirect()->route('alumnos.index')->with('error', 'Alumno no encontrado.');
}
}
