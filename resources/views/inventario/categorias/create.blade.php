@extends('layouts.layout')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-format-list-bulleted"></i>
            </span> Categorias de producto </h3>
            <a href="{{ URL::route('Categorias.index')}}" class="btn btn-danger btn-icon-text"><i class="mdi mdi-keyboard-backspace"></i> Regresar </a>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card quitardiv">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Formulario de creación de categorias para productos</h4>
                    <p class="card-description">Completa los campos para crear la categoria</p>
                    {{ Form::open(array('url' => URL::route('Categorias.store'), 'method' => 'post'))}}
                        {{ csrf_field() }}
                        <div class="form-group">
                            {{Form::label('ID_Categoria', 'Identificador')}}
                            <div class="input-group">                            
                                <div class="input-group-prepend">
                                    <button class="btn btn-sm btn-primary" type="button">
                                        <i class="mdi mdi-sim-alert"></i>
                                    </button>
                                </div>
                                {{ Form::text('ID_Categoria','',array('id'=>'ID_Categoria','class'=>'form-control','readonly','placeholder'=>'Autogenerado'))}}
                            </div>
                        </div>
                        <div class="form-group">
                            {{Form::label('Nombre_Categoria', 'Nombre de la categoria')}}
                            <div class="input-group">                                
                                <div class="input-group-prepend">
                                    <button class="btn btn-sm btn-primary" type="button">
                                        <i class="mdi mdi-ticket"></i>
                                    </button>
                                </div>
                                {{ Form::text('Nombre_Categoria','',array('id'=>'Nombre_Categoria','class'=>'form-control','placeholder'=>'Ingresa el nombre de la categoria'))}}
                            </div>

                            @error('Nombre_Categoria')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            {{Form::label('Descripcion_Categoria', 'Descripción de la categoria')}}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="btn btn-sm btn-primary" type="button">
                                        <i class="mdi mdi-sort-variant"></i>
                                    </button>
                                </div>
                                {{ Form::text('Descripcion_Categoria','',array('id'=>'Descripcion_Categoria','class'=>'form-control','placeholder'=>'Ingresa la descripción de la categoria'))}}
                            </div>
                            @error('Descripcion_Categoria')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row justify-content-center">
                            <button type="submit" class="btn btn-gradient-dark btn-icon-text text-center"> Crear Categoria<i class="mdi mdi-file-check btn-icon-append"></i></button>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection