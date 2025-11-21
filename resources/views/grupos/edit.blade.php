@extends('layouts.app')

@section('title', 'Editar Grupo')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0">Editar Grupo</h4>
                </div>
                <div class="card-body">
                    
                    <!-- Mostrar errores de validación -->
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <strong>¡Error!</strong> Por favor corrija los siguientes errores:
                            <ul class="mb-0 mt-2">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Formulario -->
                    <form action="{{ route('grupos.update', $grupo->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <!-- Grupo -->
                        <div class="mb-3">
                            <label for="grupo" class="form-label">Grupo <span class="text-danger">*</span></label>
                            <input type="text" 
                                class="form-control @error('grupo') is-invalid @enderror" 
                                id="grupo" 
                                name="grupo" 
                                value="{{ old('grupo', $grupo->grupo) }}" 
                                required>
                            @error('grupo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Período -->
                        <div class="mb-3">
                            <label for="periodo" class="form-label">
                                Período <span class="text-danger">*</span>
                            </label>
                            <input 
                                type="text" 
                                class="form-control @error('periodo') is-invalid @enderror" 
                                id="periodo" 
                                name="periodo"
                                value="{{ old('periodo', $grupo->periodo) }}"
                                maxlength="5"
                                required>
                            @error('periodo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Alumnos Inscritos -->
                        <div class="mb-3">
                            <label for="alumno_escritos" class="form-label">
                                Alumnos Inscritos <span class="text-danger">*</span>
                            </label>
                            <input 
                                type="number" 
                                class="form-control @error('alumno_escritos') is-invalid @enderror" 
                                id="alumno_escritos" 
                                name="alumno_escritos" 
                                value="{{ old('alumno_escritos', $grupo->alumno_escritos) }}"
                                min="0"
                                required>
                            @error('alumno_escritos')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Capacidad del Grupo -->
                        <div class="mb-3">
                            <label for="capacidad_grupo" class="form-label">
                                Capacidad del Grupo <span class="text-danger">*</span>
                            </label>
                            <input 
                                type="number" 
                                class="form-control @error('capacidad_grupo') is-invalid @enderror" 
                                id="capacidad_grupo" 
                                name="capacidad_grupo" 
                                value="{{ old('capacidad_grupo', $grupo->capacidad_grupo) }}"
                                min="1"
                                required>
                            @error('capacidad_grupo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Estatus del Grupo -->
                        <div class="mb-3">
                            <label for="estatus_grupo" class="form-label">
                                Estatus del Grupo <span class="text-danger">*</span>
                            </label>
                            <select 
                                class="form-control @error('estatus_grupo') is-invalid @enderror" 
                                id="estatus_grupo" 
                                name="estatus_grupo" 
                                required>
                                <option value="">Seleccione un estatus</option>
                                <option value="Activo" {{ old('estatus_grupo', $grupo->estatus_grupo) == 'Activo' ? 'selected' : '' }}>Activo</option>
                                <option value="Inactivo" {{ old('estatus_grupo', $grupo->estatus_grupo) == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                                <option value="Cerrado" {{ old('estatus_grupo', $grupo->estatus_grupo) == 'Cerrado' ? 'selected' : '' }}>Cerrado</option>
                            </select>
                            @error('estatus_grupo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- RFC del Profesor -->
                        <div class="mb-3">
                            <label for="rfc" class="form-label">
                                RFC del Profesor <span class="text-danger">*</span>
                            </label>
                            <input 
                                type="text" 
                                class="form-control @error('rfc') is-invalid @enderror" 
                                id="rfc" 
                                name="rfc" 
                                value="{{ old('rfc', $grupo->rfc) }}"
                                maxlength="13"
                                style="text-transform: uppercase;"
                                required>
                            @error('rfc')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Información adicional -->
                        <div class="alert alert-info">
                            <small>
                                <strong>Fecha de creación:</strong> {{ $grupo->created_at->format('d/m/Y H:i') }}<br>
                                <strong>Última actualización:</strong> {{ $grupo->updated_at->format('d/m/Y H:i') }}
                            </small>
                        </div>

                        <!-- Botones -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('grupos.index') }}" class="btn btn-secondary">
                                <i class="bi bi-x-circle"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-warning">
                                <i class="bi bi-save"></i> Actualizar Grupo
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection