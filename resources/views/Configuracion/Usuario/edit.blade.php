@extends('layouts.layout')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-format-list-bulleted"></i>
            </span> Usuarios </h3>
            <a href="{{ URL::route('Usuarios.index')}}" class="btn btn-danger btn-icon-text"><i class="mdi mdi-keyboard-backspace"></i> Regresar </a>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Formulario de modificación de usuarios</h4>
                    <p class="card-description">Completa los campos para modificar el usuario</p>
                    {{ Form::open(array('url' => URL::route('Usuarios.update', $Usuario->ID_Empleado), 'method' => 'put'))}}
                        {{ csrf_field() }}
                        <div class="form-group">
                            {{Form::label('ID_Empleado', 'Identificador')}}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="btn btn-sm btn-primary" type="button">
                                        <i class="mdi mdi-sim-alert"></i>
                                    </button>
                                </div>
                                {{ Form::text('ID_Empleado',$Usuario->ID_Empleado,array('id'=>'ID_Empleado','class'=>'form-control','readonly'))}}
                            </div>
                        </div>
                        <div class="form-group">
                            {{Form::label('Usuario', 'Usuario')}}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="btn btn-sm btn-primary" type="button">
                                        <i class="mdi mdi-ticket"></i>
                                    </button>
                                </div>
                                {{ Form::text('Usuario',$Usuario->Usuario,array('id'=>'Usuario','class'=>'form-control','placeholder'=>'Ingresa el nombre que le asignaras a tu usuario'))}}
                            </div>

                            @error('Usuario')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            {{Form::label('Password', 'Contraseña del usuario')}}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="btn btn-sm btn-primary" type="button">
                                        <i class="mdi mdi-sort-variant"></i>
                                    </button>
                                </div>
                                {{ Form::password('Password',array('id'=>'Password','class'=>'form-control'))}}
                            </div>
                            @error('Password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row justify-content-center">                            
                            <button type="submit" class="btn btn-gradient-dark btn-icon-text text-center"> Actualizar Usuario<i class="mdi mdi-file-check btn-icon-append"></i></button>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection