@extends('layouts.layout')
@push('scripts-vista')
    <script>
        $('#Cedula').mask('000-000000-0000A',
            { 'translation': {
                A: {pattern: /[A-Za-z]/}
            }
        });
    </script>
@endpush
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-format-list-bulleted"></i>
        </span> Clientes</h3>
        <a type="button" href="{{ URL::route('Cliente.index')}}" class="btn btn-danger btn-icon-text"><i class="mdi mdi-keyboard-backspace"></i> Regresar </a>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Formulario de creación de clientes</h4>
                <p class="card-description">Completa los campos para crear el cliente</p>
                {{ Form::open(array('url' => URL::route('Cliente.update', $cliente->ID_Cliente), 'method' => 'put'))}}
                    @csrf
                    <div class="form-group">
                        {{Form::label('ID_Cliente', 'ID del Cliente')}}
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button class="btn btn-sm btn-primary" type="button">
                                    <i class="mdi mdi-account-outline"></i>
                                </button>
                            </div>
                                <input type="text" class="form-control" placeholder="Identificador Autogenerado" readonly value = "{{$cliente->ID_Cliente}}">
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('Nombre_Cliente', 'Nombre del cliente')}}
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button class="btn btn-sm btn-primary" type="button">
                                    <i class="mdi mdi-account-box"></i>
                                </button>
                            </div>
                                <input type="text" class="form-control" placeholder="Ingrese el nombre del cliente" name="Nombre_Cliente" value = "{{$cliente->Nombre_Cliente}}">
                        </div>
                        @error('Nombre_Cliente')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        {{Form::label('Apellido_Cliente', 'Apellido del cliente')}}
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button class="btn btn-sm btn-primary" type="button">
                                    <i class="mdi mdi-account-box-multiple"></i>
                                </button>
                            </div>
                                <input type="text" class="form-control" placeholder="Ingresa apellido del cliente" name="Apellido_Cliente" value = "{{$cliente->Apellido_Cliente}}">
                        </div>
                        @error('Apellido_Cliente')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        {{Form::label('Cedula', 'Cedula del cliente')}}
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button class="btn btn-sm btn-primary" type="button">
                                    <i class="mdi mdi-account-badge-horizontal"></i>
                                </button>
                            </div>
                                <input id="Cedula" type="text" class="form-control" placeholder="Ingresa cedula del cliente" name="Cedula" value = "{{$cliente->Cedula}}">
                        </div>
                        @error('Cedula')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        {{Form::label('Correo', 'Correo')}}
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button class="btn btn-sm btn-primary" type="button">
                                    <i class="mdi mdi-at"></i>
                                </button>
                            </div>
                                <input type="email" class="form-control" placeholder="Ingresa el correo del cliente" name="Correo" value = "{{$cliente->Correo}}">
                        </div>
                        @error('Correo')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        {{Form::label('Direccion', 'Dirección del cliente')}}
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button class="btn btn-sm btn-primary" type="button">
                                    <i class="mdi mdi-crosshairs-gps "></i>
                                </button>
                            </div>
                            <input type="text" class="form-control" placeholder="Ingresa la dirección del cliente" name="Direccion" value = "{{$cliente->Direccion}}">
                        </div>
                        @error('Direccion')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="row justify-content-center">
                        <button type="submit" class="btn btn-gradient-dark btn-icon-text text-center"> Actualizar Cliente<i class="mdi mdi-file-check btn-icon-append"></i></button>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection