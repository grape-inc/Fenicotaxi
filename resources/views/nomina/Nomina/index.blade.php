@extends('layouts.layout')
@push('scripts-vista')
    <script type="text/javascript" src="{{ URL::asset ('js/Eventos/Nomina.js') }}"></script>
    @if (Request()->Eliminado)
        <script>
            Swal.fire('¡Excelente!','Eliminaste el registro correctamente.','success');
        </script>
    @endif
@endpush

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-format-list-bulleted"></i>
            </span> Nomina </h3>
            <a href="{{route('Nomina.create')}}" class="btn btn-danger btn-icon-text"><i class="mdi mdi-file-check btn-icon-prepend"></i>General Nomina</a>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Nominas Generadas por el sistema</h4>
                        <div class="table-responsive">
                            <table id="TablaNomina" class="table table-hover table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Año</th>
                                        <th>Mes</th>
                                        <th>Fecha</th>
                                        <th>Total Bruto</th>
                                        <th>Total Deducciones</th>
                                        <th>Total Nomina</th>
                                        <th>Ver</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($Nomina as $Nom)
                                    <tr>
                                        <td>{{ $Nom->ID_Nomina }}</td>
                                        <td>{{ $Nom->Año_Nomina }}</td>
                                        <td>{{ $Nom->Mes_Nomina }}</td>
                                        <td>{{ $Nom->Fecha_Generado }}</td>
                                        <td>{{ $Nom->Total_Bruto }} C$</td>
                                        <td>{{ $Nom->Total_Deducciones}} C$</td>
                                        <td>{{ $Nom->Total_Nomina}} C$</td>
                                        <td> <a href="{{ URL::route('Nomina.edit', $Nom->ID_Nomina)}}" class="btn btn-success btn-fw-success btn-rounded btn-icon-text normalizarboton"><i class="mdi mdi-table-edit"></i></a></td>
                                        <td> <button type="button" onclick="EliminarNomina({{ $Nom->ID_Nomina}},'{{ URL::route('Nomina.index')}}')" class="btn btn-dark btn-fw-success btn-rounded btn-icon"><i class="mdi mdi-delete"></i></button></td>
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