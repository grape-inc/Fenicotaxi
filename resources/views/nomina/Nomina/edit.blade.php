@extends('layouts.layout')
@push('scripts-vista')
    <script type="text/javascript" src="{{ URL::asset ('js/Eventos/NominaDetalle.js') }}"></script>
@endpush
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-format-list-bulleted"></i>
        </span> Detale de Nomina</h3>
        <a type="button" href="{{ URL::route('Nomina.index')}}" class="btn btn-danger btn-icon-text"><i class="mdi mdi-keyboard-backspace"></i> Regresar </a>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Formulario de Detalle de Nomina</h4>
                    <p class="card-description">Aca puedes ver los detalles de la nomina generada</p>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                {{Form::label('ID_Nomina', 'Nomina')}}
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-sm btn-primary" type="button">
                                            <i class="mdi mdi-upload-network-outline"></i>
                                        </button>
                                    </div>
                                    {{ Form::text('ID_Nomina',$Nomina->ID_Nomina,array('id'=>'ID_Nomina','class'=>'form-control','placeholder'=>'ID_Nomina','readonly'=>true))}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {{Form::label('Año_Nomina', 'Año Nomina')}}
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-sm btn-primary" type="button">
                                            <i class="mdi mdi mdi-timer"></i>
                                        </button>
                                    </div>
                                    {{ Form::text('Año_Nomina',$Nomina->Año_Nomina,array('id'=>'Año_Nomina','class'=>'form-control','readonly'=>true))}}
                                </div>
                            </div>
                            <div class="form-group">
                                {{Form::label('Total_Bruto', 'Total en Bruto')}}
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-sm btn-primary" type="button">
                                            <i class="mdi mdi-diamond"></i>
                                        </button>
                                    </div>
                                    {{ Form::text('Total_Bruto',$Nomina->Total_Bruto,array('id'=>'Total_Bruto','class'=>'form-control','readonly'=>true))}}
                                </div>
                            </div>
                            <div class="form-group">
                                {{Form::label('Total_Nomina', 'Total en Nomina')}}
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-sm btn-primary" type="button">
                                            <i class="mdi mdi-diamond"></i>
                                        </button>
                                    </div>
                                    {{ Form::text('Total_Nomina',$Nomina->Total_Nomina,array('id'=>'Total_Nomina','class'=>'form-control','readonly'=>true))}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{Form::label('Mes_Nomina', 'Mes Nomina')}}
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-sm btn-primary" type="button">
                                            <i class="mdi mdi mdi mdi-timer"></i>
                                        </button>
                                    </div>
                                    {{ Form::text('Mes_Nomina',$Nomina->Mes_Nomina,array('id'=>'Mes_Nomina','class'=>'form-control','readonly'=>true))}}
                                </div>
                            </div>
                            <div class="form-group">
                                {{Form::label('Total_Deducciones', 'Total en Deducciones')}}
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-sm btn-primary" type="button">
                                            <i class="mdi mdi-diamond"></i>
                                        </button>
                                    </div>
                                    {{ Form::text('Total_Deducciones',$Nomina->Total_Deducciones,array('id'=>'Total_Deducciones','class'=>'form-control','readonly'=>true))}}
                                </div>
                            </div>
                            <div class="form-group">
                                {{Form::label('Fecha_Generado', 'Fecha Generación')}}
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-sm btn-primary" type="button">
                                            <i class="mdi mdi-division"></i>
                                        </button>
                                    </div>
                                    {{ Form::text('Fecha_Generado',$Nomina->Fecha_Generado,array('id'=>'Fecha_Generado','class'=>'form-control','readonly'=>true))}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Detalle de Nomina</h4>
                    <div class="table-responsive">
                        <table id="TablaNominaDetalle" class="table table-hover table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID Empleado</th>
                                    <th>Nombre</th>
                                    <th>Salario Bruto</th>
                                    <th>Inss Laboral</th>
                                    <th>IR</th>
                                    <th>Total Neto</th>
                                    <th>Horas Laboradas</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($Detalle as $Nom)
                                <tr>
                                    <td>{{ $Nom->ID_Empleado }}</td>
                                <td>{{ $Nom->Nombre_Empleado  }} {{ $Nom->Apellido_Empleado }}</td>
                                    <td>{{ $Nom->Salario_Bruto }} C$</td>
                                    <td>{{ $Nom->INSS_Laboral }} C$</td>
                                    <td>{{ $Nom->IR_Laboral }} C$</td>
                                    <td>{{ $Nom->Total_Neto }} C$</td>
                                    <td>{{ $Nom->Horas_Laboradas }} Horas</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection