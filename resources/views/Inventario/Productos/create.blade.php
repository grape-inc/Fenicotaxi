@extends('layouts.layout')
@push('scripts-vista')
    <script type="text/javascript" src="{{ URL::asset ('js/Eventos/ProductoAñadirEditar.js') }}"></script>
    <script>
        if ($('#Es_Repuesto').is(':checked')) {
            $('#divrepuesto').removeClass('quitardiv');
        }
    </script>
@endpush
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-format-list-bulleted"></i>
            </span> Productos </h3>
            <div class="col-xs-4">
                <button id="ActualizarDatos" class="btn btn-info btn-icon-text"><i class="mdi mdi mdi-refresh "></i> Actualizar Datos</button>
                <a href="{{ URL::route('Productos.index')}}" class="btn btn-danger btn-icon-text"><i class="mdi mdi-keyboard-backspace"></i> Regresar </a>
            </div>
        </div>
        {{Form::open(array('url' => URL::route('Productos.store'), 'method' => 'post', 'files' => true))}}
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Formulario de creación de productos</h4>
                        <p class="card-description">Completa los campos para crear el producto</p>
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <img id="ImagenProducto" name="Imagen" src="{{{asset('images/dummy.jpg')}}}" style="height:300px;" alt="ImagenProducto" class="img-thumbnail">
                                    </div>
                                    <div class="row justify-content-center">
                                        {{Form::label('Imagen', 'Cambiar Imagen',['class' => 'btn btn-gradient-dark btn-icon-text text-center','files' => true])}}
                                        <input type="file" class="Imagen" id="Imagen" name="Imagen" accept="image/png,image/jpg,image/jpeg" onchange="document.getElementById('ImagenProducto').src = window.URL.createObjectURL(this.files[0])" />
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

                                    <div class="form-group">
                                        {{Form::label('ID_Divisa', 'Divisa Precio')}}
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-sm btn-primary" type="button">
                                                    <i class="mdi mdi-diamond"></i>
                                                </button>
                                            </div>
                                            <select id="ID_Divisa" name="ID_Divisa" class="selectpicker form-control" data-live-search="true">
                                                @foreach ($Divisas as $CT)
                                                    <option value="{{ $CT->ID_Divisa}}">{{$CT->Nombre_Divisa}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('ID_Divisa')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <a target="_blank" class="link" href="{{ URL::route('UnidadesDeMedida.create')}}">Unidad de medida</a>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-sm btn-primary" type="button">
                                                    <i class="mdi mdi-ruler"></i>
                                                </button>
                                            </div>
                                            <select id="ID_UnidadMedida" name="ID_UnidadMedida" class="selectpicker form-control" data-live-search="true">
                                                @foreach ($Unidades as $U)
                                                    <option value="{{ $U->ID_Unidad}}">{{$U->Nombre_Unidad}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('ID_UnidadMedida')
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
                                            {{ Form::number('Existencias','',array('id'=>'Existencias','class'=>'form-control','placeholder'=>'Ingresa las existencias del producto'))}}
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
                                            {{ Form::number('Existencias_Minimas','',array('id'=>'Existencias_Minimas','class'=>'form-control','placeholder'=>'Existencias minimas del producto'))}}
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
                                            {{ Form::number('Precio_Venta','',array('id'=>'Precio_Venta','class'=>'form-control','placeholder'=>'Precio de venta del producto','step'=>'0.01'))}}
                                        </div>

                                        @error('Precio_Venta')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <a target="_blank" class="link" href="{{ URL::route('Categorias.create')}}">Categoría del producto</a>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-sm btn-primary" type="button">
                                                    <i class="mdi mdi-dice-3"></i>
                                                </button>
                                            </div>
                                            <select id="ID_Categoria" name="ID_Categoria" class="selectpicker form-control" data-live-search="true">
                                                @foreach ($Categorias as $CT)
                                                    <option value="{{ $CT->ID_Categoria}}">{{$CT->Nombre_Categoria}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('ID_Categoria')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <a target="_blank" class="link" href="{{ URL::route('Proveedores.create')}}">Proveedor del producto</a>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-sm btn-primary" type="button">
                                                    <i class="mdi mdi-domain"></i>
                                                </button>
                                            </div>
                                            <select id="ID_Proveedor" name="ID_Proveedor" class="selectpicker form-control" data-live-search="true">
                                                @foreach ($Proveedores as $PR)
                                                    <option value="{{ $PR->ID_Proveedor}}">{{$PR->Nombre_Proveedor}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('ID_Proveedor')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group rectificadorcheck">
                                        <div class="form-check form-check-flat form-check-primary">
                                            <label class="form-check-label">
                                            {{Form::checkbox('Es_Repuesto', 'Es Repuesto', false, ['class' => 'form-check-input','id'=> 'Es_Repuesto'])}}
                                                ¿Es un repuesto?
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>

            <div id="divrepuesto" class="col-md-12 grid-margin stretch-card rectificadorgrandiv quitardiv">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                        <h4 class="card-title">Formulario de repuestos</h4>
                        <p class="card-description">Completa los campos opcionales de un repuesto</p>
                            <div class="form-group">
                                {{Form::label('Año', 'Año')}}
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-sm btn-primary" type="button">
                                            <i class="mdi mdi-message-processing"></i>
                                        </button>
                                    </div>
                                    {{ Form::number('Año','',array('id'=>'Año','max'=>date('Y'),'class'=>'form-control','placeholder'=>'Ingresa el año del producto'))}}
                                </div>

                                @error('Año')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                {{Form::label('Modelo', 'Modelo')}}
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-sm btn-primary" type="button">
                                            <i class="mdi mdi-memory"></i>
                                        </button>
                                    </div>
                                    {{ Form::text('Modelo','',array('id'=>'Modelo','class'=>'form-control','placeholder'=>'Ingresa el modelo del producto'))}}
                                </div>

                                @error('Modelo')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                {{Form::label('Origen', 'Origen')}}
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-sm btn-primary" type="button">
                                            <i class="mdi mdi-math-compass"></i>
                                        </button>
                                    </div>
                                    {{ Form::text('Origen','',array('id'=>'Origen','class'=>'form-control','placeholder'=>'Ingresa el origen del producto'))}}
                                </div>

                                @error('Origen')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                {{Form::label('Marca', 'Marca')}}
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-sm btn-primary" type="button">
                                            <i class="mdi mdi-multiplication-box"></i>
                                        </button>
                                    </div>
                                    {{ Form::text('Marca','',array('id'=>'Marca','class'=>'form-control','placeholder'=>'Ingresa la marca del producto'))}}
                                </div>

                                @error('Marca')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center boton_fixeado">
                <button type="submit" class="btn btn-gradient-dark btn-icon-text text-center"> Crear Producto<i class="mdi mdi-file-check btn-icon-append"></i></button>
            </div>
        {{ Form::close() }}
    </div>
@endsection