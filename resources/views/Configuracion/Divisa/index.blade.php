@extends('layouts.layout')
@push('scripts-vista')
    <script type="text/javascript" src="{{ URL::asset ('js/Eventos/Divisa.js') }}"></script>
    @if (Request()->Actualizado)
        <script>
            Swal.fire('¡Excelente!','Se actualizaron las tasas de cambio exitosamente.','success');
        </script>
    @endif
@endpush
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-format-list-bulleted"></i>
            </span> Divisas </h3>
            <a href="{{ URL::route('Divisa.create')}}" class="btn btn-danger btn-icon-text"><i class="mdi mdi-diamond btn-icon-prepend"></i>Sincronizar divisas</a>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Divisas Registradas en el sistema</h4>
                        <div class="table-responsive">
                            <table id="TablaDivisas" class="table table-hover table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre Divisa</th>
                                        <th>Equivalencia Nacional (En C$)</th>
                                        <th>Editar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($Divisa as $CF)
                                    <tr>
                                        <td>{{ $CF->ID_Divisa }}</td>
                                        <td>{{ $CF->Nombre_Divisa }}</td>
                                        <td>{{ $CF->Equivalencia_Cordoba }}</td>
                                        <td> <a href="{{ URL::route('Divisa.edit', $CF->ID_Divisa)}}" class="btn btn-success btn-fw-success btn-rounded btn-icon-text normalizarboton"><i class="mdi mdi-table-edit"></i></a></td>
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