@extends('layouts.layout')
@push('scripts-vista')
    <script type="text/javascript" src="{{ URL::asset ('js/Eventos/FacturaVentasTabla.js') }}"></script>
    @if (Request()->ID)
        <script>
            $.ajax ({
                url: '../../../factura_pdf',
                method: 'GET',
                data:{id: {{Request()->ID}}},
                xhrFields: {
                    responseType: 'blob'
                },
            success: function (data) {
                var a = document.createElement('a');
                var url = window.URL.createObjectURL(data);
                a.href = url;
                a.download = 'Factura.pdf';
                document.body.append(a);
                a.click();
                a.remove();
                window.URL.revokeObjectURL(url);
                }
            });
        </script>
    @endif
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
            </span> Facturas </h3>
            @include('flash::message')
            <a href="{{route('Venta.create')}}" class="btn btn-danger btn-icon-text"><i class="mdi mdi-file-check btn-icon-prepend"></i>Realizar Venta</a>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Facturas de venta registradas en el sistema</h4>
                        <div class="table-responsive">
                            <table id="TablaVenta" class="table table-hover table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Codigo Factura</th>
                                        <th>Cliente</th>
                                        <th>Vendedor</th>
                                        <th>Tipo Factura</th>
                                        <th>Total Facturado</th>
                                        <th>Fecha Creacion</th>
                                        <th>Fecha Actualizacion</th>
                                        <th>Ver</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($facturaventa as $fv)
                                    <tr>
                                        <td>{{ $fv->Codigo_Factura }}</td>
                                        <td>{{ $fv->Nombre_Cliente }}</td>
                                        <td>{{ $fv->Nombre_Empleado }}</td>
                                        @if ($fv-> Es_Credito)
                                            <td>Credito</td>
                                        @else
                                            <td>Contado</td>
                                        @endif
                                        <td>{{ $fv->Total_Facturado }} C$</td>
                                        <td>{{ $fv->Fecha_Realizacion }}</td>
                                        <td>{{ $fv->Fecha_Actualizacion }}</td>
                                        <td> <a href="{{ URL::route('Venta.edit', $fv->ID_Factura)}}" class="btn btn-success btn-fw-success btn-rounded btn-icon-text normalizarboton"><i class="mdi mdi-table-edit"></i></a></td>
                                        <td> <button type="button" onclick="EliminarVenta({{ $fv->ID_Factura}},'{{URL::route('Venta.index')}}')" class="btn btn-dark btn-fw-success btn-rounded btn-icon"><i class="mdi mdi-delete"></i></button></td>
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