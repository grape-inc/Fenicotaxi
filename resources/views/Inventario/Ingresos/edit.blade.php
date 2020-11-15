@extends('layouts.layout')
@push('scripts-vista')
    <script type="text/javascript" src="{{ URL::asset ('js/Eventos/FacturaVentas.js') }}"></script>
    <script>        
        $('#ID_Divisa').val({{$Ingreso->ID_Divisa}});
        $('#ID_Empleado').val({{$Ingreso->ID_Empleado}});
        $('#ID_Proveedor').val({{$Ingreso->ID_Proveedor}});        
    </script>
@endpush
@section('content')
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
                        <p class="card-description">Ver Detalles de Ingresos</p>
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
                                        <select id="ID_Proveedor" name="ID_Proveedor" class="selectpicker form-control" title="Escoja el Proveedor..." data-live-search="true">
                                            @foreach ($Proveedor as $prov)
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
                                        <select id="ID_Empleado" name="ID_Empleado" class="selectpicker form-control" title="Escoja el empleado..." data-live-search="true">
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
                                            <input type="number" class="form-control" name="Codigo_Ingreso" value="{{ $Ingreso-> Codigo_Ingreso }}" placeholder="Codigo del ingreso" >
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
                                            <input type="text" class="form-control" name="Total" id="Total" value="{{ $Ingreso-> Total }}" placeholder="Total facturado" readonly>
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
                                                <option value="{{ $div->ID_Divisa}}">{{$div->Nombre_Divisa}}</option>
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
                                                        
                            {{-- Tabla de productos agregados --}}
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="TablaDetalle" class="table table-hover table-bordered">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>ID Producto</th>
                                                <th>Nombre Producto</th>
                                                <th>Cantidad</th>
                                                <th>Moneda</th>
                                                <th>SubTotal</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        @foreach($Detalle as $dt)
                                            <tr>
                                                <td>{{ $dt->ID_Producto }}</td>
                                                <td>{{ $dt->Nombre_Producto }}</td>
                                                <td>{{ $dt->Cantidad }}</td>
                                                <td>{{ $dt->Nombre_Divisa }}</td>
                                                <td>{{ $dt->Precio }}</td>
                                                <td>{{ $dt->Precio * 1.15 }}</td>                                                
                                            </tr>
                                        @endforeach
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    {{ Form::close() }}
</div>
@endsection