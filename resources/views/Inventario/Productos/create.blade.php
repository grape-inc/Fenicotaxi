@extends('layouts.layout')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-format-list-bulleted"></i>
            </span> Productos </h3>
            <a href="{{ URL::route('Productos.index')}}" class="btn btn-danger btn-icon-text"><i class="mdi mdi-keyboard-backspace"></i> Regresar </a>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Formulario de creación de productos</h4>
                    <p class="card-description">Completa los campos para crear el producto</p>
                    {{ Form::open(array('url' => URL::route('Productos.store'), 'method' => 'post'))}}
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                   <img src="{{{asset('images/dummy.jpg')}}}" alt="ImagenProducto" class="img-thumbnail">
                                </div>  
                                <div class="row justify-content-center">
                                    <button type="submit" class="btn btn-gradient-dark btn-icon-text text-center"> Cambiar Imagen<i class="mdi mdi-file-image btn-icon-append"></i></button>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{Form::label('ID_Producto', 'Identificador')}}
                                    <div class="input-group">                            
                                        <div class="input-group-prepend">
                                            <button class="btn btn-sm btn-primary" type="button">
                                                <i class="mdi mdi-sim-alert"></i>
                                            </button>
                                        </div>
                                        {{ Form::text('ID_Producto','',array('id'=>'ID_Producto','class'=>'form-control','readonly','placeholder'=>'Autogenerado'))}}
                                    </div>
                                </div>

                                <div class="form-group">
                                    {{Form::label('Cod_Producto', 'Codigo del producto')}}
                                    <div class="input-group">                                
                                        <div class="input-group-prepend">
                                            <button class="btn btn-sm btn-primary" type="button">
                                                <i class="mdi mdi-alert-box"></i>
                                            </button>
                                        </div>
                                        {{ Form::text('Cod_Producto','',array('id'=>'Cod_Producto','class'=>'form-control','placeholder'=>'Ingresa el codigo del producto'))}}
                                    </div>

                                    @error('Cod_Producto')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    {{Form::label('Nombre_Producto', 'Nombre del producto')}}
                                    <div class="input-group">                                
                                        <div class="input-group-prepend">
                                            <button class="btn btn-sm btn-primary" type="button">
                                                <i class="mdi mdi mdi-animation"></i>
                                            </button>
                                        </div>
                                        {{ Form::text('Nombre_Producto','',array('id'=>'Nombre_Producto','class'=>'form-control','placeholder'=>'Ingresa el nombre del producto'))}}
                                    </div>

                                    @error('Nombre_Producto')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    {{Form::label('Descripcion_Producto', 'Descripción del producto')}}
                                    <div class="input-group">                                
                                        <div class="input-group-prepend">
                                            <button class="btn btn-sm btn-primary" type="button">
                                                <i class="mdi mdi-altimeter"></i>
                                            </button>
                                        </div>
                                        {{ Form::text('Descripcion_Producto','',array('id'=>'Descripcion_Producto','class'=>'form-control','placeholder'=>'Ingresa la descripción del producto'))}}
                                    </div>

                                    @error('Descripcion_Producto')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>   

                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    {{Form::label('Existencias', 'Existencias del producto')}}
                                    <div class="input-group">                                
                                        <div class="input-group-prepend">
                                            <button class="btn btn-sm btn-primary" type="button">
                                                <i class="mdi mdi mdi-apps"></i>
                                            </button>
                                        </div>
                                        {{ Form::text('Existencias','',array('id'=>'Existencias','class'=>'form-control','placeholder'=>'Ingresa las existencias del producto'))}}
                                    </div>

                                    @error('Existencias')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    {{Form::label('Existencias_Minimas', 'Existencias Minima')}}
                                    <div class="input-group">                                
                                        <div class="input-group-prepend">
                                            <button class="btn btn-sm btn-primary" type="button">
                                                <i class="mdi mdi mdi-apps"></i>
                                            </button>
                                        </div>
                                        {{ Form::text('Existencias_Minimas','',array('id'=>'Existencias_Minimas','class'=>'form-control','placeholder'=>'Existencias minimas del producto'))}}
                                    </div>

                                    @error('Existencias_Minimas')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    {{Form::label('Precio_Venta', 'Precio de venta')}}
                                    <div class="input-group">                                
                                        <div class="input-group-prepend">
                                            <button class="btn btn-sm btn-primary" type="button">
                                                <i class="mdi mdi mdi-diamond"></i>
                                            </button>
                                        </div>
                                        {{ Form::text('Precio_Venta','',array('id'=>'Precio_Venta','class'=>'form-control','placeholder'=>'Precio de venta del producto'))}}
                                    </div>

                                    @error('Precio_Venta')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    {{Form::label('ID_Categoria', 'Categoria del producto')}}
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-sm btn-primary" type="button">
                                                <i class="mdi mdi-dice-3"></i>
                                            </button>
                                        </div>
                                        <select name="ID_Categoria" class="selectpicker form-control" data-live-search="true">
                                            @foreach ($Categorias as $CT)
                                                <option value="{{ $CT->ID_Categoria}}">{{$CT->Nombre_Categoria}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('ID_Categoria')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>                    
                        <div class="row justify-content-center">
                            <button type="submit" class="btn btn-gradient-dark btn-icon-text text-center"> Crear Producto<i class="mdi mdi-file-check btn-icon-append"></i></button>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection