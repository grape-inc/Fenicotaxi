@extends('layouts.layout')
@push('scripts-vista')
@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-format-list-bulleted"></i>
            </span> Logs </h3>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Logs de acciones del sistema</h4>
                        <div class="table-responsive">
                            <table id="TablaVenta" class="table table-hover table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID Log</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Modelo</th>
                                        <th>ID Modelo</th>
                                        <th>Fecha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($records as $activity)
                                    <tr>
                                      <td>{{ $activity->id }}</td>
                                      <td>{{ $activity->log_name }}</td>
                                      <td>{{ $activity->description }}</td>
                                      <td>{{ $activity->subject_type }}</td>
                                      <td>{{ $activity->subject_id }}</td>
                                      <td>{{ $activity->created_at }}</td>
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