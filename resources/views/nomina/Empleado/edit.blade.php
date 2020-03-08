@extends('layouts.layout')
@push('scripts-vista')    
    <script>
        $('#ID_Cargo').val({{$Empleado->ID_Cargo}});
        $('#ID_Rol').val({{$Empleado->ID_Rol}});
    </script>
@endpush
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-format-list-bulleted"></i>
            </span> Empleados </h3>
            <a href="{{ URL::route('Empleado.index')}}" class="btn btn-danger btn-icon-text"><i class="mdi mdi-keyboard-backspace"></i> Regresar </a>
        </div>
        {{Form::open(array('url' => URL::route('Empleado.update',$Empleado->ID_Empleado), 'method' => 'put', 'files' => true))}}
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Formulario de edición de empleados</h4>
                        <p class="card-description">Completa los campos para editar el empleado</p>
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        @if($Empleado->Imagen != "")
                                            <img alt="ImagenEmpleado" class="img-thumbnail" id="ImagenEmpleado" name="Imagen" src ="data:image/png;base64,{{$Empleado->Imagen}}" style="height:300px;" class="img-thumbnail">
                                        @else
                                            <img alt="ImagenEmpleado" class="img-thumbnail" id="ImagenEmpleado" class="ImagenTamañoTabla" src="{{{asset('images/dummy.jpg')}}}"/>
                                        @endif
                                    </div>  
                                    <div class="row justify-content-center">                                        
                                        {{Form::label('Imagen', 'Cambiar Imagen',['class' => 'btn btn-gradient-dark btn-icon-text text-center','files' => true])}}
                                        <input type="file" class="Imagen" id="Imagen" name="Imagen" accept="image/png,image/jpg,image/jpeg" onchange="document.getElementById('ImagenEmpleado').src = window.URL.createObjectURL(this.files[0])" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{Form::label('ID_Empleado', 'Identificador')}}
                                        <div class="input-group">                            
                                            <div class="input-group-prepend">
                                                <button class="btn btn-sm btn-primary" type="button">
                                                    <i class="mdi mdi-sim-alert"></i>
                                                </button>
                                            </div>
                                            {{ Form::text('ID_Empleado',$Empleado->ID_Empleado,array('id'=>'ID_Empleado','class'=>'form-control','readonly','placeholder'=>'Autogenerado'))}}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {{Form::label('Nombre_Empleado', 'Nombre del empleado')}}
                                        <div class="input-group">                                
                                            <div class="input-group-prepend">
                                                <button class="btn btn-sm btn-primary" type="button">
                                                    <i class="mdi mdi-account-box"></i>
                                                </button>
                                            </div>
                                            {{ Form::text('Nombre_Empleado',$Empleado->Nombre_Empleado,array('id'=>'Nombre_Empleado','class'=>'form-control','placeholder'=>'Ingresa el nombre del empleado'))}}
                                        </div>

                                        @error('Nombre_Empleado')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        {{Form::label('Apellido_Empleado', 'Apellido del empleado')}}
                                        <div class="input-group">                                
                                            <div class="input-group-prepend">
                                                <button class="btn btn-sm btn-primary" type="button">
                                                    <i class="mdi mdi-account-box"></i>
                                                </button>
                                            </div>
                                            {{ Form::text('Apellido_Empleado',$Empleado->Apellido_Empleado,array('id'=>'Apellido_Empleado','class'=>'form-control','placeholder'=>'Ingresa el apelido del empleado'))}}
                                        </div>

                                        @error('Apellido_Empleado')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group">
                                        {{Form::label('Fecha_Nacimiento', 'Fecha de nacimiento')}}
                                        <div class="input-group">                                
                                            <div class="input-group-prepend">
                                                <button class="btn btn-sm btn-primary" type="button">
                                                    <i class="mdi mdi-apps-box"></i>
                                                </button>
                                            </div>
                                            {{ Form::date('Fecha_Nacimiento',$Empleado->Fecha_Nacimiento,array('id'=>'Fecha_Nacimiento','class'=>'form-control','placeholder'=>'Ingresa la fecha de nacimiento'))}}
                                        </div>

                                        @error('Fecha de nacimiento')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{Form::label('Cedula', 'Cedula')}}
                                        <div class="input-group">                                
                                            <div class="input-group-prepend">
                                                <button class="btn btn-sm btn-primary" type="button">
                                                    <i class="mdi mdi-file-document-box"></i>
                                                </button>
                                            </div>
                                            {{ Form::text('Cedula',$Empleado->Cedula,array('id'=>'Cedula','class'=>'form-control','placeholder'=>'Ingresa la cedula'))}}
                                        </div>

                                        @error('Cedula')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        {{Form::label('Correo', 'Correo')}}
                                        <div class="input-group">                                
                                            <div class="input-group-prepend">
                                                <button class="btn btn-sm btn-primary" type="button">
                                                    <i class="mdi mdi-gmail"></i>
                                                </button>
                                            </div>
                                            {{ Form::text('Correo',$Empleado->Correo,array('id'=>'Correo','class'=>'form-control','placeholder'=>'Ingresa el correo'))}}
                                        </div>

                                        @error('Correo')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        {{Form::label('ID_Cargo', 'Cargo')}}
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-sm btn-primary" type="button">
                                                    <i class="mdi mdi-google-circles-extended"></i>
                                                </button>
                                            </div>
                                            <select name="ID_Cargo" class="selectpicker form-control" data-live-search="true">
                                                @foreach ($Cargos as $C)
                                                    <option value="{{ $C->ID_Cargo}}">{{$C->Nombre_Cargo}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('ID_Cargo')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        {{Form::label('ID_Rol', 'Rol')}}
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-sm btn-primary" type="button">
                                                    <i class="mdi mdi-diamond"></i>
                                                </button>
                                            </div>
                                            <select name="ID_Rol" class="selectpicker form-control" data-live-search="true">
                                                @foreach ($Roles as $R)
                                                    <option value="{{ $R->ID_Rol}}">{{$R->Nombre_Rol}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('ID_Cargo')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                </div>
                    </div>
                    <div class="row justify-content-center">
                        <button type="submit" class="btn btn-gradient-dark btn-icon-text text-center"> Editar Empleado<i class="mdi mdi-file-check btn-icon-append"></i></button>
                    </div>
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>
@endsection