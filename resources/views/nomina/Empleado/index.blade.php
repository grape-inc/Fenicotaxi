@extends('layouts.layout')
@push('scripts-vista')
    <script type="text/javascript" src="{{ URL::asset ('js/Eventos/Empleado.js') }}"></script>
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
            </span> Empleados </h3>
            <a href="{{route('Empleado.create')}}" class="btn btn-danger btn-icon-text"><i class="mdi mdi-file-check btn-icon-prepend"></i>Añadir Empleado</a>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Empleados Registrados en el sistema</h4>
                        <div class="table-responsive">
                            <table id="TablaEmpleados" class="table table-hover table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Imagen</th>
                                        <th>Nombre de Empleado</th>
                                        <th>Apellido de Empleado</th>
                                        <th>Fecha de nacimiento</th>
                                        <th>Cedula</th>
                                        <th>Correo</th>
                                        <th>Cargo</th>
                                        <th>Editar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($Empleado as $Emp)
                                    <tr>
                                        <td>{{ $Emp->ID_Empleado }}</td>
                                        @if($Emp->Imagen != "")
                                            <td><img class="ImagenTamañoTabla" src ="data:image/png;base64,{{$Emp->Imagen}}"/></td>
                                        @else
                                             <td><img class="ImagenTamañoTabla" src="{{{asset('images/dummy.jpg')}}}"/></td>
                                        @endif
                                        <td>{{ $Emp->Nombre_Empleado }}</td>
                                        <td>{{ $Emp->Apellido_Empleado }}</td>
                                        <td>{{ $Emp->Fecha_Nacimiento }}</td>
                                        <td>{{ $Emp->Cedula }}</td>
                                        <td>{{ $Emp->Correo}}</td>
                                        <td>{{ $Emp->Nombre_Cargo}}</td>
                                        <td> <a href="{{ URL::route('Empleado.edit', $Emp->ID_Empleado)}}" class="btn btn-success btn-fw-success btn-rounded btn-icon-text normalizarboton"><i class="mdi mdi-table-edit"></i></a></td>
                                        <td> <button type="button" onclick="EliminarEmpleado({{ $Emp->ID_Empleado}},'{{ URL::route('Empleado.index')}}')" class="btn btn-dark btn-fw-success btn-rounded btn-icon"><i class="mdi mdi-delete"></i></button></td>
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