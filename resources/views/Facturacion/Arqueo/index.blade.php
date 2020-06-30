@extends('layouts.layout')
@push('scripts-vista')
    <script type="text/javascript" src="{{ URL::asset ('js/Eventos/Arqueo.js') }}"></script>
    @isset(Request()->Eliminado)
        @if (Request()->Eliminado)
            <script>
                Swal.fire('¡Excelente!','Eliminaste el registro correctamente.','success');
            </script>
        @else
            <script>
                Swal.fire('¡Error!','No se puede eliminar el arqueo','error');
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
            </span> Arqueo de caja </h3>
            @include('flash::message')
            <a href="{{route('Arqueo.create')}}" class="btn btn-danger btn-icon-text"><i class="mdi mdi-file-check btn-icon-prepend"></i>Abrir Caja</a>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Arqueos Registrados en el sistema</h4>
                        <div class="table-responsive">
                            <table id="TablaArqueo" class="table table-hover table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID Jornada</th>
                                        <th>Saldo Inicial</th>
                                        <th>Saldo Final</th>
                                        <th>Empleado</th>
                                        <th>Fecha</th>
                                        <th>Estado</th>
                                        <th>Billetes 10</th>
                                        <th>Billetes 20</th>
                                        <th>Billetes 50</th>
                                        <th>Billetes 100</th>
                                        <th>Billetes 200</th>
                                        <th>Billetes 500</th>
                                        <th>Billetes 1000</th>
                                        <th>Monedas 0.25</th>
                                        <th>Monedas 0.5c</th>
                                        <th>Monedas 1</th>
                                        <th>Modenas 5</th>
                                        <th>Fecha Actualizacion</th>
                                        <th>Editar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($arqueo as $arq)
                                    <tr>
                                        <td>{{ $arq->ID_Jornada }}</td>
                                        <td>{{ $arq->Saldo_Inicial }} C$</td>
                                        <td>{{ $arq->Saldo_Final }} C$</td>
                                        <td>{{ $arq->Nombre_Empleado }}</td>
                                        <td>{{ $arq->Fecha_Jornada }}</td>
                                        @if ($arq->Jornada_Abierta == 0)
                                            <td><span class="badge badge-success">Cerrada</span></td>
                                        @else
                                            <td><span class="badge badge-danger">Abierta</span></td>
                                        @endif
                                        <td>{{ $arq->B10 }}</td>
                                        <td>{{ $arq->B20 }}</td>
                                        <td>{{ $arq->B50 }}</td>
                                        <td>{{ $arq->B100 }}</td>
                                        <td>{{ $arq->B200 }}</td>
                                        <td>{{ $arq->B500 }}</td>
                                        <td>{{ $arq->B1000 }}</td>
                                        <td>{{ $arq->M025 }}</td>
                                        <td>{{ $arq->M050 }}</td>
                                        <td>{{ $arq->M1 }}</td>
                                        <td>{{ $arq->M5 }}</td>
                                        <td>{{ $arq->Fecha_Actualizacion }}</td>
                                        <td> <a href="{{ URL::route('Arqueo.edit', $arq->ID_Jornada)}}" class="btn btn-success btn-fw-success btn-rounded btn-icon-text normalizarboton"><i class="mdi mdi-table-edit"></i></a></td>
                                        <td> <button type="button" onclick="EliminarArqueo({{ $arq->ID_Jornada}},'{{URL::route('Arqueo.index')}}')" class="btn btn-dark btn-fw-success btn-rounded btn-icon"><i class="mdi mdi-delete"></i></button></td>
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