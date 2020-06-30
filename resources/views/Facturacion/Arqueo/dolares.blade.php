<div class="row">
  <div class="col-md-6">
      <div class="form-group">
          {{Form::label('ID_Jornada', 'ID de la Jornada')}}
          <div class="input-group">
              <div class="input-group-prepend">
                  <button class="btn btn-sm btn-primary" type="button">
                      <i class="mdi mdi-upload-network-outline"></i>
                  </button>
              </div>
                  <input type="text" class="form-control" readonly value = "{{$arqueo->ID_Jornada}}">
          </div>
      </div>
      <div class="form-group">
          {{Form::label('Saldo Inicial', 'Saldo Inicial de la Jornada')}}
          <div class="input-group">
              <div class="input-group-prepend">
                  <button class="btn btn-sm btn-primary" type="button">
                      <i class="mdi mdi-cash-register"></i>
                  </button>
              </div>
                  <input type="text" class="form-control" readonly name="Saldo_Inicial" value = "{{$arqueo->Saldo_Inicial}}">
          </div>
      </div>
      <div class="form-group">
          {{Form::label('Empleado', 'Nombre del Empleado')}}
          <div class="input-group">
              <div class="input-group-prepend">
                  <button class="btn btn-sm btn-primary" type="button">
                      <i class="mdi mdi-account-box"></i>
                  </button>
              </div>
              <select name="ID_Empleado" class="selectpicker form-control" title="Escoja el empleado..." data-live-search="true">
                  @foreach ($empleado as $emp)
                      @if ($emp->ID_Empleado == $arqueo->ID_Empleado)
                       <option value="{{ $emp->ID_Empleado}}" selected>{{$emp->Nombre_Empleado}}</option>
                      @endif
                  @endforeach
              </select>
          </div>
      </div>
      <div class="form-group">
          {{Form::label('Fecha_Jornada', 'Fecha de la Jornada')}}
          <div class="input-group">
              <div class="input-group-prepend">
                  <button class="btn btn-sm btn-primary" type="button">
                      <i class="mdi mdi-calendar-range"></i>
                  </button>
              </div>
              <input type="datetime" class="form-control" readonly name="Fecha_Jornada" value = "{{$arqueo->Fecha_Jornada}}">
          </div>
      </div>
  </div>

  {{--- Columna de Dolares ---}}
  <div class="col-md-2">
      <div class="form-group">
          {{Form::label('BD1', 'Billetes 1')}}
          <div class="input-group">
              <div class="input-group-prepend">
                  <button class="btn btn-sm btn-primary" type="button">
                      <i class="mdi mdi-cash"></i>
                  </button>
              </div>
                  <input type="number" class="form-control" placeholder="Monto" name="BD1" value = "{{$arqueo->BD1}}">
          </div>
          @error('BD1')
          <p class="text-danger">{{ $message }}</p>
      @enderror
      </div>
      <div class="form-group">
          {{Form::label('BD2', 'Billetes 2')}}
          <div class="input-group">
              <div class="input-group-prepend">
                  <button class="btn btn-sm btn-primary" type="button">
                      <i class="mdi mdi-cash"></i>
                  </button>
              </div>
                  <input type="number" class="form-control" placeholder="Monto" name="BD2" value = "{{$arqueo->BD2}}">
          </div>
          @error('BD2')
          <p class="text-danger">{{ $message }}</p>
      @enderror
      </div>
      <div class="form-group">
          {{Form::label('BD5', 'Billetes 5')}}
          <div class="input-group">
              <div class="input-group-prepend">
                  <button class="btn btn-sm btn-primary" type="button">
                      <i class="mdi mdi-cash"></i>
                  </button>
              </div>
                  <input type="number" class="form-control" placeholder="Monto" name="BD5" value = "{{$arqueo->BD5}}">
          </div>
          @error('BD5')
          <p class="text-danger">{{ $message }}</p>
      @enderror
      </div>
      <div class="form-group">
          {{Form::label('BD10', 'Billetes 10')}}
          <div class="input-group">
              <div class="input-group-prepend">
                  <button class="btn btn-sm btn-primary" type="button">
                      <i class="mdi mdi-coins"></i>
                  </button>
              </div>
                  <input type="number" class="form-control" placeholder="Monto" name="BD10" value = "{{$arqueo->BD10}}">
          </div>
          @error('BD10')
          <p class="text-danger">{{ $message }}</p>
      @enderror
      </div>
  </div>
  {{--- Segunda Columna---}}
  <div class="col-md-2">
        <div class="form-group">
            {{Form::label('BD20', 'Billetes 20')}}
            <div class="input-group">
                <div class="input-group-prepend">
                    <button class="btn btn-sm btn-primary" type="button">
                        <i class="mdi mdi-cash"></i>
                    </button>
                </div>
                    <input type="number" class="form-control" placeholder="Monto" name="BD20" value = "{{$arqueo->BD20}}">
            </div>
            @error('BD20')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        </div>
        <div class="form-group">
            {{Form::label('BD50', 'Billetes 50')}}
            <div class="input-group">
                <div class="input-group-prepend">
                    <button class="btn btn-sm btn-primary" type="button">
                        <i class="mdi mdi-cash"></i>
                    </button>
                </div>
                    <input type="number" class="form-control" placeholder="Monto" name="BD50" value = "{{$arqueo->BD50}}">
            </div>
            @error('BD50')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        </div>
        <div class="form-group">
            {{Form::label('BD100', 'Billetes 100')}}
            <div class="input-group">
                <div class="input-group-prepend">
                    <button class="btn btn-sm btn-primary" type="button">
                        <i class="mdi mdi-cash"></i>
                    </button>
                </div>
                    <input type="number" class="form-control" placeholder="Monto" name="BD100" value = "{{$arqueo->BD100}}">
            </div>
            @error('BD100')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        </div>
        <div class="form-group">
            {{Form::label('Saldo_Final_Dolar', 'Saldo Final Dolares')}}
            <div class="input-group">
                <div class="input-group-prepend">
                    <button class="btn btn-sm btn-primary" type="button">
                        <i class="mdi mdi-cash"></i>
                    </button>
                </div>
                    <input type="number" step="0.01" class="form-control" placeholder="Monto" name="Saldo_Final_Dolar" value = "{{$arqueo->Saldo_Final_Dolar}}">
            </div>
            @error('Saldo_Final_Dolar')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        </div>
    </div>

    {{--- Tercera Columna---}}
    <div class="col-md-2">
        <div class="form-group">
            {{Form::label('Centavos_Dolares', 'Centavos Dolares')}}
            <div class="input-group">
                <div class="input-group-prepend">
                    <button class="btn btn-sm btn-primary" type="button">
                        <i class="mdi mdi-cash"></i>
                    </button>
                </div>
                    <input type="number" step="0.01" class="form-control" placeholder="Monto" name="Centavos_Dolares" value = "{{$arqueo->Centavos_Dolares}}">
            </div>
            @error('Centavos_Dolares')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        </div>
    </div>
</div>
