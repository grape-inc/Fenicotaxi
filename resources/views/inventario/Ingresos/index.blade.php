@extends('layouts.layout')
@push('scripts-vista')
    <script type="text/javascript" src="{{ URL::asset ('js/Eventos/Ingresos.js') }}"></script>
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
            </span> Ingresos </h3>
            <a href="{{route('Ingresos.create')}}" class="btn btn-danger btn-icon-text"><i class="mdi mdi-file-check btn-icon-prepend"></i>Realizar Ingreso</a>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Ingresos registrados en el sistema</h4>
                        <div class="table-responsive">
                            <table id="TablaIngreso" class="table table-hover table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Numero Ingreso</th>
                                        <th>Proveedor</th>
                                        <th>Empleado</th>
                                        <th>Vendedor</th>
                                        <th>Fecha Realizacion</th>
                                        <th>Impuesto</th>
                                        <th>Total</th>
                                        <th>Editar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($ingresos as $ingreso)
                                    <tr>
                                        <td>{{ $ingreso->ID_Ingreso }}</td>
                                        <td>{{ $ingreso->Nombre_Proveedor }}</td>
                                        <td>{{ $ingreso->Nombre_Empleado }}</td>
                                        <td>{{ $ingreso->Fecha_Realizacion }}</td>
                                        <td>{{ $ingreso->Impuesto }}</td>
                                        <td>{{ $ingreso->Total }}</td>
                                        <td> <a href="{{ URL::route('Ingresos.edit', $ingreso->ID_Ingreso)}}" class="btn btn-success btn-fw-success btn-rounded btn-icon-text normalizarboton"><i class="mdi mdi-table-edit"></i></a></td>
                                        <td> <button type="button" onclick="EliminarArqueo({{ $ingreso->ID_Ingreso}},'{{URL::route('Ingresos.index')}}')" class="btn btn-dark btn-fw-success btn-rounded btn-icon"><i class="mdi mdi-delete"></i></button></td>
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