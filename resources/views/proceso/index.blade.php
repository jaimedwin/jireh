@extends('admin.index')

@section('content')

<div class="card card-secondary">

  <div class="card-header">
    <h3 class="card-title"><a href="{{route('proceso.index')}}">{{'Proceso'}}</a></h3>
    <div class="card-tools">
      <form action="{{route('proceso.index')}}" method="get">
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
  <!-- /.card-header -->
  <div class="card-body">
    <div class="row  mb-4">
      <div class="col-12">
        <a href="{{route('proceso.create')}}" class="btn btn-primary" role="button" aria-label="Buscar">
          <i class="fas fa-plus-square"></i>
          {{'Crear nuevo proceso'}}
        </a>
      </div>
    </div>

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

    <div class="row">
      <div class="col-12">
        <table class="table table-bordered table-striped">
          <thead class="">
            <tr>
              <th style="width: 10px">{{'#'}}</th>
              <th>{{'Código'}}</th>
              <th>{{'Número del'}}<br>{{'proceso'}}</th>
              <th>{{'Ciudad del'}}<br>{{'proceso'}}</th>
              <th>{{'Corporación'}}</th>
              <th>{{'Ponente'}}</th>
              <th>{{'Estado'}}</th>
              <th style="width: 140px" class="text-center">{{'Actuación y'}}<br>{{'Recordatorio'}}</th>
              <th style="width: 160px" class="text-center">{{'Acciones'}}</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($Consultas as $proceso)
            <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{$proceso->codigo}}</td>
              <td>{{$proceso->numero}}</td>
              <td>{{$proceso->ciudadproceso}}</td>
              <td>{{$proceso->corporacion}}</td>
              <td>{{$proceso->ponente}}</td>
              <td>{{$proceso->estado}}</td>
              <td class="text-center">
                <div class="btn-group">
                  <a href="{{route ('proceso.actuacion.index',$proceso->id)}}" class="btn btn-outline-primary"
                    role="button">
                    <i class="fas fa-cogs">
                    </i>
                    <span data-toggle="tooltip" title="{{'Total de actuaciones: '. $proceso->total_actuacion}}"
                      class="badge badge-info">{{$proceso->total_actuacion}}</span>
                  </a>
                  <a href="{{route ('proceso.recordatorio.index',$proceso->id)}}" class="btn btn-outline-success"
                    role="button">
                    <i class="fas fa-bell"></i>
                  </a>
                </div>
              </td>
              <td class="text-center">
                <form action="{{route('proceso.destroy', $proceso->id)}}" method="post">
                  @method('DELETE')
                  @csrf
                  <div class="btn-group" role="group" aria-label="Acciones">
                    <a href="{{route('proceso.show', $proceso->id)}}" class="btn btn-info" role="button"
                      aria-label="Mostrar">
                      <i class="far fa-eye" aria-hidden="true"></i>
                    </a>
                    <a href="{{route('proceso.edit', $proceso->id)}}" class="btn btn-warning" aria-label="Editar">
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
    <div class="float-right">{{$Consultas->links()}}</div>
  </div>
</div>
@endsection