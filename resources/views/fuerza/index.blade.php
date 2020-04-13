@extends('admin.index')

@section('content')

<div class="card card-secondary">

  <div class="card-header">
    <h3 class="card-title"><a href="{{route('fuerza.index')}}">{{'Fuerza'}}</a></h3>
    <div class="card-tools">
      <form action="{{route('fuerza.index')}}" method="get">
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
      <div class="col-12">
        <form action="{{ route('fuerza.store')}}" method="post">
            @csrf
            <div class="row mb-4">
                <div class="col-12">
                    <div class="form-group">
                        <label for="fuerza.abreviatura">{{'Abreviatura'}}</label>
                        <input type="text" class="form-control" id="fuerza.abreviatura" name="abreviatura">
                    </div>
                    <div class="form-group">
                        <label for="fuerza.descripcion">{{'Descripción'}}</label>
                        <input type="text" class="form-control" id="fuerza.descripcion" name="descripcion">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="users_id">users_id</label>
                        <input id="users_id" class="form-control" type="hidden" name="users_id" value="{{ Auth::id()}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="{{route('fuerza.index')}}" class="btn btn-secondary" role="button" aria-label="Buscar">
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
      <div class="col-12 table-responsive">
        <table class="table table-bordered table-striped">
          <thead class="">
            <tr>
              <th style="width: 10px">{{'#'}}</th>
              <th>{{'Abreviatura'}}</th>
              <th>{{'Descripción'}}</th>
              <th style="width: 80px" class="text-center">{{'Carrera'}}</th>
              <th style="width: 160px" class="text-center">{{'Acciones'}}</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($Fuerzas as $fuerza)
            <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{$fuerza->abreviatura}}</td>
              <td>{{$fuerza->descripcion}}</td>
              <td class="text-center">
                <a href="{{route('fuerza.carrera.index', $fuerza->id)}}" class="btn btn-outline-success" role="button"
                  aria-label="Mostrar">
                  <i class="fas fa-shield-alt" aria-hidden="true"></i>
                </a>
              </td>
              <td class="text-center">
                <form action="{{route('fuerza.destroy', $fuerza->id)}}" method="post">
                  @method('DELETE')
                  @csrf
                  <div class="btn-group" role="group" aria-label="Acciones">
                    <a href="{{route('fuerza.show', $fuerza->id)}}" class="btn btn-info" role="button"
                      aria-label="Mostrar">
                      <i class="far fa-eye" aria-hidden="true"></i>
                    </a>
                    <a href="{{route('fuerza.edit', $fuerza->id)}}" class="btn btn-warning" aria-label="Editar">
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
    <div class="float-right">{{$Fuerzas->links()}}</div>
  </div>
</div>
@endsection