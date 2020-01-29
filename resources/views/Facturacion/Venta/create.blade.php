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
        <a type="button" href="{{ URL::route('Venta.index')}}" class="btn btn-danger btn-icon-text"><i class="mdi mdi-keyboard-backspace"></i> Regresar </a>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Formulario de creación de caja</h4>
                <p class="card-description">Completa los campos para generar factura</p>
                {{ Form::open(array('url' => URL::route('Venta.store'), 'method' => 'post'))}}
                    @csrf
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
                                    <select name="ID_Cliente" class="selectpicker form-control" title="Escoja el empleado..." data-live-search="true">
                                        @foreach ($cliente as $client)
                                            <option value="{{ $client->ID_Cliente}}">{{$client->Nombre_Cliente}}</option>
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
                                        <input type="text" class="form-control" name="Codigo_Factura" placeholder="Ingrese el codigo de la factura">
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
                                    <select name="ID_Divisa" class="selectpicker form-control" title="Escoja la divisa..." data-live-search="true">
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
                                    <select name="ID_Empleado" class="selectpicker form-control" title="Escoja el empleado..." data-live-search="true">
                                        @foreach ($empleado as $emp)
                                            <option value="{{ $emp->ID_Empleado}}">{{$emp->Nombre_Empleado}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('ID_Empleado')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
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
                                        <input type="text" class="form-control" name="Descuento" placeholder="Ingrese el descuento">
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
                                        <input type="text" class="form-control" name="SubTotal" placeholder="Subtotal">
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
                                        <input type="text" class="form-control" name="Total_Facturado" placeholder="Total facturado">
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Detalle De Factura --}}
                    <div class="row" style="outline: 1px solid purple; padding: 10px;">
                        <div class="col-xl-12">
                            <h4 class="card-title">Productos</h4>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{Form::label('ID_ProductoLabel', 'Nombre del Producto')}}
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-sm btn-primary" type="button">
                                            <i class="mdi mdi-account-box"></i>
                                        </button>
                                    </div>
                                    <select onchange="selected()" name="ID_Producto" class="selectpicker form-control" title="Escoja el producto..." data-live-search="true">
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
                        <div class="col-md-4">
                            <div class="form-group">
                                {{Form::label('Cantidad', 'Cantidad')}}
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-sm btn-primary" type="button">
                                            <i class="mdi mdi-account-box"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control" name="Cantidad" placeholder="Cantidad">
                                </div>
                                @error('Cantidad')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{Form::label('Precio_Venta', 'Precio')}}
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-sm btn-primary" type="button">
                                            <i class="mdi mdi-account-box"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control" name="Precio_Venta" placeholder="Precio de venta" readonly>
                                </div>
                                @error('Precio_Venta')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-md btn-dark" type="button">
                                            Agregar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Tabla de productos agregados --}}
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="TablaRol" class="table table-hover table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>ID Producto</th>
                                            <th>Nombre Producto</th>
                                            <th>Cantidad</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    {{-- Cuerpo de la tabla --}}
                                    <tbody>
                                        <tr>
                                            <td class="text-left">1</td>
                                            <td class="text-left">Reencauche</td>
                                            <td class="text-right">3</td>
                                            <td class="text-right">4</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <button type="submit" class="btn btn-gradient-dark btn-icon-text text-center mb-4"> Generar Factura<i class="mdi mdi-file-check btn-icon-append"></i></button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection