@extends('layouts.layout')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-format-list-bulleted"></i>
            </span> Proveedores </h3>
            <a href="{{ URL::route('Proveedores.index')}}" class="btn btn-danger btn-icon-text"><i class="mdi mdi-keyboard-backspace"></i> Regresar </a>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Formulario de creación de proveedores</h4>
                    <p class="card-description">Completa los campos para crear el proveedor</p>
                    {{ Form::open(array('url' => URL::route('Proveedores.store'), 'method' => 'post'))}}
                        {{ csrf_field() }}
                        <div class="form-group">
                            {{Form::label('ID_Proveedor', 'Identificador')}}
                            <div class="input-group">                            
                                <div class="input-group-prepend">
                                    <button class="btn btn-sm btn-primary" type="button">
                                        <i class="mdi mdi-sim-alert"></i>
                                    </button>
                                </div>
                                {{ Form::text('ID_Proveedor','',array('id'=>'ID_Proveedor','class'=>'form-control','readonly','placeholder'=>'Autogenerado'))}}
                            </div>
                        </div>
                        <div class="form-group">
                            {{Form::label('Nombre_Proveedor', 'Nombre del proveedor')}}
                            <div class="input-group">                                
                                <div class="input-group-prepend">
                                    <button class="btn btn-sm btn-primary" type="button">
                                        <i class="mdi mdi-ticket"></i>
                                    </button>
                                </div>
                                {{ Form::text('Nombre_Proveedor','',array('id'=>'Nombre_Proveedor','class'=>'form-control','placeholder'=>'Ingresa el nombre del proveedor'))}}
                            </div>

                            @error('Nombre_Proveedor')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>                        
                        <div class="form-group">
                            {{Form::label('Direccion_Proveedor', 'Dirección del proveedor')}}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="btn btn-sm btn-primary" type="button">
                                        <i class="mdi mdi-sort-variant"></i>
                                    </button>
                                </div>
                                {{ Form::text('Direccion_Proveedor','',array('id'=>'Direccion_Proveedor','class'=>'form-control','placeholder'=>'Ingresa la dirección del proveedor'))}}
                            </div>
                            @error('Direccion_Proveedor')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            {{Form::label('Telefono', 'Telefono del proveedor')}}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="btn btn-sm btn-primary" type="button">
                                        <i class="mdi mdi-cellphone"></i>
                                    </button>
                                </div>
                                {{ Form::text('Telefono','',array('id'=>'Telefono','class'=>'form-control','placeholder'=>'Ingresa el telefono del proveedor'))}}
                            </div>
                            @error('Telefono')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            {{Form::label('Contacto_Proveedor', 'Contacto del proveedor')}}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="btn btn-sm btn-primary" type="button">
                                        <i class="mdi mdi-account"></i>
                                    </button>
                                </div>
                                {{ Form::text('Contacto_Proveedor','',array('id'=>'Contacto_Proveedor','class'=>'form-control','placeholder'=>'Ingresa el contacto del proveedor'))}}
                            </div>
                            @error('Contacto_Proveedor')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="row justify-content-center">
                            <button type="submit" class="btn btn-gradient-dark btn-icon-text text-center"> Crear Proveedor<i class="mdi mdi-file-check btn-icon-append"></i></button>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection