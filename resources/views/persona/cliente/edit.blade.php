@extends('layouts.layout')
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-format-list-bulleted"></i>
        </span> Clientes</h3>
        <button type="button" class="btn btn-danger btn-icon-text"><i class="mdi mdi-keyboard-backspace"></i> Regresar </button>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Formulario de creación de clientes</h4>
                <p class="card-description">Completa los campos para crear el cliente</p>                
                {{ Form::open(array('url' => URL::route('cliente.update', $cliente->ID_Cliente), 'method' => 'put'))}}
                    @csrf
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button class="btn btn-sm btn-primary" type="button">
                                    <i class="mdi mdi-sim-alert"></i>
                                </button>
                            </div>
                                <input type="text" class="form-control" placeholder="Identificador Autogenerado" readonly value = "{{$cliente->ID_Cliente}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button class="btn btn-sm btn-primary" type="button">
                                    <i class="mdi mdi-ticket"></i>
                                </button>
                            </div>
                                <input type="text" class="form-control" placeholder="Ingrese el nombre del cliente" name="Nombre_Cliente" value = "{{$cliente->Nombre_Cliente}}">
                        </div>
                        @error('Nombre_Cliente')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button class="btn btn-sm btn-primary" type="button">
                                    <i class="mdi mdi-sort-variant"></i>
                                </button>
                            </div>
                                <input type="text" class="form-control" placeholder="Ingresa apellido del cliente" name="Apellido_Cliente" value = "{{$cliente->Apellido_Cliente}}">
                        </div>                        
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button class="btn btn-sm btn-primary" type="button">
                                    <i class="mdi mdi-sort-variant"></i>
                                </button>
                            </div>
                                <input type="text" class="form-control" placeholder="Ingresa cedula del cliente" name="Cedula" value = "{{$cliente->Cedula}}">
                        </div>
                        @error('Cedula')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button class="btn btn-sm btn-primary" type="button">
                                    <i class="mdi mdi-sort-variant"></i>
                                </button>
                            </div>
                                <input type="email" class="form-control" placeholder="Ingresa el correo del cliente" name="Correo" value = "{{$cliente->Correo}}">
                        </div>
                        @error('Correo')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="row justify-content-center">
                        <button type="submit" class="btn btn-gradient-dark btn-icon-text text-center"> Crear Cliente<i class="mdi mdi-file-check btn-icon-append"></i></button>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection