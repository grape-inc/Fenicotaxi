@extends('layouts.layout')
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-format-list-bulleted"></i>
        </span> Cargos</h3>
        <a type="button" href="{{ URL::route('Cargo.index')}}" class="btn btn-danger btn-icon-text"><i class="mdi mdi-keyboard-backspace"></i> Regresar </a>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Formulario de creación de Roles</h4>
                <p class="card-description">Completa los campos para editar el rol</p>
                {{ Form::open(array('url' => URL::route('Cargo.update', $cargo->ID_Cargo), 'method' => 'put'))}}
                    @csrf
                    <div class="form-group">
                        {{Form::label('ID_Cargo', 'ID del Cargo')}}
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button class="btn btn-sm btn-primary" type="button">
                                    <i class="mdi mdi-account-badge-horizontal"></i>
                                </button>
                            </div>
                                <input type="text" class="form-control" placeholder="Identificador Autogenerado" readonly value = "{{$cargo->ID_Cargo}}">
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('Nombre_Cargo', 'Nombre del Cargo')}}
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button class="btn btn-sm btn-primary" type="button">
                                    <i class="mdi mdi-office-building"></i>
                                </button>
                            </div>
                                <input type="text" class="form-control" placeholder="Ingrese el nombre del Rol" name="Nombre_Cargo" value = "{{$cargo->Nombre_Cargo}}">
                        </div>
                        @error('Nombre_Cargo')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        {{Form::label('Salario_Cargo', 'Salario')}}
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button class="btn btn-sm btn-primary" type="button">
                                    <i class="mdi mdi-cash"></i>
                                </button>
                            </div>
                                <input type="text" class="form-control" placeholder="Ingrese el nombre del Rol" name="Salario_Cargo" value = "{{$cargo->Salario_Cargo}}">
                        </div>
                        @error('Salario_Cargo')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                    <div class="row justify-content-center mb-4">
                        <button type="submit" class="btn btn-gradient-dark btn-icon-text text-center"> Actualizar Cargo <i class="mdi mdi-file-check btn-icon-append"></i></button>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection