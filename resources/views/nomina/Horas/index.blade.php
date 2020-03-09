@extends('layouts.layout')
@push('scripts-vista')
    <script type="text/javascript" src="{{ URL::asset ('js/Eventos/Horas.js') }}"></script>
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
            </span> Horas laboradas de los empleados </h3>
            <a href="{{ URL::route('Horas.create')}}" class="btn btn-danger btn-icon-text"><i class="mdi mdi-file-check btn-icon-prepend"></i>Añadir Horas</a>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Horas Laborales registradas en el sistema</h4>
                        <div class="table-responsive">
                            <table id="TablaHoras" class="table table-hover table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID Empleado</th>
                                        <th>Nombre del empleado</th>
                                        <th>Fecha de registro</th>
                                        <th>Horas Laboradas</th>
                                        <th>Editar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($Horas as $Emp)
                                    <tr>
                                        <td>#{{ $Emp->ID_Empleado }}</td>
                                        <td>{{ $Emp->Nombre_Empleado }}</td>
                                        <td>{{ $Emp->Fecha_Registro }}</td>
                                        <td>{{ $Emp->Horas_Laboradas }} Horas</td>
                                        <td> <a href="{{ URL::route('Horas.edit', [$Emp->ID_Empleado,'Fecha_Registro'=>$Emp->Fecha_Registro])}}" class="btn btn-success btn-fw-success btn-rounded btn-icon-text normalizarboton"><i class="mdi mdi-table-edit"></i></a></td>
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