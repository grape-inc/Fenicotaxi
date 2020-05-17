@extends('layouts.layout')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-format-list-bulleted"></i>
            </span> Tipo de Pagos </h3>
            <a href="{{ URL::route('TipoPago.index')}}" class="btn btn-danger btn-icon-text"><i class="mdi mdi-keyboard-backspace"></i> Regresar </a>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Formulario de creación de Tipo de Pagos</h4>
                    <p class="card-description">Completa los campos para crear el tipo de pago</p>
                    {{ Form::open(array('url' => URL::route('TipoPago.store'), 'method' => 'post'))}}
                        {{ csrf_field() }}
                        <div class="form-group">
                            {{Form::label('ID', 'Identificador')}}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="btn btn-sm btn-primary" type="button">
                                        <i class="mdi mdi-sim-alert"></i>
                                    </button>
                                </div>
                                {{ Form::text('ID','',array('id'=>'ID','class'=>'form-control','readonly','placeholder'=>'Autogenerado'))}}
                            </div>
                        </div>
                        <div class="form-group">
                            {{Form::label('Tipo_Pago', 'Nombre del tipo de pago')}}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="btn btn-sm btn-primary" type="button">
                                        <i class="mdi mdi-ticket"></i>
                                    </button>
                                </div>
                                {{ Form::text('Tipo_Pago','',array('id'=>'Tipo_Pago','class'=>'form-control','placeholder'=>'Ingresa el tipo de pago'))}}
                            </div>

                            @error('Tipo_Pago')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row justify-content-center">
                            <button type="submit" class="btn btn-gradient-dark btn-icon-text text-center"> Crear Tipo De Pago<i class="mdi mdi-file-check btn-icon-append"></i></button>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection