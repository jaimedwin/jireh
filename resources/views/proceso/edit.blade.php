@extends('admin.index')

@section('content')
<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title"><a href="{{route('proceso.index')}}">{{'Proceso'}}</a></h3>
    </div>


    <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger">
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
        @endif

        <form action="{{route('proceso.update', $proceso->id)}}" method="post">
            @csrf
            @method('PUT')
            <div class="row mb-4">
                <div class="col-12">
                    <div class="form-group">
                        <label for="proceso.codigo">{{'Código'}}</label>
                        <input type="text" class="form-control" id="proceso.codigo" name="codigo"
                            value="{{$proceso->codigo}}">
                    </div>
                    <div class="form-group">
                        <label for="proceso.numero">{{'Número del proceso'}}</label>
                        <input type="text" class="form-control" id="proceso.numero" name="numero"
                            value="{{$proceso->numero}}">
                    </div>


                    <div class="form-group">
                        <label for="proceso.ciudadproceso">{{'Ciudad de proceso'}}</label>
                        <select class="form-control custom-select" id="proceso.ciudadproceso" name="ciudadproceso_id">
                            @foreach ($ciudadprocesos as $ciudadproceso)
                            @if ($ciudadproceso->id == $proceso->ciudadproceso_id)
                            <option value="{{$ciudadproceso->id}}" selected>
                                {{$ciudadproceso->id}}- {{$ciudadproceso->nombre}}
                            </option>
                            @else
                            <option value="{{$ciudadproceso->id}}">
                                {{$ciudadproceso->id}}- {{$ciudadproceso->nombre}}
                            </option>
                            @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="proceso.coporacion">{{'Corporación'}}</label>
                        <select class="form-control custom-select" id="proceso.coporacion" name="corporacion_id">
                            @foreach ($corporacions as $corporacion)
                            @if ($corporacion->id == $proceso->corporacion_id)
                            <option value="{{$corporacion->id}}" selected>
                                {{$corporacion->id}}- {{$corporacion->nombre}}
                            </option>
                            @else
                            <option value="{{$corporacion->id}}">
                                {{$corporacion->id}}- {{$corporacion->nombre}}
                            </option>
                            @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="proceso.ponente">{{'Ponente'}}</label>
                        <select class="form-control custom-select" id="proceso.ponente" name="ponente_id">
                            @foreach ($ponentes as $ponente)
                                @if ($ponente->id == $proceso->ponente_id)
                                    <option value="{{$ponente->id}}" selected>
                                        {{$ponente->id}}- {{$ponente->nombrecompleto}}
                                    </option>
                                @else
                                    <option value="{{$ponente->id}}">
                                        {{$ponente->id}}- {{$ponente->nombrecompleto}}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="proceso.estado">{{'Estado'}}</label>
                        <select class="form-control custom-select" id="proceso.estado" name="estado_id">
                            @foreach ($estados as $estado)
                                @if ($estado->id == $proceso->estado_id)
                                    <option value="{{$estado->id}}" selected>
                                        {{$estado->id}}- {{$estado->descripcion}}
                                    </option>
                                @else
                                    <option value="{{$estado->id}}">
                                        {{$estado->id}}- {{$estado->descripcion}}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="sr-only" for="users_id">users_id</label>
                        <input id="users_id" class="form-control" type="hidden" name="users_id" value="{{ Auth::id()}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="{{route('proceso.index')}}" class="btn btn-secondary" role="button" aria-label="Cancelar">
                        {{'Cancelar'}}
                    </a>
                    <button type="submit" class="btn btn-success float-right">
                        {{'Actualizar'}}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection