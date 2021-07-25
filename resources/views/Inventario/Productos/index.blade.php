@extends('layouts.layout')
@push('scripts-vista')
    <script type="text/javascript" src="{{ URL::asset ('js/Eventos/Producto.js') }}"></script>
    @isset(Request()->Eliminado)
        @if (Request()->Eliminado)
            <script>
                Swal.fire('¡Excelente!','Eliminaste el registro correctamente.','success');
            </script>
        @else
            <script>
                Swal.fire('¡Error!','No se puede eliminar el producto, Intenta eliminar todas las referencias a este y vuelve a intentarlo.','error');
            </script>
        @endif
    @endisset
@endpush
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-format-list-bulleted"></i>
            </span> Productos </h3>
            @if (session('Rol') == 1 || session('Rol') == 3 )
                <a href="{{ URL::route('Productos.create')}}" class="btn btn-danger btn-icon-text"><i class="mdi mdi-file-check btn-icon-prepend"></i>Añadir Producto</a>
            @endif
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin">
                <a href="{{ URL::route('Productos.index',"Tipo_Existencia=1")}}" class="btn btn-success btn-icon-text"><i class="mdi mdi-apps "></i> Existenias Suficientes </a>
                <a href="{{ URL::route('Productos.index',"Tipo_Existencia=2")}}" class="btn btn-danger btn-icon-text"><i class="mdi mdi mdi-alert-octagon"></i> Existencias Insuficientes </a>
                <a href="{{ URL::route('Productos.index')}}" class="btn btn-primary btn-icon-text"><i class="mdi mdi mdi-jira"></i> Sin Filtros </a>
            </div>
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Productos Registrados en el sistema</h4>
                        <div class="table-responsive">
                            <table id="TablaProductos" class="table table-hover table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Imagen</th>
                                        <th>Codigo de producto</th>
                                        <th>Nombre de producto</th>
                                        <th>Descripción de producto</th>
                                        <th>Estado Existencias</th>
                                        <th>Existencias</th>
                                        <th>Minima Existencia</th>
                                        <th>Precio de venta</th>
                                        <th>Categoria</th>
                                        <th>Proveedor</th>
                                        @if (session('Rol') == 1 || session('Rol') == 3 )
                                            <th>Editar</th>
                                            <th>Eliminar</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($Productos as $CF)
                                    <tr>
                                        <td>{{ $CF->ID_Producto }}</td>
                                        @if($CF->Imagen != "")
                                            <td><img class="ImagenTamañoTabla" src ="data:image/png;base64,{{$CF->Imagen}}"/></td>
                                        @else
                                             <td><img class="ImagenTamañoTabla" src="{{{asset('images/dummy.jpg')}}}"/></td>
                                        @endif
                                        <td>{{ $CF->Cod_Producto }}</td>
                                        <td>{{ $CF->Nombre_Producto }}</td>
                                        <td>{{ $CF->Descripcion_Producto }}</td>
                                        @if ($CF->Existencias >= $CF->Existencias_Minimas)
                                            <td><span class="badge badge-success">Suficientes</span></td>
                                        @else
                                            <td><span class="badge badge-danger">Insuficientes</span></td>
                                        @endif
                                        <td>{{ $CF->Existencias }}</td>
                                        <td>{{ $CF->Existencias_Minimas }}</td>
                                        <td>{{ $CF->Precio_Venta }} {{ $CF->Simbolo_Divisa }}</td>
                                        <td>{{ $CF->Nombre_Categoria }}</td>
                                        <td>{{ $CF->Nombre_Proveedor }}</td>
                                        @if (session('Rol') == 1 || session('Rol') == 3 )
                                            <td> <a href="{{ URL::route('Productos.edit', $CF->ID_Producto)}}" class="btn btn-success btn-fw-success btn-rounded btn-icon-text normalizarboton"><i class="mdi mdi-table-edit"></i></a></td>
                                            <td> <button type="button" onclick="EliminarProducto({{ $CF->ID_Producto}},'{{ URL::route('Productos.index')}}')" class="btn btn-dark btn-fw-success btn-rounded btn-icon"><i class="mdi mdi-delete"></i></button></td>
                                        @endif
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