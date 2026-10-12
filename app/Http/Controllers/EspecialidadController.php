<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use Illuminate\Http\Request;

class EspecialidadController extends Controller
{
    public function index()
    {
        $especialidades = Especialidad::all();
        return view('especialidades.index', compact('especialidades'));
    }

    public function create()
    {
        return view('especialidades.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:especialidades,nombre',
        ]);

        Especialidad::create([
            'nombre' => $request->nombre,
        ]);

        return redirect()
            ->route('especialidades.index')
            ->with('success', 'Especialidad creada correctamente.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $especialidad = Especialidad::findOrFail($id);
        return view('especialidades.edit', compact('especialidad'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:especialidades,nombre,' . $id,
        ]);

        $especialidad = Especialidad::findOrFail($id);
        $especialidad->update([
            'nombre' => $request->nombre,
        ]);

        return redirect()
            ->route('especialidades.index')
            ->with('success', 'Especialidad actualizada correctamente.');
    }

    public function destroy(string $id)
    {
        $especialidad = Especialidad::findOrFail($id);
        $especialidad->delete();

        return redirect()
            ->route('especialidades.index')
            ->with('success', 'Especialidad eliminada correctamente.');
    }
}