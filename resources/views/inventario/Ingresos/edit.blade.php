@extends('layouts.layout')
@push('scripts-vista')
    <script type="text/javascript" src="{{ URL::asset ('js/Eventos/IngresoDetalle.js') }}"></script>
@endpush
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-format-list-bulleted"></i>
        </span> Ingreso</h3>
        <a type="button" href="{{ URL::route('Ingresos.index')}}" class="btn btn-danger btn-icon-text"><i class="mdi mdi-keyboard-backspace"></i> Regresar </a>
    </div>
{{ Form::open(array('url' => URL::route('Ingresos.update', $ingreso->ID_Ingreso), 'method' => 'put'))}}
    {{ csrf_field() }}
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Formulario de ingresos</h4>
                        <p class="card-description">Completa los campos para editar ingreso</p>
                        <div class="row">
                            <div class="col-xl-12">

                                <div class="form-group">
                                    {{Form::label('ID_Producto', 'Identificador')}}
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-sm btn-primary" type="button">
                                                <i class="mdi mdi-sim-alert"></i>
                                            </button>
                                        </div>
                                        {{ Form::text('ID_Ingreso',$ingreso->ID_Ingreso,array('id'=>'ID_Ingreso','class'=>'form-control','readonly','placeholder'=>'Autogenerado'))}}
                                    </div>
                                </div>

                                <div class="form-group">
                                    {{Form::label('ID_Proveedor', 'Proveedor')}}
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-sm btn-primary" type="button">
                                                <i class="mdi mdi-upload-network-outline"></i>
                                            </button>
                                        </div>
                                        <select name="ID_Proveedor" class="selectpicker form-control" title="Escoja el Proveedor..." data-live-search="true">
                                            @foreach ($proveedor as $prov)
                                                <option value="{{$prov->ID_Proveedor}}"
                                                    {{ $ingreso->ID_Proveedor == $prov->ID_Proveedor ? 'selected="selected"' : '' }}>
                                                    {{$prov->Nombre_Proveedor}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('ID_Proveedor')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-md-6">
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
                                                <option value="{{ $emp->ID_Empleado }}"
                                                    {{ $ingreso->ID_Empleado == $emp->ID_Empleado ? 'selected="selected"' : '' }}>
                                                    {{$emp->Nombre_Empleado}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('ID_Empleado')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{Form::label('Impuestolabel', 'Impuesto')}}
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-sm btn-primary" type="button">
                                                <i class="mdi mdi-upload-network-outline"></i>
                                            </button>
                                        </div>
                                        <input type="number" step="0.01" class="form-control" id="Impuesto" name="Impuesto" value="0.15" placeholder="Ingrese el impuesto" readonly>
                                    </div>
                                    @error('Impuesto')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{Form::label('CodIngreso', 'Codigo Ingreso')}}
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-sm btn-primary" type="button">
                                                <i class="mdi mdi-upload-network-outline"></i>
                                            </button>
                                        </div>
                                        {{ Form::text('Codigo_Ingreso',$ingreso->Codigo_Ingreso,array('id'=>'Codigo_Ingreso','class'=>'form-control','placeholder'=>'Codigo del ingreso'))}}
                                    </div>
                                    @error('Codigo_Ingreso')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{Form::label('Total', 'Total')}}
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-sm btn-primary" type="button">
                                                <i class="mdi mdi-upload-network-outline"></i>
                                            </button>
                                        </div>
                                        {{ Form::text('Total',$ingreso->Total,array('id'=>'Total','class'=>'form-control','readonly','placeholder'=>'Total'))}}
                                    </div>
                                    @error('Total')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{Form::label('ID_Divisa', 'Tipo de divisa')}}
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-sm btn-primary" type="button">
                                                <i class="mdi mdi-cash-register"></i>
                                            </button>
                                        </div>
                                        <select id="ID_Divisa" name="ID_Divisa" class="selectpicker form-control" title="Escoja la divisa..." data-live-search="true">
                                            @foreach ($divisa as $div)
                                                <option value="{{ $div->ID_Divisa }}"
                                                    {{ $ingreso->ID_Divisa == $div->ID_Divisa ? 'selected="selected"' : '' }}>
                                                    {{$div->Nombre_Divisa}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('ID_Divisa')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{-- Low Container --}}
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Detalle de Productos</h4>
                        <div class="row">
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
                            <div class="col-md-4">
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
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{Form::label('Precio', 'Precio de Compra')}}
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
                                                <th>Eliminar</th>
                                                <th>Nombre Producto</th>
                                                <th>Cantidad</th>
                                                <th>Precio</th>
                                                <th>Moneda</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($ingreso_detalle as $key => $ingreso_detalle)
                                            <tr class="selected" id="{{'Fila'.$key}}">
                                                <input type="hidden" name="ingreso_detalles[{{$key}}][ID]" value="{{$ingreso_detalle->ID}}">
                                                <td><button type="button" class="btn btn-warning" onclick="eliminar({{ $key }});">X</button></td>
                                                <td><input type="hidden" name="ingreso_detalles[{{$key}}][ID_Producto]" value="{{$ingreso_detalle->ID_Producto}}">{{$ingreso_detalle->producto->displayName()}}</td>
                                                <td><input class="Cantidad" style="text-align: right;" type="number" name="ingreso_detalles[{{$key}}][Cantidad]" value="{{$ingreso_detalle->Cantidad}}"></td>
                                                <td class="PrecioHeader"><input class="Precio" style="text-align: right;" type="number" name="ingreso_detalles[{{$key}}][Precio]" value="{{$ingreso_detalle->Precio}}"></td>
                                                <td class="DivisaHeader"><input class="Divisa" type="hidden" value="{{$ingreso->ID_Divisa}}">{{$ingreso->divisa->displayName()}}</td>
                                                <td class="SubTotal" style="text-align: right;">{{$ingreso_detalle->subtotal()}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-4">
                            <button type="submit" class="btn btn-gradient-dark btn-icon-text text-center"> Generar Ingreso <i class="mdi mdi-file-check btn-icon-append"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{ Form::close() }}
</div>
@endsection
