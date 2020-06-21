@extends('layouts.layout')
@push('scripts-vista')
    <script type="text/javascript" src="{{ URL::asset ('js/Eventos/FacturaVentas.js') }}"></script>
    <script>
        $('#ID_Cliente').val({{$Factura->ID_Cliente}});
        $('#ID_Divisa').val({{$Factura->ID_Divisa}});
        $('#ID_Empleado').val({{$Factura->ID_Empleado}});
        $('#ID_Proveedor').val({{$Factura->ID_Proveedor}});
        if ({{$Factura->Es_Credito}} == true){
            $("#Es_Credito" ).prop( "checked", true );
        }
    </script>
@endpush
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-format-list-bulleted"></i>
        </span> Venta</h3>
        <div class="col-xs-4">
            <a href="../../../factura_pdf?id={{$Factura->ID_Factura}}" class="btn btn-info btn-icon-text"><i class="mdi mdi-file-pdf-box "></i> Descargar PDF </a>
            <a href="{{ URL::route('Venta.index')}}" class="btn btn-danger btn-icon-text"><i class="mdi mdi-keyboard-backspace"></i> Regresar </a>
        </div>
    </div>
    <div class="row">
    {{ Form::open(array('url' => URL::route('Venta.update', $Factura->ID_Factura), 'method' => 'put'))}}
        @csrf
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Formulario para ver Facturas</h4>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                {{Form::label('ID_Cliente', 'Cliente')}}
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-sm btn-primary" type="button">
                                            <i class="mdi mdi-upload-network-outline"></i>
                                        </button>
                                    </div>
                                    <select id="ID_Cliente"  name="ID_Cliente" class="selectpicker form-control" title="Escoja el cliente..." data-live-search="true">
                                        @foreach ($cliente as $client)
                                    <option value="{{ $client->ID_Cliente}}">{{$client->Nombre_Cliente}} {{ $client->Apellido_Cliente}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{Form::label('Codigo_Factura', 'Codigo De La Factura')}}
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-sm btn-primary" type="button">
                                            <i class="mdi mdi-upload-network-outline"></i>
                                        </button>
                                    </div>
                                <input value="{{ $Factura->Codigo_Factura }}" type="text" class="form-control" name="Codigo_Factura" placeholder="Ingrese el codigo de la factura">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{Form::label('ID_Divisa', 'Tipo de Divisa')}}
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-sm btn-primary" type="button">
                                            <i class="mdi mdi-cash-register"></i>
                                        </button>
                                    </div>
                                    <select id="ID_Divisa" name="ID_Divisa" class="selectpicker form-control" title="Escoja la divisa..." data-live-search="true">
                                        @foreach ($divisa as $div)
                                            <option value="{{ $div->ID_Divisa}}">{{$div->Nombre_Divisa}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('Saldo_Inicial')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{Form::label('ID_Empleado', 'Nombre del empleado')}}
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-sm btn-primary" type="button">
                                            <i class="mdi mdi-account-box"></i>
                                        </button>
                                    </div>
                                    <select id="ID_Empleado" name="ID_Empleado" class="selectpicker form-control" title="Escoja el empleado..." data-live-search="true">
                                        @foreach ($empleado as $emp)
                                            <option value="{{ $emp->ID_Empleado}}">{{$emp->Nombre_Empleado}} {{$emp->Apellido_Empleado}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('ID_Empleado')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{Form::label('Descripcion_Factura', 'Observación')}}
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-sm btn-primary" type="button">
                                            <i class="mdi mdi-message "></i>
                                        </button>
                                    </div>
                                        <input value="{{ $Factura->Observacion}}" type="text" class="form-control" name="Descripcion_Factura" placeholder="Ingrese una observación para la factura.">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{Form::label('Es_Credito', 'Tipo Factura')}}
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    </div>
                                    <div class="form-check form-check-flat form-check-primary">
                                        <label class="form-check-label">
                                        <input name="Es_Credito" id="Es_Credito" type="checkbox" class="form-check-input" > ¿Es credito?<i class="input-helper"></i></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {{Form::label('Descuento', 'Descuento')}}
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-sm btn-primary" type="button">
                                            <i class="mdi mdi-upload-network-outline"></i>
                                        </button>
                                    </div>
                                <input id="Descuento" type="number" min="0" max="100" value="{{ $Factura->Descuento }}" class="form-control" name="Descuento" placeholder="Ingrese el descuento">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{Form::label('SubTotal', 'Subtotal')}}
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-sm btn-primary" type="button">
                                            <i class="mdi mdi-upload-network-outline"></i>
                                        </button>
                                    </div>
                                        <input id="SubTotal" type="text" class="form-control" value="{{ $Factura->SubTotal }}" name="SubTotal" placeholder="Subtotal" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{Form::label('Total_Facturado', 'Total Facturado')}}
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-sm btn-primary" type="button">
                                            <i class="mdi mdi-upload-network-outline"></i>
                                        </button>
                                    </div>
                                        <input value="{{ $Factura->Total_Facturado }}" id="Total" type="text" class="form-control" name="Total_Facturado" placeholder="Total facturado" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{Form::label('IVA', 'IVA')}}
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-sm btn-primary" type="button">
                                            <i class="mdi mdi-upload-network-outline"></i>
                                        </button>
                                    </div>
                                        <input value="{{ $Factura->IVA }}" id="IVA" type="text" class="form-control" name="IVA" placeholder="IVA" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
            <div class="card-body">
                <h4 class="card-title">Detalle de Productos</h4>
                    <div class="row">
                        {{-- Tabla de productos agregados --}}
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="TablaDetalle" class="table table-hover table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Nombre Producto</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                            <th>Observación</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    {{-- Cuerpo de la tabla --}}
                                    <tbody>
                                     @foreach($FacturaVentaDetalle as $fd)
                                      <tr>
                                        <td>{{ $fd->Nombre_Producto }}</td>
                                        <td>{{ $fd->Cantidad }}</td>
                                        <td>{{ $fd->Precio}}</td>
                                        <td>{{ $fd->Observacion }}</td>
                                        <td>{{ $fd->Precio * $fd->Cantidad }}</td>
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
        @if($Factura->Es_Credito == false)
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Detalle de Pago</h4>
                        <div class="row">
                            {{-- Tabla de pago agregados --}}
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="TablaDetallePagos" class="table table-hover table-bordered">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Tipo de Pago</th>
                                                <th>Moneda</th>
                                                <th>Monto</th>
                                            </tr>
                                        </thead>
                                        {{-- Cuerpo de la tabla --}}
                                        <tbody>
                                        @foreach($FacturaPago as $fp)
                                        <tr>
                                            <td>{{ $fp->Tipo_Pago }}</td>
                                            <td>{{ $fp->Nombre_Divisa }}</td>
                                            <td>{{ $fp->monto}}</td>
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
        @endif
    </div>
    {{ Form::close() }}
</div>
@endsection