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
      <div class="form-group">
        {{Form::label('Total_Cordobas', 'Total Cordobas')}}
        <div class="input-group">
            <div class="input-group-prepend">
                <button class="btn btn-sm btn-primary" type="button">
                    <i class="mdi mdi-calendar-range"></i>
                </button>
            </div>
            <input class="form-control" readonly value = "{{$total_cordobas}}">
        </div>
    </div>
  </div>

  <div class="col-md-2">
      <div class="form-group">
          {{Form::label('B10', 'Billetes 10')}}
          <div class="input-group">
              <div class="input-group-prepend">
                  <button class="btn btn-sm btn-primary" type="button">
                      <i class="mdi mdi-cash"></i>
                  </button>
              </div>
                  <input type="number" class="form-control" placeholder="Monto" name="B10" value = "{{$arqueo->B10}}">
          </div>
          @error('B10')
          <p class="text-danger">{{ $message }}</p>
      @enderror
      </div>
      <div class="form-group">
          {{Form::label('B20', 'Billetes 20')}}
          <div class="input-group">
              <div class="input-group-prepend">
                  <button class="btn btn-sm btn-primary" type="button">
                      <i class="mdi mdi-cash"></i>
                  </button>
              </div>
                  <input type="number" class="form-control" placeholder="Monto" name="B20" value = "{{$arqueo->B20}}">
          </div>
          @error('B20')
          <p class="text-danger">{{ $message }}</p>
      @enderror
      </div>
      <div class="form-group">
          {{Form::label('B50', 'Billetes 50')}}
          <div class="input-group">
              <div class="input-group-prepend">
                  <button class="btn btn-sm btn-primary" type="button">
                      <i class="mdi mdi-cash"></i>
                  </button>
              </div>
                  <input type="number" class="form-control" placeholder="Monto" name="B50" value = "{{$arqueo->B50}}">
          </div>
          @error('B50')
          <p class="text-danger">{{ $message }}</p>
      @enderror
      </div>
      <div class="form-group">
          {{Form::label('M1', 'Moneda 1')}}
          <div class="input-group">
              <div class="input-group-prepend">
                  <button class="btn btn-sm btn-primary" type="button">
                      <i class="mdi mdi-coins"></i>
                  </button>
              </div>
                  <input type="number" class="form-control" placeholder="Monto" name="M1" value = "{{$arqueo->M1}}">
          </div>
          @error('M1')
          <p class="text-danger">{{ $message }}</p>
      @enderror
      </div>
      <div class="form-group">
            {{Form::label('Centavos_Cordobas', 'Centavos Cordobas')}}
            <div class="input-group">
                <div class="input-group-prepend">
                    <button class="btn btn-sm btn-primary" type="button">
                        <i class="mdi mdi-cash"></i>
                    </button>
                </div>
                    <input type="number" step="0.01" class="form-control" placeholder="Monto" name="Centavos_Cordobas" value = "{{$arqueo->Centavos_Cordobas}}">
            </div>
            @error('Centavos_Cordobas')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        </div>
  </div>

    <div class="col-md-2">
        <div class="form-group">
            {{Form::label('B100', 'Billetes 100')}}
            <div class="input-group">
                <div class="input-group-prepend">
                    <button class="btn btn-sm btn-primary" type="button">
                        <i class="mdi mdi-cash"></i>
                    </button>
                </div>
                    <input type="number" class="form-control" placeholder="Monto" name="B100" value = "{{$arqueo->B100}}">
            </div>
            @error('B100')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        </div>
        <div class="form-group">
            {{Form::label('B200', 'Billetes 200')}}
            <div class="input-group">
                <div class="input-group-prepend">
                    <button class="btn btn-sm btn-primary" type="button">
                        <i class="mdi mdi-cash"></i>
                    </button>
                </div>
                    <input type="number" class="form-control" placeholder="Monto" name="B200" value = "{{$arqueo->B200}}">
            </div>
            @error('B200')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        </div>
        <div class="form-group">
            {{Form::label('B500', 'Billetes 500')}}
            <div class="input-group">
                <div class="input-group-prepend">
                    <button class="btn btn-sm btn-primary" type="button">
                        <i class="mdi mdi-cash"></i>
                    </button>
                </div>
                    <input type="number" class="form-control" placeholder="Monto" name="B500" value = "{{$arqueo->B500}}">
            </div>
            @error('B500')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        </div>
        <div class="form-group">
            {{Form::label('M5', 'Moneda 5')}}
            <div class="input-group">
                <div class="input-group-prepend">
                    <button class="btn btn-sm btn-primary" type="button">
                        <i class="mdi mdi-coins"></i>
                    </button>
                </div>
                    <input type="number" class="form-control" placeholder="Monto" name="M5" value = "{{$arqueo->M5}}">
            </div>
            @error('M5')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            {{Form::label('B1000', 'Billetes 1000')}}
            <div class="input-group">
                <div class="input-group-prepend">
                    <button class="btn btn-sm btn-primary" type="button">
                        <i class="mdi mdi-cash"></i>
                    </button>
                </div>
                    <input type="number" class="form-control" placeholder="Monto" name="B1000" value = "{{$arqueo->B1000}}">
            </div>
            @error('B1000')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        </div>
        <div class="form-group">
            {{Form::label('M025', 'Moneda 0.25')}}
            <div class="input-group">
                <div class="input-group-prepend">
                    <button class="btn btn-sm btn-primary" type="button">
                        <i class="mdi mdi-coins"></i>
                    </button>
                </div>
                    <input type="number" class="form-control" placeholder="Monto" name="M025" value = "{{$arqueo->M025}}">
            </div>
            @error('M025')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        </div>
        <div class="form-group">
            {{Form::label('M050', 'Moneda 0.50')}}
            <div class="input-group">
                <div class="input-group-prepend">
                    <button class="btn btn-sm btn-primary" type="button">
                        <i class="mdi mdi-coins"></i>
                    </button>
                </div>
                    <input type="number" min="1" step="any" class="form-control" placeholder="Monto" name="M050" value = "{{$arqueo->M050}}">
            </div>
            @error('M050')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        </div>
        <div class="form-group">
            {{Form::label('Saldo_Final', 'Saldo Final')}}
            <div class="input-group">
                <div class="input-group-prepend">
                    <button class="btn btn-sm btn-primary" type="button">
                        <i class="mdi mdi-cash"></i>
                    </button>
                </div>
                    <input type="number" step="0.01" class="form-control" placeholder="Monto" name="Saldo_Final" value = "{{$arqueo->Saldo_Final}}">
            </div>
            @error('Saldo_Final')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        </div>
    </div>
</div>
