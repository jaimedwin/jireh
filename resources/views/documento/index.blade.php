@extends('admin.index')

@section('content')

<div class="card card-secondary">

  <div class="card-header">
    <h3 class="card-title"><a href="{{route('contrato.index')}}">{{'Contrato'}}</a></h3>
    <div class="card-tools">
      <form action="{{route('contrato.index')}}" method="get">
        @csrf
        <div class="input-group input-group-sm" style="width: 150px;">
        <input type="text" name="buscar" class="form-control float-right" placeholder="Buscar">
          <div class="input-group-append">
            <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
          </div>

        </div>
      </form>
    </div>
  </div>
  

  <div class="card-body">
    <div class="row mb-4">
      <div class="col-12">
        <a href="{{route('contrato.create')}}" class="btn btn-primary" role="button" aria-label="Buscar">
          <i class="fas fa-plus-square"></i>
          {{'Crear nuevo contrato'}}
        </a>
      </div>
    </div>

    @if ($messages = Session::get('success'))
    <div class="row">
      <div class="col-12">
        <div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5><i class="icon fa fa-check"></i> {{'Alerta!'}}</h5>
          <ul>
            @foreach ($messages as $message)
              <li>{{$message}}</li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
    @endif
    
    <div class="row mb-4"">
      <div class="col-12">
      @if ($errors->any())
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        <span aria-hidden="true">&times;</span> 
                    </button>
                    <h5><i class="fas fa-exclamation-triangle"></i>
                            <strong>{{'Error!'}}</strong>
                    </h5>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif
      </div>
    </div>

    

    <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-bordered table-striped">
          <thead class="">
            <tr>
              <th style="width: 10px">{{'#'}}</th>
              <th>{{'Número del contrato'}}</th>
              <th>{{'Valor'}}</th>
              <th>{{'Tipo de contrato'}}</th>
              <th>{{'Persona natural'}}</th>
              <th style="width: 80px" class="text-center">{{'Documento'}}</th>
              <th style="width: 80px" class="text-center">{{'Pagos'}}</th>
              <th style="width: 160px" class="text-center">{{'Acciones'}}</th>
            </tr>
          </thead>
          <tbody>
            
            @foreach ($Contratos as $contrato)
            <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{$contrato->numero}}</td>
              <td>{{$contrato->valor}}</td>
              <td>{{$contrato->tipocontrato}}</td>
              <td>{{$contrato->nombrecompleto}}</td>
              <td class="text-center">
                @if ($contrato->nombrearchivo)
                  <a href="{{route('descargas_otrosdocumentos', 
                  [
                    'personanatural' => $contrato->personanatural_id, 
                    'name' => $contrato->nombrearchivo
                  ])}}" 
                  class="btn btn-outline-success">
                    <i class="fa fa-download"></i>
                  </a>
                @endif
              </td>
              <td class="text-center">
                <a href="{{route('contrato.pago.index', $contrato->id)}}" class="btn btn-outline-success" role="button"
                  aria-label="Pagos">
                  <i class="fas fa-dollar-sign" aria-hidden="true"></i>
                </a>
              </td>
              <td class="text-center">
                <form action="{{route('contrato.destroy', $contrato->id)}}" method="post">
                  @method('DELETE')
                  @csrf
                  <div class="btn-group" role="group" aria-label="Acciones">
                    <a href="{{route('contrato.show', $contrato->id)}}" class="btn btn-info" role="button"
                      aria-label="Mostrar">
                      <i class="far fa-eye" aria-hidden="true"></i>
                    </a>
                    <a href="{{route('contrato.edit', $contrato->id)}}" class="btn btn-warning" aria-label="Editar">
                      <i class="fas fa-pen" aria-hidden="true"></i>
                    </a>
                    <button type="submit" class="btn btn-danger" aria-label="Borrar"
                      onclick="return confirm('¿Realmente desea eliminar?')">
                      <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                  </div>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- /.card-body -->
  <div class="card-footer clearfix">
    <div class="float-right">{{$Contratos->links()}}</div>
  </div>
</div>
@endsection