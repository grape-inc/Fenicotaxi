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
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($Roles as $rol)
                                    <tr>
                                        <td>{{ $rol->ID_Rol }}</td>
                                        <td>{{ $rol->Nombre_Rol }}</td>
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