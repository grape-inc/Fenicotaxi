@extends('layouts.layout')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-format-list-bulleted"></i>
            </span> Generación de Nomina </h3>
            <a href="{{ URL::route('Nomina.index')}}" class="btn btn-danger btn-icon-text"><i class="mdi mdi-keyboard-backspace"></i> Regresar </a>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Formulario de generación de nomina de los empleados</h4>
                    <p class="card-description">Escribe las horas laboradas de cada empleado para generar la nomina de este mes</p>
                    {{ Form::open(array('url' => URL::route('Nomina.store'), 'method' => 'post'))}}
                        {{ csrf_field() }}
                        <div class="row">
                            {{-- Tabla de empleados --}}
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="TablaDetalleEmpleados" class="table table-hover table-bordered">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>ID Empleado</th>
                                                <th>Nombre Completo</th>
                                                <th>Cargo</th>
                                                <th>Salario</th>
                                                <th>Horas Laboradas</th>
                                            </tr>
                                        </thead>
                                        {{-- Cuerpo de la tabla --}}
                                        <tbody>
                                        @foreach($Empleados as $E)
                                        <tr>
                                            <td><input type="hidden" name="ID_Empleado[]" value="{{ $E->ID_Empleado }}"> {{ $E->ID_Empleado }}</td>
                                            <td>{{ $E->Nombre_Empleado }} {{ $E->Apellido_Empleado }}</td>
                                            <td>{{ $E->Nombre_Cargo}}</td>
                                            <td><input type="hidden" name="Salario[]" value="{{ $E->Salario_Cargo }}"> {{ $E->Salario_Cargo}}</td>
                                            <td><input type="number" style="width: 140px;" name="Horas[]" value="160"></td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-5">
                            <button type="submit" class="btn btn-gradient-dark btn-icon-text text-center"> Generar Nomina<i class="mdi mdi-file-check btn-icon-append"></i></button>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection