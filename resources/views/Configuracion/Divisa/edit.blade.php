@extends('layouts.layout')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-format-list-bulleted"></i>
            </span> Divisas </h3>
            <a href="{{ URL::route('Divisa.index')}}" class="btn btn-danger btn-icon-text"><i class="mdi mdi-keyboard-backspace"></i> Regresar </a>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Formulario de edición de divisas</h4>
                    <p class="card-description">Ingresa la tasa de cambio para actualizar la divisa</p>
                    {{ Form::open(array('url' => URL::route('Divisa.update', $Divisa->ID_Divisa), 'method' => 'put'))}}
                        {{ csrf_field() }}
                        <div class="form-group">
                            {{Form::label('ID_Divisa', 'Identificador')}}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="btn btn-sm btn-primary" type="button">
                                        <i class="mdi mdi-sim-alert"></i>
                                    </button>
                                </div>
                                {{ Form::text('ID_Divisa',$Divisa->ID_Divisa,array('id'=>'ID_Divisa','class'=>'form-control','readonly'))}}
                            </div>
                        </div>
                        <div class="form-group">
                            {{Form::label('Nombre_Divisa', 'Nombre de la divisa')}}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="btn btn-sm btn-primary" type="button">
                                        <i class="mdi mdi-ticket"></i>
                                    </button>
                                </div>
                                {{ Form::text('Nombre_Divisa',$Divisa->Nombre_Divisa,array('id'=>'Nombre_Divisa','class'=>'form-control','placeholder'=>'Ingresa el nombre de la divisa','readonly'))}}
                            </div>

                            @error('Nombre_Categoria')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            {{Form::label('Equivalencia_Cordoba', 'Equivalencia en cordobas')}}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="btn btn-sm btn-primary" type="button">
                                        <i class="mdi mdi-diamond"></i>
                                    </button>
                                </div>
                                {{ Form::number('Equivalencia_Cordoba',$Divisa->Equivalencia_Cordoba,array('id'=>'Equivalencia_Cordoba','class'=>'form-control','step'=>'.01'))}}
                            </div>
                            @error('Descripcion_Categoria')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row justify-content-center">                            
                            <button type="submit" class="btn btn-gradient-dark btn-icon-text text-center"> Actualizar Divisa<i class="mdi mdi-file-check btn-icon-append"></i></button>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection