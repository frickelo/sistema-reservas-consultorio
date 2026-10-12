@extends('layouts.main')

@section('contenido')
    <div class="card shadow-sm">
        <div class="card-body">
            <h2 class="mb-4 text-primary">Editar Especialidad</h2>

            <form action="{{ route('especialidades.update', $especialidad->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text"
                           name="nombre"
                           id="nombre"
                           class="form-control"
                           value="{{ old('nombre', $especialidad->nombre) }}"
                           required>
                </div>

                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="{{ route('especialidades.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@endsection