@extends('layouts.app')

@section('title', 'Grupos')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col">
            <h2>LISTA DE LOS GRUPOS</h2>
        </div>
        <div class="col text-end">
            <a href="{{ route('grupos.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> NUEVO GRUPO
            </a>
        </div>
    </div>

    <!-- Mensajes de éxito/error -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Tabla de grupos -->
    <div class="card">
        <div class="card-body">
            @if($grupos->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Período</th>
                                <th>Grupo</th>
                                <th>Alumnos Inscritos</th>
                                <th>Capacidad</th>
                                <th>Estatus</th>
                                <th>RFC Profesor</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($grupos as $grupo)
                                <tr>
                                    <td>{{ $grupo->periodo }}</td>
                                    <td>{{ $grupo->grupo }}</td>
                                    <td>{{ $grupo->alumno_escritos }}</td>
                                    <td>{{ $grupo->capacidad_grupo }}</td>
                                    <td>
                                        @if($grupo->estatus_grupo == 'Activo')
                                            <span class="badge bg-success">{{ $grupo->estatus_grupo }}</span>
                                        @elseif($grupo->estatus_grupo == 'Inactivo')
                                            <span class="badge bg-warning">{{ $grupo->estatus_grupo }}</span>
                                        @else
                                            <span class="badge bg-secondary">{{ $grupo->estatus_grupo }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $grupo->rfc }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('grupos.show', $grupo->id) }}" 
                                               class="btn btn-sm btn-info" 
                                               title="Ver detalle">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('grupos.edit', $grupo->id) }}" 
                                               class="btn btn-sm btn-warning"
                                               title="Editar">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('grupos.destroy', $grupo->id) }}" 
                                                  method="POST" 
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-sm btn-danger" 
                                                        title="Eliminar"
                                                        onclick="return confirm('¿Está seguro de eliminar el grupo {{ $grupo->grupo }} del período {{ $grupo->periodo }}?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info">
                    <i class="bi bi-info-circle"></i> NO HAY GRUPOS REGISTRADOS.
                    <a href="{{ route('grupos.create') }}">CREAR GRUPO.</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection