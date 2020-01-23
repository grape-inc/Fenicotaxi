<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Fenicotaxi</title>
    <link rel="stylesheet" href="{{{asset('vendors/mdi/css/materialdesignicons.min.css')}}}">
    <link rel="stylesheet" href="{{{asset('vendors/css/vendor.bundle.base.css')}}}">
    <link rel="stylesheet" href="{{{asset('css/style.css')}}}">
    <link rel="stylesheet" href="{{{asset('css/dataTables.bootstrap4.min.css')}}}">
    <link rel="icon" href="{{{asset('images/favicon.png')}}}" />
  </head>
  <body>
    <div class="container-scroller">
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="#"><img src="{{{asset('images/logo.svg')}}}" alt="logo" /></a>
          <a class="navbar-brand brand-logo-mini" href="#"><img src="{{{asset('images/logo-mini.svg')}}}" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item d-none d-lg-block full-screen-link">
                <a class="nav-link">
                <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                </a>
            </li>
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <div class="nav-profile-img">
                  <img src="{{{asset('images/faces/face1.jpg')}}}" alt="image">
                  <span class="availability-status online"></span>
                </div>
                <div class="nav-profile-text">
                  <p class="mb-1 text-black">David Greymaax</p>
                </div>
              </a>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="#">
                  <i class="mdi mdi-cached mr-2 text-success"></i> Mi Perfil </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                  <i class="mdi mdi-logout mr-2 text-primary"></i> Cerrar Sesión </a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <div class="container-fluid page-body-wrapper">
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link" href="{{ URL::route('Categorias.index')}}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#inventario" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Inventario</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-wunderlist menu-icon"></i>
              </a>
              <div class="collapse" id="inventario">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Productos</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Proveedores</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{ URL::route('Categorias.index')}}">Categorias</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Unidades de medida</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ URL::route('cliente.index')}}">
                <span class="menu-title">Clientes</span>
                <i class="mdi mdi mdi-bank menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#usuarios" aria-expanded="false" aria-controls="usuarios">
                <span class="menu-title">Usuarios</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-contacts menu-icon"></i>
              </a>
              <div class="collapse" id="usuarios">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Categorias</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Productos</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/forms/basic_elements.html">
                <span class="menu-title">Nomina</span>
                <i class="mdi mdi mdi-bank menu-icon"></i>
              </a>
            </li>
          </ul>
        </nav>
        <!-- Contenido -->
       <div class="main-panel">
        @yield('content')
       <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Hecho por Oscar Rivera y Renner Poveda.</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2020. Todos los derechos reservados.</span>
            </div>
          </footer>
       </div>
      </div>
    </div>
    <script src="{{{asset('vendors/js/vendor.bundle.base.js')}}}"></script>
    <script src="{{{asset('js/Plugins/dataTables.bootstrap4.min.js')}}}"></script>
    <script src="{{{asset('js/Plugins/sweetalert.js')}}}"></script>
    @stack('scripts-vista')
  </body>
</html>