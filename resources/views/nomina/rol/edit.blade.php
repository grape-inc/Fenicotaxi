@extends('layouts.layout')
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-format-list-bulleted"></i>
        </span> Roles</h3>
        <button type="button" class="btn btn-danger btn-icon-text"><i class="mdi mdi-keyboard-backspace"></i> Regresar </button>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Formulario de creación de Roles</h4>
                <p class="card-description">Completa los campos para editar el rol</p>
                {{ Form::open(array('url' => URL::route('rol.update', $roles->ID_Rol), 'method' => 'put'))}}
                    @csrf
                    <div class="form-group">
                        {{Form::label('ID_Rol', 'ID del rol')}}
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button class="btn btn-sm btn-primary" type="button">
                                    <i class="mdi mdi-account-outline"></i>
                                </button>
                            </div>
                                <input type="text" class="form-control" placeholder="Identificador Autogenerado" readonly value = "{{$roles->ID_Rol}}">
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('Nombre_Rol', 'Nombre del Rol')}}
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button class="btn btn-sm btn-primary" type="button">
                                    <i class="mdi mdi-account-box"></i>
                                </button>
                            </div>
                                <input type="text" class="form-control" placeholder="Ingrese el nombre del Rol" name="Nombre_Rol" value = "{{$roles->ID_Rol}}">
                        </div>
                        @error('Nombre_Rol')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                    <div class="row justify-content-center">
                        <button type="submit" class="btn btn-gradient-dark btn-icon-text text-center"> Actualizar Rol <i class="mdi mdi-file-check btn-icon-append"></i></button>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection