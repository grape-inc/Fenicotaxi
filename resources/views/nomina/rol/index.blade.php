@extends('layouts.layout')
@push('scripts-vista')
    <script type="text/javascript" src="{{ URL::asset ('js/Eventos/Rol.js') }}"></script>
    @if (Request()->Eliminado)
        <script>
            Swal.fire('¡Excelente!','Eliminaste el registro correctamente.','success');
        </script>
    @endif
@endpush

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-format-list-bulleted"></i>
            </span> Roles </h3>
            <a href="{{route('rol.create')}}" class="btn btn-danger btn-icon-text"><i class="mdi mdi-file-check btn-icon-prepend"></i>Añadir Rol</a>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Roles Registrados en el sistema</h4>
                        <div class="table-responsive">
                            <table id="TablaRol" class="table table-hover table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre de Rol</th>
                                        <th>Editar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($roles as $rol)
                                    <tr>
                                        <td>{{ $roles->ID_Rol }}</td>
                                        <td>{{ $roles->Nombre_Rol }}</td>
                                        <td> <a href="{{ URL::route('nomina.rol.edit', $roles->ID_Rol)}}" class="btn btn-success btn-fw-success btn-rounded btn-icon-text normalizarboton"><i class="mdi mdi-table-edit"></i></a></td>
                                        <td> <button type="button" onclick="EliminarRol({{ $roles->ID_Rol}},'{{URL::route('nomina.rol.index')}}')" class="btn btn-dark btn-fw-success btn-rounded btn-icon"><i class="mdi mdi-delete"></i></button></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection