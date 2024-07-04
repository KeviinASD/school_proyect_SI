<?php

namespace App\Http\Controllers;

use App\Models\Seccion;
use Illuminate\Http\Request;

class SeccionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $secciones = Seccion::all();
        return view('pages.gradosYSecciones.seccion_index', compact('secciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Seccion $seccion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Seccion $seccion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Seccion $seccion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seccion $seccion)
    {
        //
    }
}
