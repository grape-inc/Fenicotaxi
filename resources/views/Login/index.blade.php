<!DOCTYPE html>
<html lang="en">
  <head>    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Fenicotaxi - Login</title>
    <link rel="stylesheet" href="{{{asset('vendors/mdi/css/materialdesignicons.min.css')}}}">
    <link rel="stylesheet" href="{{{asset('vendors/css/vendor.bundle.base.css')}}}">
    <link rel="stylesheet" href="{{{asset('css/style.css')}}}">
    <link rel="stylesheet" href="{{{asset('css/dataTables.bootstrap4.min.css')}}}">
    <link rel="stylesheet" href="{{{asset('css/bootstrap-select.min.css')}}}">
    <link rel="icon" href="{{{asset('images/favicon.png')}}}" />
  </head>
  <body>
  {{Form::open(array('url' => URL::route('Login.store'), 'method' => 'post'))}}    
    {{ csrf_field() }}
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">        
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              @include('flash::message')
              <div class="auth-form-light text-left p-5 ajustarbotonlogin">
                <div class="brand-logo logo-login">
                  <img src="{{{asset('images/logo_fenicotaxi.png')}}}">
                </div>
                <h4>¡Hola! Bienvenido</h4>
                <h6 class="font-weight-light">Inicia Sesión para continuar.</h6>
                <form class="pt-3">
                  <div class="form-group">
                      {{Form::label('Usuario', 'Usuario')}}
                      <div class="input-group">                                
                          <div class="input-group-prepend">
                              <button class="btn btn-sm btn-primary" type="button">
                                  <i class="mdi mdi-account"></i>
                              </button>
                          </div>
                          {{ Form::text('Usuario','',array('id'=>'Usuario','class'=>'form-control','placeholder'=>'Ingresa el usuario.'))}}
                      </div>

                      @error('Usuario')
                          <p class="text-danger">{{ $message }}</p>
                      @enderror
                  </div>
                  <div class="form-group">
                      {{Form::label('Password', 'Contraseña')}}
                      <div class="input-group">                                
                          <div class="input-group-prepend">
                              <button class="btn btn-sm btn-primary" type="button">
                                  <i class="mdi mdi-security"></i>
                              </button>
                          </div>                          
                          {{ Form::password('Password',array('id'=>'Password','class'=>'form-control','placeholder'=>'Ingresa tu contraseña'))}}
                      </div>

                      @error('Password')
                          <p class="text-danger">{{ $message }}</p>
                      @enderror
                  </div>
                  <div class="mt-3">                    
                    <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn"> Autenticar </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>      
    </div>
  {{ Form::close() }}
    <script src="{{{asset('vendors/js/vendor.bundle.base.js')}}}"></script>    
    <script src="{{{asset('js/Plugins/sweetalert.js')}}}"></script>
    <script src="{{{asset('js/Plugins/misc.js')}}}"></script>
    <script src="{{{asset('js/Plugins/hoverable-collapse.js')}}}"></script>
  </body>
</html>