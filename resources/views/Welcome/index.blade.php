@extends('layouts.layout')
@section('content')
    <div class="content-wrapper">
        <div id="carousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carousel" data-slide-to="0" class="active"></li>
              <li data-target="#carousel" data-slide-to="1"></li>
              <li data-target="#carousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block w-100" src="{{{asset('images/slider1.jpg')}}}" alt="Bienvenido">
                <div class="carousel-caption">
                    <h3>Bienvenido</h3>
                    <p>Al sistema de Fenicotaxi</p>
                </div>
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="{{{asset('images/slider2.jpg')}}}" alt="First slide">
                <div class="carousel-caption">
                    <h3>Modulos</h3>
                    <p>El sistema cuenta con los modulos de Inventario, Facturación y Nomina</p>
                </div>
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="{{{asset('images/slider3.jpg')}}}" alt="First slide">
                <div class="carousel-caption">
                    <h3>Configuración</h3>
                    <p>Aca puedes configurar las divisas, usuarios y ver los roles habilitados en el sistema.</p>
                </div>
              </div>
            </div>
            <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Siguiente</span>
            </a>
          </div>
    </div>
@endsection