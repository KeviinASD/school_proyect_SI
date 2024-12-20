<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\DocenteProvicional;
use App\Models\TipoDocente;
use App\Models\EstadoCivil;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validación para la imagen
        ]);
    
        // Código para generar el código del docente
        $nombres = $request->input('nombres');
        $apellidos = $request->input('apellidos');
        $dni = $request->input('DNI');
        $codigo_docente = strtoupper(substr($nombres, 0, 1) . $dni . substr($apellidos, 0, 1));
    
        // Manejo de la imagen
        $imagenNombre = null;
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $imagenNombre = $imagen->hashName(); // Genera un nombre único
            $imagen->storeAs('public/docentes', $imagenNombre); // Guarda la imagen
        }
        

        $docente = new Docente();
        $docente->nombres = $request->nombres;
        $docente->apellidos = $request->apellidos;
        $docente->DNI = $request->DNI;
        $docente->direccion = $request->direccion;
        $docente->seguroSocial = $request->seguroSocial;
        $docente->fechaIngreso = $request->fechaIngreso;
        $docente->id_tipo_docente = $request->id_tipo_docente;
        $docente->idEstadoCivil = $request->idEstadoCivil;
        $docente->imagen_url = $imagenNombre;
        $docente->codigo_docente = $codigo_docente;
        $docente->estado = 1;

        $docente->save();
    
        // Crear el usuario
        User::create([
            'name' => $dni,
            'email' => $dni . '@gmail.com', // Correo temporal
            'password' => Hash::make($request->input('DNI')),
            'role' => 'docente', // Asignar rol
            'codigo' => $codigo_docente,
        ]);
    
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
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validación para la imagen
        ]);
    
        // Mantener la imagen actual por defecto
        $imagenNombre = $docente->imagen_url;
    
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $imagenNombre = $imagen->hashName();
            $imagen->storeAs('public/docentes', $imagenNombre);
    
            // Eliminar la imagen anterior si existe
            if ($docente->imagen_url) {
                Storage::delete('public/docentes/' . $docente->imagen_url);
            }
        }
    
        // Asignar los valores directamente a las propiedades del modelo
        $docente->DNI = $request->DNI;
        $docente->apellidos = $request->apellidos;
        $docente->nombres = $request->nombres;
        $docente->direccion = $request->direccion;
        $docente->seguroSocial = $request->seguroSocial;
        $docente->fechaIngreso = $request->fechaIngreso;
        $docente->id_tipo_docente = $request->id_tipo_docente;
        $docente->idEstadoCivil = $request->idEstadoCivil;
        $docente->imagen_url = $imagenNombre;
    
        // Guardar los cambios
        $docente->save();
    
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
