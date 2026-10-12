<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\User;
use App\Models\Medico;

class CitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $citas = Cita::with(['user', 'medico'])->get();
        return view ('citas.index', compact('citas'));
    }

    /**
     * Show the form for creating a new resource.
     */
   
  public function create()
{
    // Admin: ve todos los clientes
    // Cliente: solo se ve a sí mismo
    if (auth()->user()->esAdmin()) {
        $clientes = User::where('role', 'cliente')->get();
    } else {
        $clientes = User::where('id', auth()->id())->get();
    }

    $medicos = Medico::with('especialidad')->get();

    return view('citas.create', compact('clientes', 'medicos'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'user_id'   => 'required|exists:users,id',
        'medico_id' => 'required|exists:medicos,id',
        'fecha'     => 'required|date|after_or_equal:today',
        'hora'      => 'required',
        'motivo'    => 'required|string|max:500',
        'estado'    => 'required|in:pendiente,confirmada,cancelada,completada',
    ]);

    Cita::create([
        'user_id'   => $request->user_id,
        'medico_id' => $request->medico_id,
        'fecha'     => $request->fecha,
        'hora'      => $request->hora,
        'motivo'    => $request->motivo,
        'estado'    => $request->estado,
    ]);

    return redirect()
        ->route('citas.index')
        ->with('success', 'Cita creada correctamente.');
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
        $cita = Cita::findOrFail($id);
        $clientes = User::where('role', 'cliente')->get();
        $medicos = Medico::with('especialidad')->get();

        return view('citas.edit', compact('cita', 'clientes', 'medicos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'user_id'   => 'required|exists:users,id',
            'medico_id' => 'required|exists:medicos,id',
            'fecha'     => 'required|date',
            'hora'      => 'required',
            'motivo'    => 'required|string|max:500',
            'estado'    => 'required|in:pendiente,confirmada,cancelada,completada',
        ]);

        $cita = Cita::findOrFail($id);
        $cita->update([
            'user_id'   => $request->user_id,
            'medico_id' => $request->medico_id,
            'fecha'     => $request->fecha,
            'hora'      => $request->hora,
            'motivo'    => $request->motivo,
            'estado'    => $request->estado,
        ]);

        return redirect()
            ->route('citas.index')
            ->with('success', 'Cita actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cita = Cita::findOrFail($id);
        $cita->delete();

        return redirect()
            ->route('citas.index')
            ->with('success', 'Cita eliminada correctamente.');
    }
}
