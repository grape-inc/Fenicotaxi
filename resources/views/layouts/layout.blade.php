<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Fenicotaxi - Sistema</title>
    <link rel="stylesheet" href="{{{asset('vendors/mdi/css/materialdesignicons.min.css')}}}">
    <link rel="stylesheet" href="{{{asset('vendors/css/vendor.bundle.base.css')}}}">
    <link rel="stylesheet" href="{{{asset('css/style.css')}}}">
    <link rel="stylesheet" href="{{{asset('css/dataTables.bootstrap4.min.css')}}}">
    <link rel="stylesheet" href="{{{asset('css/bootstrap-select.min.css')}}}">
    <link rel="icon" href="{{{asset('images/favicon.png')}}}" />
  </head>
  <body>
    <div class="container-scroller">
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="#"><img src="{{{asset('images/logo_fenicotaxi.png')}}}" alt="logo" /></a>
          <a class="navbar-brand brand-logo-mini" href="#"><img src="{{{asset('images/logo_fenicotaxi.png')}}}" alt="logo" /></a>
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
                  @if(session('Imagen') != "")
                    <img id="imagethumbnail" src ="data:image/png;base64,{{{session('Imagen')}}}"  alt="ImagenProducto" class="img-thumbnail">
                  @else
                    <img id="imagethumbnail" src="{{{asset('images/dummy.jpg')}}}"/>
                  @endif
                  <span class="availability-status online"></span>
                </div>
                <div class="nav-profile-text">
                  <p class="mb-1 text-black">{{session("Nombre") . " " . session("Apellido") }}</p>
                </div>
              </a>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="{{ URL::route('Empleado.edit', session('ID_Empleado'))}}">
                  <i class="mdi mdi-cached mr-2 text-success"></i> Mi Perfil </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ action('LoginController@matar_sesion') }}">
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
                <a class="nav-link" data-toggle="collapse" href="#inventario" aria-expanded="false" aria-controls="ui-basic">
                  <span class="menu-title">Inventario</span>
                  <i class="menu-arrow"></i>
                  <i class="mdi mdi-clipboard-text menu-icon"></i>
                </a>
                <div class="collapse" id="inventario">
                  <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ URL::route('Productos.index')}}">Productos</a></li>
                    @if (session('Rol') == 1 || session('Rol') == 3 )
                      <li class="nav-item"> <a class="nav-link" href="{{ URL::route('Proveedores.index')}}">Proveedores</a></li>
                      <li class="nav-item"> <a class="nav-link" href="{{ URL::route('Categorias.index')}}">Categorias</a></li>
                      <li class="nav-item"> <a class="nav-link" href="{{ URL::route('UnidadesDeMedida.index')}}">Unidades de medida</a></li>
                      <li class="nav-item"> <a class="nav-link" href="{{ URL::route('Ingresos.index')}}">Ingresos</a></li>
                    @endif
                  </ul>
                </div>
              </li>

            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#facturacion" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Facturación</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-point-of-sale menu-icon"></i>
              </a>
              <div class="collapse" id="facturacion">
                <ul class="nav flex-column sub-menu">
                  @if (session('Rol') == 1 )
                    <li class="nav-item"> <a class="nav-link" href="{{ URL::route('Cliente.index')}}">Clientes</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ URL::route('TipoPago.index')}}">Tipos de Pago</a></li>
                  @endif

                  <li class="nav-item"> <a class="nav-link" href="{{ URL::route('Venta.index')}}">Ventas</a></li>

                  @if (session('Rol') == 2 || session('Rol') == 1 )
                    <li class="nav-item"> <a class="nav-link" href="{{ URL::route('Arqueo.index')}}">Arqueo</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ URL::route('InformeDeCierre.index')}}">Informe de Cierre</a></li>
                  @endif
                </ul>
              </div>
            </li>

            @if (session('Rol') == 1)
              <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#nomina" aria-expanded="false" aria-controls="ui-basic">
                  <span class="menu-title">Nómina</span>
                  <i class="menu-arrow"></i>
                  <i class="mdi mdi-point-of-sale menu-icon"></i>
                </a>
                <div class="collapse" id="nomina">
                  <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ URL::route('Cargo.index')}}">Cargos</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ URL::route('Empleado.index')}}">Empleados</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ URL::route('Nomina.index')}}">Generar Nómina</a></li>
                  </ul>
                </div>
              </li>
            @endif

            <li id="configuracion_menu" class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#configuracion" aria-expanded="false" aria-controls="nomina">
                <span class="menu-title">Configuración</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi mdi-settings menu-icon"></i>
              </a>

              <div class="collapse" id="configuracion">
                <ul class="nav flex-column sub-menu">
                  @if (session('Rol') == 2 || session('Rol') == 1 )
                    <li class="nav-item"> <a class="nav-link" href="{{ URL::route('Usuarios.index')}}">Usuarios</a></li>
                  @endif

                  @if (session('Rol') == 1)
                    <li class="nav-item"> <a class="nav-link" href="{{ URL::route('Divisa.index')}}">Divisas</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ URL::route('Rol.index')}}">Roles</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ URL::route('Activities.index')}}">Logs</a></li>
                  @endif
                </ul>
              </div>




             </li>
          </ul>
        </nav>
        <!-- Contenido -->
       <div class="main-panel">
        @yield('content')
       <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2020. Todos los derechos reservados.</span>
            </div>
          </footer>
       </div>
      </div>
    </div>

    <script>
     if (document.querySelectorAll('#configuracion_menu div li').length == 0) {
      document.querySelector("#configuracion_menu").style.display = 'none';
     }
    </script>

    <script src="{{{asset('vendors/js/vendor.bundle.base.js')}}}"></script>
    <script src="{{{asset('js/Plugins/jquery.dataTables.min.js')}}}"></script>
    <script src="{{{asset('js/Plugins/dataTables.bootstrap4.min.js')}}}"></script>
    <script src="{{{asset('js/Plugins/dataTables.buttons.min.js')}}}"></script>
    <script src="{{{asset('js/Plugins/jszip.min.js')}}}"></script>
    <script src="{{{asset('js/Plugins/pdfmake.min.js')}}}"></script>
    <script src="{{{asset('js/Plugins/vfs_fonts.js')}}}"></script>
    <script src="{{{asset('js/Plugins/buttons.html5.min.js')}}}"></script>
    <script src="{{{asset('js/Plugins/buttons.print.min.js')}}}"></script>
    <script src="{{{asset('js/Plugins/bootstrap-select.min.js')}}}"></script>
    <script src="{{{asset('js/Plugins/sweetalert.js')}}}"></script>
    <script src="{{{asset('js/Plugins/misc.js')}}}"></script>
    <script src="{{{asset('js/Plugins/hoverable-collapse.js')}}}"></script>
    <script src="{{{asset('js/Plugins/jquery.mask.js')}}}"></script>
    @stack('scripts-vista')
  </body>
</html>