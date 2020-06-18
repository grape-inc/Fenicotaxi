@extends('layouts.layout')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-format-list-bulleted"></i>
            </span> Empleados </h3>
            <a href="{{ URL::route('Empleado.index')}}" class="btn btn-danger btn-icon-text"><i class="mdi mdi-keyboard-backspace"></i> Regresar </a>
        </div>
        @include('flash::message')
        {{Form::open(array('url' => URL::route('Empleado.store'), 'method' => 'post', 'files' => true))}}
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Formulario de creación de empleados</h4>
                        <p class="card-description">Completa los campos para crear el empleado</p>
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <img id="ImagenEmpleado" name="Imagen" src="{{{asset('images/dummy.jpg')}}}" style="height:300px;" alt="ImagenProducto" class="img-thumbnail mx-auto d-block">
                                    </div>
                                    <div class="row justify-content-center">
                                        {{Form::label('Imagen', 'Cambiar Imagen',['class' => 'btn btn-gradient-dark btn-icon-text text-center','files' => true])}}
                                        <input type="file" class="Imagen" id="Imagen" name="Imagen" accept="image/png,image/jpg,image/jpeg" onchange="document.getElementById('ImagenEmpleado').src = window.URL.createObjectURL(this.files[0])" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{Form::label('ID_Empleado', 'Identificador')}}
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-sm btn-primary" type="button">
                                                    <i class="mdi mdi-sim-alert"></i>
                                                </button>
                                            </div>
                                            {{ Form::text('ID_Empleado','',array('id'=>'ID_Empleado','class'=>'form-control','readonly','placeholder'=>'Autogenerado'))}}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {{Form::label('Nombre_Empleado', 'Nombre del empleado')}}
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-sm btn-primary" type="button">
                                                    <i class="mdi mdi-account-box"></i>
                                                </button>
                                            </div>
                                            {{ Form::text('Nombre_Empleado','',array('id'=>'Nombre_Empleado','class'=>'form-control','placeholder'=>'Ingresa el nombre del empleado'))}}
                                        </div>

                                        @error('Nombre_Empleado')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        {{Form::label('Apellido_Empleado', 'Apellido del empleado')}}
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-sm btn-primary" type="button">
                                                    <i class="mdi mdi-account-box"></i>
                                                </button>
                                            </div>
                                            {{ Form::text('Apellido_Empleado','',array('id'=>'Apellido_Empleado','class'=>'form-control','placeholder'=>'Ingresa el apelido del empleado'))}}
                                        </div>

                                        @error('Apellido_Empleado')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        {{Form::label('Fecha_Nacimiento', 'Fecha de nacimiento')}}
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-sm btn-primary" type="button">
                                                    <i class="mdi mdi-apps-box"></i>
                                                </button>
                                            </div>
                                            {{ Form::date('Fecha_Nacimiento','2000-01-01',array('id'=>'Fecha_Nacimiento','class'=>'form-control','placeholder'=>'Ingresa la fecha de nacimiento'))}}
                                        </div>

                                        @error('Fecha de nacimiento')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{Form::label('Cedula', 'Cedula')}}
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-sm btn-primary" type="button">
                                                    <i class="mdi mdi-file-document-box"></i>
                                                </button>
                                            </div>
                                            {{ Form::text('Cedula','',array('id'=>'Cedula','class'=>'form-control','placeholder'=>'Ingresa la cedula'))}}
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
                                                    <i class="mdi mdi-gmail"></i>
                                                </button>
                                            </div>
                                            {{ Form::text('Correo','',array('id'=>'Correo','class'=>'form-control','placeholder'=>'Ingresa el correo'))}}
                                        </div>

                                        @error('Correo')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        {{Form::label('ID_Cargo', 'Cargo')}}
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-sm btn-primary" type="button">
                                                    <i class="mdi mdi-google-circles-extended"></i>
                                                </button>
                                            </div>
                                            <select name="ID_Cargo" class="selectpicker form-control" data-live-search="true">
                                                @foreach ($Cargos as $C)
                                                    <option value="{{ $C->ID_Cargo}}">{{$C->Nombre_Cargo}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('ID_Cargo')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        {{Form::label('ID_Rol', 'Rol')}}
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-sm btn-primary" type="button">
                                                    <i class="mdi mdi-diamond"></i>
                                                </button>
                                            </div>
                                            <select name="ID_Rol" class="selectpicker form-control" data-live-search="true">
                                                @foreach ($Roles as $R)
                                                    <option value="{{ $R->ID_Rol}}">{{$R->Nombre_Rol}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('ID_Cargo')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                </div>
                    </div>
                    <div class="row justify-content-center">
                        <button type="submit" class="btn btn-gradient-dark btn-icon-text text-center"> Crear Empleado<i class="mdi mdi-file-check btn-icon-append"></i></button>
                    </div>
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>
@endsection