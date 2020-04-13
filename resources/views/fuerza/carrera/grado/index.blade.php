@extends('admin.index')

@section('content')

<div class="card card-secondary">

  <div class="card-header">
    <h3 class="card-title"><a href="{{route('fuerza.carrera.grado.index', [$fuerza_id, $carrera_id])}}">{{'Grado'}}</a></h3>
    <div class="card-tools">
      <form action="{{route('fuerza.carrera.grado.index', [$fuerza_id, $carrera_id])}}" method="get">
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
    
    @if ($message = Session::get('success'))
    <div class="row">
      <div class="col-12">
        <div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5><i class="icon fa fa-check"></i> {{'Alerta!'}}</h5>
          <ul>
            <li>{{$message}}</li>
          </ul>
        </div>
      </div>
    </div>
    @endif

    @include('admin.errors')
    
    <div class="row mb-4"">
      <div class="col-12 table-responsive">
        <form action="{{ route('fuerza.carrera.grado.store', [$fuerza_id, $carrera_id])}}" method="post">
            @csrf
            <div class="row mb-4">
                <div class="col-12">
                    <div class="form-group">
                        <label for="fuerza.carrera.grado.abreviatura">{{'Abreviatura'}}</label>
                        <input type="text" class="form-control" id="fuerza.carrera.grado.abreviatura" name="abreviatura">
                    </div>
                    <div class="form-group">
                        <label for="fuerza.carrera.grado.descripcion">{{'Descripción'}}</label>
                        <input type="text" class="form-control" id="fuerza.carrera.grado.descripcion" name="descripcion">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="users_id">users_id</label>
                        <input id="users_id" class="form-control" type="hidden" name="users_id" value="{{ Auth::id()}}">
                    </div>
                    <div class="form-group">
                      <label class="sr-only" for="fuerza_id">fuerza_id</label>
                      <input id="fuerza_id" class="form-control" type="hidden" name="fuerza_id"
                          value="{{$fuerza_id}}">
                    </div>
                    <div class="form-group">
                      <label class="sr-only" for="carrera_id">carrera_id</label>
                      <input id="carrera_id" class="form-control" type="hidden" name="carrera_id"
                          value="{{$carrera_id}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="{{route('fuerza.carrera.grado.index', [$fuerza_id, $carrera_id])}}" class="btn btn-secondary" role="button" aria-label="Buscar">
                        {{'Cancelar'}}
                    </a>
                    <button type="submit" class="btn btn-success float-right">
                        {{'Agregar'}}
                    </button>
                </div>
            </div>
        </form>
      </div>
    </div>

    

    <div class="row">
      <div class="col-12">
        <table class="table table-bordered table-striped">
          <thead class="">
            <tr>
              <th style="width: 10px">{{'#'}}</th>
              <th>{{'Abreviatura'}}</th>
              <th>{{'Descripción'}}</th>
              <th style="width: 160px" class="text-center">{{'Acciones'}}</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($Grados as $grado)
            <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{$grado->abreviatura}}</td>
              <td>{{$grado->descripcion}}</td>
              <td class="text-center">
                <form action="{{route('fuerza.carrera.grado.destroy', 
                ['fuerza' => $fuerza_id, 'carrera' => $carrera_id, 'grado' => $grado->id])}}" method="post">
                  @method('DELETE')
                  @csrf
                  <div class="btn-group" role="group" aria-label="Acciones">
                    <a href="{{route('fuerza.carrera.grado.show', 
                    ['fuerza' => $fuerza_id, 'carrera' => $carrera_id, 'grado' => $grado->id])}}" class="btn btn-info" role="button"
                      aria-label="Mostrar">
                      <i class="far fa-eye" aria-hidden="true"></i>
                    </a>
                    <a href="{{route('fuerza.carrera.grado.edit', 
                    ['fuerza' => $fuerza_id, 'carrera' => $carrera_id, 'grado' => $grado->id])}}" class="btn btn-warning" aria-label="Editar">
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
    <a href="{{route('fuerza.carrera.index', $fuerza_id)}}" class="btn btn-secondary" role="button" aria-label="Buscar">
      {{'Atras'}}
    </a>
    <div class="float-right">{{$Grados->links()}}</div>
  </div>
</div>
@endsection