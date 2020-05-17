@extends('layouts.layout')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-format-list-bulleted"></i>
            </span> Tipo De Pago </h3>
            <a href="{{ URL::route('TipoPago.index')}}" class="btn btn-danger btn-icon-text"><i class="mdi mdi-keyboard-backspace"></i> Regresar </a>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Formulario de edición de los tipos de pagos</h4>
                    <p class="card-description">Completa los campos para actualizar el tipo de pago</p>
                    {{ Form::open(array('url' => URL::route('TipoPago.update', $TipoPago->ID), 'method' => 'put'))}}
                        {{ csrf_field() }}
                        <div class="form-group">
                            {{Form::label('ID', 'Identificador')}}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="btn btn-sm btn-primary" type="button">
                                        <i class="mdi mdi-sim-alert"></i>
                                    </button>
                                </div>
                                {{ Form::text('ID',$TipoPago->ID,array('id'=>'ID','class'=>'form-control','readonly'))}}
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
                                {{ Form::text('Tipo_Pago',$TipoPago->Tipo_Pago,array('id'=>'Tipo_Pago','class'=>'form-control','placeholder'=>'Ingresa el nombre del tipo de pago'))}}
                            </div>

                            @error('Tipo_Pago')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row justify-content-center">
                            <button type="submit" class="btn btn-gradient-dark btn-icon-text text-center"> Actualizar Tipo de Pago<i class="mdi mdi-file-check btn-icon-append"></i></button>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection