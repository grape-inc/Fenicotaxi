@extends('layouts.layout')
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-format-list-bulleted"></i>
        </span> Roles</h3>
        <a type="button" href="{{ URL::route('Rol.index')}}" class="btn btn-danger btn-icon-text"><i class="mdi mdi-keyboard-backspace"></i> Regresar </a>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Formulario de creación de roles</h4>
                <p class="card-description">Completa los campos para crear el rol</p>
                {{ Form::open(array('url' => URL::route('Rol.store'), 'method' => 'post'))}}
                    @csrf
                    <div class="form-group">
                        {{Form::label('ID_Rol', 'ID del Rol')}}
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button class="btn btn-sm btn-primary" type="button">
                                    <i class="mdi mdi-account-badge-horizontal"></i>
                                </button>
                            </div>
                                <input type="text" class="form-control" placeholder="Identificador Autogenerado" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('Nombre_rol', 'Nombre del rol')}}
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button class="btn btn-sm btn-primary" type="button">
                                    <i class="mdi mdi-account-box"></i>
                                </button>
                            </div>
                                <input type="text" class="form-control" placeholder="Ingrese el nombre del Rol" name="Nombre_Rol">
                        </div>
                        @error('Nombre_Rol')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    </div>
                    <div class="row justify-content-center">
                        <button type="submit" class="btn btn-gradient-dark btn-icon-text text-center"> Crear Rol<i class="mdi mdi-file-check btn-icon-append"></i></button>
                    </div>
                    {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection