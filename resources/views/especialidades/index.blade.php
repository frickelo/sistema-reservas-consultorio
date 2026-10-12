@extends('layouts.main')

@section('contenido')
    <div class="card shadow-sm">
        <div class="card-body">
            <h2 class="mb-4 text-primary">Listado de Especialidades</h2>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <a href="{{ route('especialidades.create') }}" class="btn btn-success mb-3">Nueva Especialidad</a>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($especialidades as $especialidad)
                        <tr>
                            <td>{{ $especialidad->id }}</td>
                            <td>{{ $especialidad->nombre }}</td>
                            <td>
                                <a href="{{ route('especialidades.edit', $especialidad->id) }}" class="btn btn-primary btn-sm">Editar</a>
                                <form action="{{ route('especialidades.destroy', $especialidad->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Eliminar especialidad?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection