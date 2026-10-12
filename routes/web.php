<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\EspecialidadController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    // Estadísticas básicas
    $totalEspecialidades = \App\Models\Especialidad::count();
    $totalMedicos        = \App\Models\Medico::count();
    $citasHoy            = \App\Models\Cita::whereDate('fecha', today())->count();

    return view('dashboard', compact(
        'totalEspecialidades',
        'totalMedicos',
        'citasHoy'
    ));
})->middleware(['auth', 'verified'])->name('dashboard');

// ---- Rutas para cualquier usuario logueado ----
Route::middleware('auth')->group(function () {
    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Citas (cualquier usuario logueado puede ver las suyas)
    Route::resource('citas', CitaController::class);
});

// ---- Rutas SOLO para admins ----
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('especialidades', EspecialidadController::class);
    Route::resource('medicos', MedicoController::class);
});

require __DIR__.'/auth.php';