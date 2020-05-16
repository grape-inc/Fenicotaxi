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
{{ Form::open(array('url' => URL::route('Ingresos.store'), 'method' => 'post'))}}
    {{ csrf_field() }}
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Formulario de ingresos</h4>
                        <p class="card-description">Completa los campos para generar ingreso</p>
                        <div class="row">
                            <div class="col-xl-12">
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
                                                <option value="{{ $prov->ID_Proveedor}}">{{$prov->Nombre_Proveedor}}</option>
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
                                                <option value="{{ $emp->ID_Empleado}}">{{$emp->Nombre_Empleado}}</option>
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
                                            <input type="number" class="form-control" name="Codigo_Ingreso" placeholder="Codigo del ingreso" >
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
                                            <input type="text" class="form-control" name="Total" id="Total" placeholder="Total facturado" readonly>
                                    </div>
                                    @error('Total')
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
                                    {{Form::label('Precio de compra', 'Precio')}}
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
                                                <th>Precio</th>
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