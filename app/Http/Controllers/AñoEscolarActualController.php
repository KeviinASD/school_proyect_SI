<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AñoEscolar;
use App\Models\AñoEscolarActual;

class AñoEscolarActualController extends Controller
{
    public function edit()
    {
        $añosEscolares = AñoEscolar::all();
        $añoEscolarActual = AñoEscolarActual::first();
        return view('pages.añoEscolarActual.edit', compact('añosEscolares', 'añoEscolarActual'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'año_escolar_id' => 'required|exists:año_escolar,añoEscolar',
        ]);

        $añoEscolarActual = AñoEscolarActual::first();
        if ($añoEscolarActual) {
            $añoEscolarActual->update(['año_escolar_id' => $request->año_escolar_id]);
        } else {
            AñoEscolarActual::create(['año_escolar_id' => $request->año_escolar_id]);
        }

        return redirect()->route('año_escolar_actual.edit')->with('success', 'Año escolar actual actualizado correctamente.');
    }
}