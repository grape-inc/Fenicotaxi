@extends('layouts.layout')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-format-list-bulleted"></i>
            </span> Informe de Cierre (Arqueo y Ventas) </h3>
            @include('flash::message')
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Informe de Arqueos y Ventas Registrados en el sistema</h4>
                        <div class="table-responsive">
                            <table id="TablaArqueo" class="table table-hover table-bordered">
                                <thead class="thead-dark">
                                </thead>
                                <tbody>
                                @php $result = $arqueo->unique('ID_Jornada')->pluck('ID_Jornada') @endphp
                                @php $valor = 0 @endphp

                                @foreach($result as $key=>$res)
                                    <tr>
                                        <th colspan="9" style="text-align: center; background: #ebedf2;"></th>
                                    </tr>
                                    <tr>
                                        <th colspan="9" style="text-align: center; background: #ebedf2;">
                                        ARQUEO CORRESPONDIENTE: JORNADA {{$res}}
                                        </th>
                                    </tr>
                                    <tr>
                                    <th>ID Jornada</th>
                                    <th>Fecha Jornada</th>
                                    <th>Saldo Inicial</th>
                                    <th>Status Jornada</th>
                                    <th>Saldo final</th>
                                    <th>ID Empleado</th>
                                    <th>Cierre Asignado A:</th>
                                    </tr>
                                  @php $valor = 0 @endphp
                                  @php $suma_total_facturado = 0 @endphp
                                  @php $diferencia = 0 @endphp
                                  @php $divisa = "C$" @endphp
                                  @php $inicial_saldo = 0 @endphp

                                  @foreach($arqueo as $keyarq=>$arq)
                                    @if ($arq->ID_DE_ARQUEO == $res)
                                      <tr>
                                        @if ($valor == 0 )
                                          <td>{{ $arq->ID_Jornada }}</td>
                                          <td>{{ $arq->Fecha_Jornada }}</td>
                                          <td>{{ $arq->Saldo_Inicial }}</td>
                                          @if ($arq->Jornada_Abierta == 0)
                                            <td><span class="badge badge-success">Cerrada</span></td>
                                          @else
                                            <td><span class="badge badge-danger">Abierta</span></td>
                                          @endif
                                          <td>{{ $arq->Saldo_Final }}</td>
                                          <td>{{ $arq->ID_empleado }}</td>
                                          <td>{{ $arq->Cierre_Asignado }}</td>

                                          @php $inicial_saldo = $arq->Saldo_Inicial @endphp
                                          <tr>
                                            <th>No. Jornada</th>
                                            <th>Fecha Facturación</th>
                                            <th>Codigo Factura</th>
                                            <th>Facturado A</th>
                                            <th>Tipo Factura</th>
                                            <th>Moneda Factura</th>
                                            <th>Total Factura</th>
                                            <th>Nombre Empleado</th>
                                          </tr>
                                        @endif

                                        <tr>
                                          <td>{{ $arq->ID_DE_ARQUEO }}</td>
                                          <td>{{ $arq->Fecha_Realizacion }}</td>
                                          <td>{{ $arq->Codigo_Factura }}</td>
                                          <td>{{ $arq->Nombre }} {{$arq->Apellido }}</td>
                                          @if ($arq->Es_Credito == 0)
                                            <td><span class="badge badge-success">Contado</span></td>
                                          @else
                                            <td><span class="badge badge-danger">Credito</span></td>
                                          @endif

                                          @if ($arq->ID_Divisa == 1)
                                            <td><span class="badge badge-success">Dolares</span></td>
                                          @else
                                            <td><span class="badge badge-danger">Cordobas</span></td>
                                          @endif
                                          <td>{{ $arq->total_facturado }}</td>
                                          <td>{{ $arq->Nombre_Empleado }}</td>
                                        </tr>
                                      </tr>
                                      @php $valor += 1 @endphp
                                      @php $suma_total_facturado += $arq->total_facturado @endphp
                                      @php $diferencia = (($arq->Saldo_Final - $suma_total_facturado) - $arq->Saldo_Inicial)  @endphp
                                    @endif

                                    @if ($arq->ID_Divisa == 1)
                                    $divisa = "$"
                                    @endif

                                    @endforeach
                                    <tr>
                                        <td colspan="2" style="text-align: right; font-weight: bold;">Total Arqueo Caja: </td>
                                        <td colspan="3" style="text-align: left; font-weight: bold;">
                                        {{$divisa}} {{$inicial_saldo}} </td>

                                        <td style="text-align: right; font-weight: bold;">Total Facturado: </td>
                                        <td colspan="5" style="text-align: left; font-weight: bold;">
                                        {{$divisa}} {{$suma_total_facturado}} </td>
                                    </tr>

                                    <tr>
                                        <td colspan="3"></td>
                                        @if ($diferencia == 0)
                                          <td colspan="3" style="font-size: 28px; text-align: center; font-weight: bold; color: white; background: #1bcfb4;">Diferencia: {{$divisa}} {{$diferencia}}</span></td>
                                        @else
                                          <td colspan="3" style="font-size: 28px; text-align: center; font-weight: bold; color: white; background: #fe7c96;">Diferencia: {{$divisa}} {{$diferencia}}</span></td>
                                        @endif
                                        <td colspan="3"></td>
                                    </tr>
                                    <tr>
                                        <th colspan="9"></th>
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
