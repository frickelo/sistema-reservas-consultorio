@extends('layouts.main')

@section('contenido')
    <div class="card shadow-sm">
        <div class="card-body">
            <h2 class="mb-4 text-primary">Nueva Cita</h2>

            <form action="{{ route('citas.store') }}" method="POST">
                @csrf

                {{-- Cliente --}}
                {{-- Cliente --}}
        <div class="mb-3">
            <label for="user_id" class="form-label">Cliente</label>

            @if(auth()->user()->esAdmin())
                {{-- Admin: puede elegir cualquier cliente --}}
                <select name="user_id" id="user_id" class="form-select" required>
                    <option value="">-- Selecciona un cliente --</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}"
                            {{ old('user_id') == $cliente->id ? 'selected' : '' }}>
                            {{ $cliente->name }} ({{ $cliente->email }})
                        </option>
                    @endforeach
                </select>
            @else
                {{-- Cliente: solo se ve a sí mismo, sin poder cambiarlo --}}
                <input type="text"
                    class="form-control"
                    value="{{ auth()->user()->name }} ({{ auth()->user()->email }})"
                    disabled>
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                <small class="text-muted">La cita se agendará a tu nombre.</small>
            @endif
</div>

                {{-- Médico --}}
                <div class="mb-3">
                    <label for="medico_id" class="form-label">Médico</label>
                    <select name="medico_id" id="medico_id" class="form-select" required>
                        <option value="">-- Selecciona un médico --</option>
                        @foreach($medicos as $medico)
                            <option value="{{ $medico->id }}"
                                {{ old('medico_id') == $medico->id ? 'selected' : '' }}>
                                {{ $medico->nombre }} {{ $medico->apellido }} ({{ $medico->especialidad->nombre }})
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Fecha --}}
                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input type="date"
                           name="fecha"
                           id="fecha"
                           class="form-control"
                           value="{{ old('fecha') }}"
                           required>
                </div>

                {{-- Hora --}}
                <div class="mb-3">
                    <label for="hora" class="form-label">Hora</label>
                    <input type="time"
                           name="hora"
                           id="hora"
                           class="form-control"
                           value="{{ old('hora') }}"
                           required>
                </div>

                {{-- Motivo --}}
                <div class="mb-3">
                    <label for="motivo" class="form-label">Motivo</label>
                    <textarea name="motivo"
                              id="motivo"
                              class="form-control"
                              rows="3"
                              required>{{ old('motivo') }}</textarea>
                </div>

                {{-- Estado --}}
                <div class="mb-3">
                    <label for="estado" class="form-label">Estado</label>
                    <select name="estado" id="estado" class="form-select" required>
                        <option value="">-- Selecciona un estado --</option>
                        <option value="pendiente"  {{ old('estado') == 'pendiente'  ? 'selected' : '' }}>Pendiente</option>
                        <option value="confirmada" {{ old('estado') == 'confirmada' ? 'selected' : '' }}>Confirmada</option>
                        <option value="cancelada"  {{ old('estado') == 'cancelada'  ? 'selected' : '' }}>Cancelada</option>
                        <option value="completada" {{ old('estado') == 'completada' ? 'selected' : '' }}>Completada</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="{{ route('citas.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@endsection
