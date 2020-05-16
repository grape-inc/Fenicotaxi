@extends('layouts.layout')
@push('scripts-vista')
    <script type="text/javascript" src="{{ URL::asset ('js/Eventos/Ingresos.js') }}"></script>
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
                                        <th>Vendedor</th>
                                        <th>Divisa</th>
                                        <th>Fecha Realizacion</th>
                                        <th>Porcentaje de impuesto</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($ingresos as $ingreso)
                                    <tr>
                                        <td>{{ $ingreso->ID_Ingreso }}</td>
                                        <td>{{ $ingreso->Nombre_Proveedor }}</td>
                                        <td>{{ $ingreso->Nombre_Empleado }}</td>
                                        <td>{{ $ingreso->Nombre_Divisa }}</td>
                                        <td>{{ $ingreso->Fecha_Realizacion }}</td>
                                        <td>{{ ($ingreso->Impuesto) * 100 }}%</td>
                                        <td>{{ $ingreso->Total }} C$</td>
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