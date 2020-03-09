@extends('layouts.layout')
@push('scripts-vista')
    <script type="text/javascript" src="{{ URL::asset ('js/Eventos/Clientes.js') }}"></script>
    @isset(Request()->Eliminado)
        @if (Request()->Eliminado)
            <script>
                Swal.fire('¡Excelente!','Eliminaste el registro correctamente.','success');
            </script>
        @else
            <script>
                Swal.fire('¡Error!','No se puede eliminar el cliente, Intenta eliminar todas las referencias a este y vuelve a intentarlo.','error');
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
            </span> Clientes </h3>
            <a href="{{route('Cliente.create')}}" class="btn btn-danger btn-icon-text"><i class="mdi mdi-file-check btn-icon-prepend"></i>Añadir Cliente</a>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Clientes Registrados en el sistema</h4>
                        <div class="table-responsive">
                            <table id="TablaClientes" class="table table-hover table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Cedula</th>
                                        <th>Correo</th>
                                        <th>Fecha Ingreso</th>
                                        <th>Fecha Realizacion</th>
                                        <th>Editar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($Cliente as $cliente)
                                    <tr>
                                        <td>{{ $cliente->ID_Cliente }}</td>
                                        <td>{{ $cliente->Nombre_Cliente }}</td>
                                        <td>{{ $cliente->Apellido_Cliente }}</td>
                                        <td>{{ $cliente->Cedula }}</td>
                                        <td>{{ $cliente->Correo }}</td>
                                        <td>{{ $cliente->Fecha_Ingreso }}</td>
                                        <td>{{ $cliente->Fecha_Realizacion }}</td>
                                        <td> <a href="{{ URL::route('Cliente.edit', $cliente->ID_Cliente)}}" class="btn btn-success btn-fw-success btn-rounded btn-icon-text normalizarboton"><i class="mdi mdi-table-edit"></i></a></td>
                                        <td> <button type="button" onclick="EliminarCliente({{ $cliente->ID_Cliente}},'{{URL::route('Cliente.index')}}')" class="btn btn-dark btn-fw-success btn-rounded btn-icon"><i class="mdi mdi-delete"></i></button></td>
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