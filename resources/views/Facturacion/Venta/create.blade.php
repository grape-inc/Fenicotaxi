@extends('layouts.layout')
@push('scripts-vista')
    <script type="text/javascript" src="{{ URL::asset ('js/Eventos/FacturaVentas.js') }}"></script>
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
            <button id="ActualizarDatos" class="btn btn-info btn-icon-text"><i class="mdi mdi mdi-refresh "></i> Actualizar Datos</button>
            <a href="{{ URL::route('Venta.index')}}" class="btn btn-danger btn-icon-text"><i class="mdi mdi-keyboard-backspace"></i> Regresar </a>
        </div>
    </div>
    <div class="row" style="overflow-x:scroll;">
    {{ Form::open(array('url' => URL::route('Venta.store'), 'method' => 'post'))}}
        @csrf
        @include('flash::message')
        <input type="hidden" id="tasa_cambio" value="{{ $tasa_Cambio }}">
        <input type="hidden" name="ID_Jornada" id="tasa_cambio" value="{{ $id_jornada }}">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                 <div class="card-body">
                <h4 class="card-title">Formulario de creación de Facturas</h4>
                <p class="card-description">Completa los campos para generar factura</p>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <a target="_blank" class="link" href="{{ URL::route('Cliente.create')}}">Cliente</a>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-sm btn-primary" type="button">
                                            <i class="mdi mdi-upload-network-outline"></i>
                                        </button>
                                    </div>
                                    <select id="ID_Cliente" name="ID_Cliente" class="selectpicker form-control" title="Escoja el cliente..." data-live-search="true">
                                        @foreach ($cliente as $client)
                                    <option value="{{ $client->ID_Cliente}}">{{$client->Nombre_Cliente}} {{ $client->Apellido_Cliente}}</option>
                                        @endforeach
                                    </select>
                                @error('ID_Cliente')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
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
                                        <input value="{{ $CF[0]->CodigoFactura + 1  }}" type="text" class="form-control" name="Codigo_Factura" placeholder="Ingrese el codigo de la factura">
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
                                @error('ID_Divisa')
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
                            </div>
                            @error('ID_Empleado')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
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
                                        <input type="text" class="form-control" name="Descripcion_Factura" placeholder="Ingrese una observación para la factura.">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                {{Form::label('Es_Credito', 'Tipo Factura')}}
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    </div>
                                    <div class="form-check form-check-flat form-check-primary">
                                        <label class="form-check-label">
                                        <input name="Es_Credito" id="Es_Credito" type="checkbox" class="form-check-input"> ¿Es credito?<i class="input-helper"></i></label>
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
                                        <input id="Descuento" type="number" min="0" max="100" value="0" class="form-control" name="Descuento" placeholder="Ingrese el descuento">
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
                                        <input id="SubTotal" type="text" class="form-control" name="SubTotal" placeholder="Subtotal" readonly>
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
                                        <input id="Total" type="text" class="form-control" name="Total_Facturado" placeholder="Total facturado" readonly>
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
                                        <input id="IVA" type="text" class="form-control" name="IVA" placeholder="IVA" readonly>
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
                        <div class="col-xl-12">
                            <h4 class="card-title">Productos</h4>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                {{Form::label('ID_ProductoLabel', 'Nombre del Producto')}}
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-sm btn-primary" type="button">
                                            <i class="mdi mdi-account-box"></i>
                                        </button>
                                    </div>
                                    <select onchange="selected()" id="ID_Producto" name="ID_Producto" class="selectpicker form-control" title="Escoja el producto..." data-live-search="true">
                                        @foreach ($producto as $prod)
                                            <option value="{{ $prod->ID_Producto}}">{{$prod->producto}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('ID_Producto')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                {{Form::label('CantidadLabel', 'Cantidad')}}
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-sm btn-primary" type="button">
                                            <i class="mdi mdi-account-box"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control" id="Cantidad" name="Cantidad" placeholder="Cantidad">
                                </div>
                                @error('Cantidad')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                {{Form::label('Existencias', 'Existencias')}}
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-sm btn-primary" type="button">
                                            <i class="mdi mdi-account-box"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control" id="Existencias"  placeholder="Existencias del producto" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                {{Form::label('Precio', 'Precio')}}
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-sm btn-primary" type="button">
                                            <i class="mdi mdi-account-box"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control" id="Precio" name="Precio" placeholder="Precio de venta">
                                </div>
                                @error('Precio')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-md btn-dark" id="Agregar" type="button">
                                            Agregar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Tabla de productos agregados --}}
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="TablaDetalle" class="table table-hover table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>ID Producto</th>
                                            <th>Nombre Producto</th>
                                            <th>Cantidad</th>
                                            <th>Existencias Actuales</th>
                                            <th>Precio</th>
                                            <th>Moneda</th>
                                            <th>Observación</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    {{-- Cuerpo de la tabla --}}
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="pagos_contado" class="col-md-12 grid-margin stretch-card">
            <div class="card">
            <div class="card-body">
                <h4 class="card-title">Detalle de Pagos</h4>
                    <div class="row">
                        <div class="col-xl-12">
                            <h4 class="card-title">Pagos</h4>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{Form::label('ID_Pago', 'Nombre del Pago')}}
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-sm btn-primary" type="button">
                                            <i class="mdi mdi mdi-diamond "></i>
                                        </button>
                                    </div>
                                    <select onchange="selected()" id="ID_Pago" name="ID_Pago" class="selectpicker form-control" title="Escoja el tipo de pago..." data-live-search="true">
                                        @foreach ($pagos as $pago)
                                            <option value="{{ $pago->ID}}">{{$pago->Tipo_Pago}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('ID_Pago')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{Form::label('ID_Divisa_Pago', 'Divisa del Pago')}}
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-sm btn-primary" type="button">
                                            <i class="mdi mdi-ticket"></i>
                                        </button>
                                    </div>
                                    <select onchange="selected()" id="ID_Divisa_Pago" name="ID_Divisa_Pago" class="selectpicker form-control" title="Escoja la divisa..." data-live-search="true">
                                        @foreach ($divisa as $div)
                                            <option value="{{ $div->ID_Divisa}}">{{$div->Nombre_Divisa}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('ID_Divisa_Pago')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{Form::label('Monto_Pago', 'Monto a Pagar')}}
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-sm btn-primary" type="button">
                                            <i class="mdi mdi-account-box"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control" id="Monto_Pago" name="Monto_Pago" placeholder="Ingrese el monto a pagar">
                                </div>
                                @error('Monto_Pago')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-md btn-dark" id="Agregar_Pago" type="button">
                                            Agregar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Tabla de productos agregados --}}
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="TablaDetallePagos" class="table table-hover table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Acción</th>
                                            <th>Tipo de Pago</th>
                                            <th>Moneda</th>
                                            <th>Monto</th>
                                        </tr>
                                    </thead>
                                    {{-- Cuerpo de la tabla --}}
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="float:right">
            <div style="margin-left:-400px;" class="row">
                <span style="font-size: 20px;font-weight: bold;" id="total_factura">Total Facturado : 0</span>
            </div>
            <div style="margin-left:-400px;" class="row mt-2">
                <span style="font-size: 20px;font-weight: bold;" id="total_pendiente">Monto Pendiente : 0</span>
            </div>
        </div>
        <div style="clear: right;" class="row justify-content-center mt-4">
            <button type="submit" class="btn btn-gradient-dark btn-icon-text text-center"> Generar Venta <i class="mdi mdi-file-check btn-icon-append"></i></button>
        </div>
    </div>
    {{ Form::close() }}
</div>
@endsection
