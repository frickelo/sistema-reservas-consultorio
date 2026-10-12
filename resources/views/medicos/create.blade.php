@extends('layouts.main')

@section('contenido')
    <div class="card shadow-sm">
        <div class="card-body">
            <h2 class="mb-4 text-primary">Nuevo Médico</h2>

            <form action="{{ route('medicos.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text"
                           name="nombre"
                           id="nombre"
                           class="form-control"
                           value="{{ old('nombre') }}"
                           required>
                </div>

                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input type="text"
                           name="apellido"
                           id="apellido"
                           class="form-control"
                           value="{{ old('apellido') }}"
                           required>
                </div>

                <div class="mb-3">
                    <label for="especialidad_id" class="form-label">Especialidad</label>
                    <select name="especialidad_id" id="especialidad_id" class="form-select" required>
                        <option value="">-- Selecciona una especialidad --</option>
                        @foreach($especialidades as $especialidad)
                            <option value="{{ $especialidad->id }}"
                                {{ old('especialidad_id') == $especialidad->id ? 'selected' : '' }}>
                                {{ $especialidad->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="{{ route('medicos.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@endsection
            
