@extends('layouts.layout')
@push('scripts-vista')
    <script type="text/javascript" src="{{ URL::asset ('js/Eventos/Cargo.js') }}"></script>
    @isset(Request()->Eliminado)
        @if (Request()->Eliminado)
            <script>
                Swal.fire('¡Excelente!','Eliminaste el registro correctamente.','success');
            </script>
        @else
            <script>
                Swal.fire('¡Error!','No se puede eliminar el cargo, Intenta eliminar todas las referencias a este y vuelve a intentarlo.','error');
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
            </span> Cargos </h3>
            <a href="{{route('Cargo.create')}}" class="btn btn-danger btn-icon-text"><i class="mdi mdi-file-check btn-icon-prepend"></i>Añadir Cargo</a>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Cargos Registrados en el sistema</h4>
                        <div class="table-responsive">
                            <table id="TablaCargo" class="table table-hover table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Cargo</th>
                                        <th>Salario</th>
                                        <th>Editar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($Cargo as $cargo)
                                    <tr>
                                        <td>{{$cargo->ID_Cargo }}</td>
                                        <td>{{$cargo->Nombre_Cargo }}</td>
                                        <td>C$ {{$cargo->Salario_Cargo }}</td>
                                        <td> <a href="{{ URL::route('Cargo.edit',$cargo->ID_Cargo)}}" class="btn btn-success btn-fw-success btn-rounded btn-icon-text normalizarboton"><i class="mdi mdi-table-edit"></i></a></td>
                                        <td> <button type="button" onclick="EliminarCargo({{ $cargo->ID_Cargo}},'{{URL::route('Cargo.index')}}')" class="btn btn-dark btn-fw-success btn-rounded btn-icon"><i class="mdi mdi-delete"></i></button></td>
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