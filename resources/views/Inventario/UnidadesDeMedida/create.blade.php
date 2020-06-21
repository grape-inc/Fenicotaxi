@extends('layouts.layout')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-format-list-bulleted"></i>
            </span> Unidades de medida </h3>
            <a href="{{ URL::route('UnidadesDeMedida.index')}}" class="btn btn-danger btn-icon-text"><i class="mdi mdi-keyboard-backspace"></i> Regresar </a>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Formulario de creación de unidades de medida para los productos</h4>
                    <p class="card-description">Completa los campos para crear la unidad de medida</p>
                    {{ Form::open(array('url' => URL::route('UnidadesDeMedida.store'), 'method' => 'post'))}}
                        {{ csrf_field() }}
                        <div class="form-group">
                            {{Form::label('ID_Unidad', 'Identificador')}}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="btn btn-sm btn-primary" type="button">
                                        <i class="mdi mdi-sim-alert"></i>
                                    </button>
                                </div>
                                {{ Form::text('ID_Unidad','',array('id'=>'ID_Unidad','class'=>'form-control','readonly','placeholder'=>'Autogenerado'))}}
                            </div>
                        </div>
                        <div class="form-group">
                            {{Form::label('Nombre_Unidad', 'Nombre de la unidad de medida')}}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="btn btn-sm btn-primary" type="button">
                                        <i class="mdi mdi-ticket"></i>
                                    </button>
                                </div>
                                {{ Form::text('Nombre_Unidad','',array('id'=>'Nombre_Unidad','class'=>'form-control','placeholder'=>'Ingresa el nombre de la unidad de medida'))}}
                            </div>

                            @error('Nombre_Unidad')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row justify-content-center">
                            <button type="submit" class="btn btn-gradient-dark btn-icon-text text-center"> Crear Unidad de medida<i class="mdi mdi-file-check btn-icon-append"></i></button>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection