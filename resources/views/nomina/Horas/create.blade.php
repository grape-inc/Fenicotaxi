@extends('layouts.layout')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-format-list-bulleted"></i>
            </span> Horas Laborales </h3>
            <a href="{{ URL::route('Horas.index')}}" class="btn btn-danger btn-icon-text"><i class="mdi mdi-keyboard-backspace"></i> Regresar </a>
        </div>
        @include('flash::message')
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Formulario para añadir horas laborales</h4>
                    <p class="card-description">Completa los campos para añadir las horas laborales</p>
                    {{ Form::open(array('url' => URL::route('Horas.store'), 'method' => 'post'))}}
                        {{ csrf_field() }}

                        <div class="form-group">
                            {{Form::label('ID_Empleado', 'Empleado')}}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="btn btn-sm btn-primary" type="button">
                                        <i class="mdi mdi-account"></i>
                                    </button>
                                </div>
                                <select name="ID_Empleado" class="selectpicker form-control" data-live-search="true">
                                    @foreach ($Empleados as $Emp)
                                        <option data-subtext="#{{$Emp->ID_Empleado}}" value="{{ $Emp->ID_Empleado}}">{{$Emp->Nombre_Empleado . " " . $Emp->Apellido_Empleado }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('ID_Empleado')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            {{Form::label('Fecha_Registro', 'Fecha de registro')}}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="btn btn-sm btn-primary" type="button">
                                        <i class="mdi mdi-apps-box"></i>
                                    </button>
                                </div>
                                {{ Form::date('Fecha_Registro',date('Y-m-d'),array('id'=>'Fecha_Registro','class'=>'form-control','readonly'))}}
                            </div>

                            @error('Fecha_Registro')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            {{Form::label('Horas_Laboradas', 'Horas Laboradas')}}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="btn btn-sm btn-primary" type="button">
                                        <i class="mdi mdi mdi-apps"></i>
                                    </button>
                                </div>
                                {{ Form::number('Horas_Laboradas','',array('id'=>'Horas_Laboradas','class'=>'form-control','placeholder'=>'Ingresa las horas laboradas','min'=>'0','max'=>'8'))}}
                            </div>
                            @error('Horas_Laboradas')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="row justify-content-center">
                            <button type="submit" class="btn btn-gradient-dark btn-icon-text text-center"> Agregar Horas<i class="mdi mdi-file-check btn-icon-append"></i></button>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection