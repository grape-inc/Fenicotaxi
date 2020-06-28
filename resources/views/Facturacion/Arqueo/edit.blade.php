@extends('layouts.layout')
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-format-list-bulleted"></i>
        </span> Arqueo </h3>
        @include('flash::message')
        @if (count($errors)>0)
        <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
            </ul>
        </div>
        @endif
        <a type="button" href="{{ URL::route('Arqueo.index')}}" class="btn btn-danger btn-icon-text"><i class="mdi mdi-keyboard-backspace"></i> Regresar </a>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Formulario de Arqueo de Caja</h4>
                <p class="card-description">Completa los campos para cerrar la caja</p>
                {{ Form::open(array('url' => URL::route('Arqueo.update', $arqueo->ID_Jornada), 'method' => 'put'))}}
                    @csrf
                    <ul class="nav nav-pills nav-pills-success" id="arqueoTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="cordobas-tab" data-toggle="tab" href="#cordobas" role="tab" aria-controls="cordobas" aria-selected="true">Córdoba</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link ml-4" id="dolares-tab" data-toggle="tab" href="#dolares" role="tab" aria-controls="dolares" aria-selected="false">Dólar</a>
                      </li>
                    </ul>
                    <div class="tab-content mt-4" id="myTabContent">
                      <div class="tab-pane fade show active" id="cordobas" role="tabpanel" aria-labelledby="cordobas-tab">
                        @include('Facturacion.Arqueo.cordobas')
                      </div>
                      <div class="tab-pane fade" id="dolares" role="tabpanel" aria-labelledby="dolares-tab">
                        @include('Facturacion.Arqueo.dolares')
                      </div>
                    </div>
                    <div class="row justify-content-center">
                        <button type="submit" class="btn btn-gradient-dark btn-icon-text text-center mb-4"> Cerrar Caja <i class="mdi mdi-file-check btn-icon-append"></i></button>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection