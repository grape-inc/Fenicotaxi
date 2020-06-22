<div class="col-lg-12 grid-margin">
  <div class="dropdown">
    <button class="btn btn btn-info btn-icon-text dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="mdi mdi-apps "></i>
      Filtrar
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenu2" style="height: ">
      {{ Form::open(array('url' => URL::route('Venta.index'), 'method' => 'get', "class" =>"px-4 py-3"))}}
        <div class="form-group">
          <label for="clientes">Clientes</label>
          <select id="ID_Cliente" name="ID_Cliente" class="form-control" title="Escoja el cliente...">
            <option value="">---Selecione Un Cliente---</option>
            @foreach ($cliente as $client)
              <option value="{{ $client->ID_Cliente}}">{{$client->Nombre_Cliente}} {{ $client->Apellido_Cliente}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group ">
          <label for="desde">Desde</label>
          <input name="desde" type="date" class="form-control" id="desde">
          <label for="hasta">Hasta</label>
          <input name="hasta" type="date" class="form-control" id="hasta">
        </div>
        <button type="submit" class="btn btn-primary">Filtrar</button>
        <a href="{{ URL::route('Venta.index')}}" class="btn btn-danger btn-icon-text">Sin Filtros</a>
      {{ Form::close() }}
    </div>
  </div>
</div>