@extends('layouts.layout')
@push('scripts-vista')
    <script type="text/javascript" src="{{ URL::asset ('js/Eventos/UnidadMedida.js') }}"></script>
    @isset(Request()->Eliminado)
        @if (Request()->Eliminado)
            <script>
                Swal.fire('¡Excelente!','Eliminaste el registro correctamente.','success');
            </script>
        @else
            <script>
                Swal.fire('¡Error!','No se puede eliminar la unidad de medida, Intenta eliminar todas las referencias a esta y vuelve a intentarlo.','error');
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
            </span> Unidades de medida </h3>
            <a href="{{ URL::route('UnidadesDeMedida.create')}}" class="btn btn-danger btn-icon-text"><i class="mdi mdi-file-check btn-icon-prepend"></i>Añadir Unidad de medida</a>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Unidades de medida registradas en el sistema</h4>
                        <div class="table-responsive">
                            <table id="TablaUnidades" class="table table-hover table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Editar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($Unidad as $CF)
                                    <tr>
                                        <td>{{ $CF->ID_Unidad }}</td>
                                        <td>{{ $CF->Nombre_Unidad }}</td>
                                        <td> <a href="{{ URL::route('UnidadesDeMedida.edit', $CF->ID_Unidad)}}" class="btn btn-success btn-fw-success btn-rounded btn-icon-text normalizarboton"><i class="mdi mdi-table-edit"></i></a></td>
                                        <td> <button type="button" onclick="EliminarUnidad({{ $CF->ID_Unidad}},'{{ URL::route('UnidadesDeMedida.index')}}')" class="btn btn-dark btn-fw-success btn-rounded btn-icon"><i class="mdi mdi-delete"></i></button></td>
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