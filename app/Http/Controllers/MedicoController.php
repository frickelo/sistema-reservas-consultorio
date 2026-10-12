<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medico;
use App\Models\Especialidad;

class MedicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medicos = Medico::with('especialidad')->get();

        return view('medicos.index', compact('medicos'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $especialidades = Especialidad::all();

        return view('medicos.create', compact('especialidades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'especialidad_id' => 'required|exists:especialidades,id',
        ]);

        Medico::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'especialidad_id' => $request->especialidad_id,
        ]);

        return redirect()
        ->route('medicos.index')
        ->with('success', 'Medico creado correctamente.');
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
    $medico = Medico::findOrFail($id);
    $especialidades = Especialidad::all();

    return view('medicos.edit', compact('medico', 'especialidades'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'especialidad_id' => 'required|exists:especialidades,id',   

        ]);
        $medico = Medico::findOrFail($id);
        $medico->update([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'especialidad_id' => $request->especialidad_id,
        ]);

        return redirect()
            ->route('medicos.index')
            ->with('success', 'Medico actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    $medico = Medico::findOrFail($id);
    $medico->delete();

    return redirect()
        ->route('medicos.index')
        ->with('success', 'Médico eliminado correctamente.');
}
}
