<?php

namespace App\Http\Controllers;

use App\Models\Capacidad;
use Illuminate\Http\Request;

class CapacidadController extends Controller
{
    public function index()
    {
        $capacidades = Capacidad::all();
        return view('capacidades.index', compact('capacidades'));
    }

    public function create()
    {
        return view('capacidades.create');
    }

    public function store(Request $request)
    {
        Capacidad::create($request->all());
        return redirect()->route('capacidades.index');
    }

    public function show(Capacidad $capacidad)
    {
        return view('capacidades.show', compact('capacidad'));
    }

    public function edit(Capacidad $capacidad)
    {
        return view('capacidades.edit', compact('capacidad'));
    }

    public function update(Request $request, Capacidad $capacidad)
    {
        $capacidad->update($request->all());
        return redirect()->route('capacidades.index');
    }

    public function destroy(Capacidad $capacidad)
    {
        $capacidad->delete();
        return redirect()->route('capacidades.index');
    }
}

