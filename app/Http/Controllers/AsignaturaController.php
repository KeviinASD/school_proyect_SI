<?php

namespace App\Http\Controllers;

use App\Models\Asignatura;
use Illuminate\Http\Request;

class AsignaturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asignaturas = Asignatura::all();
        return view('asignaturas.index', compact('asignaturas'));
    }

    public function create()
    {
        return view('asignaturas.create');
    }

    public function store(Request $request)
    {
        Asignatura::create($request->all());
        return redirect()->route('asignaturas.index');
    }

    public function show(Asignatura $asignatura)
    {
        return view('asignaturas.show', compact('asignatura'));
    }

    public function edit(Asignatura $asignatura)
    {
        return view('asignaturas.edit', compact('asignatura'));
    }

    public function update(Request $request, Asignatura $asignatura)
    {
        $asignatura->update($request->all());
        return redirect()->route('asignaturas.index');
    }

    public function destroy(Asignatura $asignatura)
    {
        $asignatura->delete();
        return redirect()->route('asignaturas.index');
    }
}
