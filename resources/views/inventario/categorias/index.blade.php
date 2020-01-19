@extends('layouts.layout')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-format-list-bulleted"></i>
            </span> Categorias de producto </h3>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Categorias Registradas en el sistema</h4>                    
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>                                    
                                    <th>Editar</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>                            
                            @foreach($Categorias as $CF)
                                <tr>
                                    <td>{{ $CF->ID_Categoria }}</td>
                                    <td>{{ $CF->Nombre_Categoria }}</td>
                                    <td>{{ $CF->Descripcion_Categoria }}</td>
                                    <td> <button type="button" class="btn btn-success btn-fw-success btn-rounded btn-icon"><i class="mdi mdi-table-edit"></i></button>
                                    <td> <button type="button" class="btn btn-dark btn-fw-success btn-rounded btn-icon"><i class="mdi mdi-delete"></i></button>
                                <tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection