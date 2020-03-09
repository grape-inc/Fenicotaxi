@extends('layouts.layout')
@push('scripts-vista')
    <script type="text/javascript" src="{{ URL::asset ('js/Eventos/Proveedores.js') }}"></script>
    @isset(Request()->Eliminado)
        @if (Request()->Eliminado)
            <script>
                Swal.fire('¡Excelente!','Eliminaste el registro correctamente.','success');
            </script>
        @else
            <script>
                Swal.fire('¡Error!','No se puede eliminar el proveedor, Intenta eliminar todas las referencias a este y vuelve a intentarlo.','error');
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
            </span> Proveedores</h3>
            <a href="{{ URL::route('Proveedores.create')}}" class="btn btn-danger btn-icon-text"><i class="mdi mdi-file-check btn-icon-prepend"></i>Añadir Proveedor</a>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Proveedores Registrados en el sistema</h4>
                        <div class="table-responsive">
                            <table id="TablaProveedores" class="table table-hover table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Dirección</th>
                                        <th>Telefono</th>
                                        <th>Contacto</th>
                                        <th>Editar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($Proveedor as $CF)
                                    <tr>
                                        <td>{{ $CF->ID_Proveedor }}</td>
                                        <td>{{ $CF->Nombre_Proveedor }}</td>
                                        <td>{{ $CF->Direccion_Proveedor }}</td>
                                        <td>{{ $CF->Telefono }}</td>
                                        <td>{{ $CF->Contacto_Proveedor }}</td>
                                        <td> <a href="{{ URL::route('Proveedores.edit', $CF->ID_Proveedor)}}" class="btn btn-success btn-fw-success btn-rounded btn-icon-text normalizarboton"><i class="mdi mdi-table-edit"></i></a></td>
                                        <td> <button type="button" onclick="EliminarProveedor({{ $CF->ID_Proveedor}},'{{ URL::route('Proveedores.index')}}')" class="btn btn-dark btn-fw-success btn-rounded btn-icon"><i class="mdi mdi-delete"></i></button></td>
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