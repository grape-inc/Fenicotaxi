@extends('layouts.layout')
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-format-list-bulleted"></i>
        </span> Roles</h3>
        <a type="button" href="{{ URL::route('Arqueo.index')}}" class="btn btn-danger btn-icon-text"><i class="mdi mdi-keyboard-backspace"></i> Regresar </a>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Formulario de creación de caja</h4>
                <p class="card-description">Completa los campos para abrir caja</p>
                {{ Form::open(array('url' => URL::route('Arqueo.store'), 'method' => 'post'))}}
                    @csrf
                    <div class="form-group">
                        {{Form::label('ID_Jornada', 'ID de la Jornada')}}
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button class="btn btn-sm btn-primary" type="button">
                                    <i class="mdi mdi-upload-network-outline"></i>
                                </button>
                            </div>
                                <input type="text" class="form-control" placeholder="Identificador Autogenerado" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('Saldo_Inicial', 'Saldo inicial de la jornada')}}
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button class="btn btn-sm btn-primary" type="button">
                                    <i class="mdi mdi-cash-register"></i>
                                </button>
                            </div>
                                <input type="number" class="form-control" step="0.01"placeholder="Ingrese el saldo inicial" name="Saldo_Inicial">
                        </div>
                        @error('Saldo_Inicial')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        {{Form::label('ID_Empleado', 'Nombre del empleado')}}
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button class="btn btn-sm btn-primary" type="button">
                                    <i class="mdi mdi-account-box"></i>
                                </button>
                            </div>
                            <select name="ID_Empleado" class="selectpicker form-control" title="Escoja el empleado..." data-live-search="true">
                                @foreach ($empleado as $emp)
                                     <option value="{{ $emp->ID_Empleado}}">{{$emp->Nombre_Empleado}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('ID_Empleado')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    </div>
                    <div class="row justify-content-center">
                        <button type="submit" class="btn btn-gradient-dark btn-icon-text text-center mb-4"> Abrir Caja<i class="mdi mdi-file-check btn-icon-append"></i></button>
                    </div>
                    {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection