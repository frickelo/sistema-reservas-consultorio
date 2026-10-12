@extends('layouts.main')

@section('title', 'Panel de Control')

@section('contenido')
    <div class="card shadow-sm">
        <div class="card-body">
            <h2 class="mb-4 text-primary">Panel de Control</h2>

            <p class="text-muted mb-4">
                Bienvenido, <strong>{{ auth()->user()->name }}</strong>
                @if(auth()->user()->esAdmin())
                    <span class="badge bg-danger ms-2">Administrador</span>
                @else
                    <span class="badge bg-info ms-2">Cliente</span>
                @endif
            </p>

            <hr>

            @if(auth()->user()->esAdmin())
                <h4 class="mb-3">Resumen del sistema</h4>

                <div class="row g-3">

                    <div class="col-md-4">
                        <div class="card border-primary h-100">
                            <div class="card-body text-center">
                                <i class="bi bi-clipboard2-pulse text-primary" style="font-size: 2rem;"></i>
                                <h2 class="text-primary mb-1">{{ $totalEspecialidades }}</h2>
                                <p class="text-muted mb-0">Especialidades</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card border-success h-100">
                            <div class="card-body text-center">
                                <i class="bi bi-person-badge text-success" style="font-size: 2rem;"></i>
                                <h2 class="text-success mb-1">{{ $totalMedicos }}</h2>
                                <p class="text-muted mb-0">Médicos</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card border-warning h-100">
                            <div class="card-body text-center">
                                <i class="bi bi-calendar-check text-warning" style="font-size: 2rem;"></i>
                                <h2 class="text-warning mb-1">{{ $citasHoy }}</h2>
                                <p class="text-muted mb-0">Citas hoy</p>
                            </div>
                        </div>
                    </div>

                </div>
            @else
                <div class="alert alert-info">
                    <i class="bi bi-info-circle"></i>
                    Usa el menú lateral para ver y gestionar tus citas.
                </div>
            @endif
        </div>
    </div>
@endsection