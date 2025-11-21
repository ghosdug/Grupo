@extends('layouts.app')

@section('title', 'Detalle de los Grupos')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"> Detalle de los Grupos </h4>
                    <div>

                    <a href="{{ route('grupos.edit',$grupo->id) }}" 
                           class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i> Editar
			        </a>        

                        <a href="{{ route('grupos.index') }}" 
                           class="btn btn-sm btn-secondary">
                            <i class="bi bi-arrow-left"></i> Volver
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th width="30%" class="bg-light">periodo</th>
                                <td>{{ $grupo->periodo }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">alumno_escritos</th>
                                <td>{{ $grupo->alumno_escritos }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">estatus_grupo</th>
                                <td>{{ $grupo->estatus_grupo }}</td>

                            </tr>
                            <tr>
                                <th class="bg-light">capacidad_grupo</th>
                                <td>{{ $grupo->capacidad_grupo }}</td>

                            </tr>
                            <tr>
                                <th class="bg-light">rfc</th>
                                <td>{{ $grupo->rfc }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Creado</th>
                                <td>{{ $grupo->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Última Actualización</th>
                                <td>{{ $grupo->updated_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Botón de eliminar -->
                    <div class="mt-3">
                        <form action="{{ route('grupos.destroy', $grupo->id) }}" 
                              method="POST" 
                              onsubmit="return confirm('¿ESTAS SEGURO DE ELIMINAR EL GRUPO?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash"></i> Eliminar Grupo
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
