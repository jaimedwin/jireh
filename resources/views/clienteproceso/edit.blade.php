@extends('admin.index')

@section('content')
<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title"><a href="{{route('clienteproceso.index')}}">{{'Cliente y proceso'}}</a></h3>
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

        <form action="{{route('clienteproceso.update', $clienteproceso->id)}}" method="post">
            @csrf
            @method('PUT')
            <div class="row mb-4">
                <div class="col-12">
                    <div class="form-group">
                        <label for="personanatural_id">{{'Persona natural *'}}</label>
                        <select class="form-control selectpicker" data-live-search="true" id="personanatural_id"
                            name="personanatural_id">
                            @foreach ($Personasnaturales as $personanatural)
                                @if ($personanatural->id == $clienteproceso->personanatural_id)
                                <option
                                    data-tokens="{{$personanatural->numerodocumento}} {{$personanatural->nombrecompleto}}"
                                    value="{{$personanatural->id}}" selected>
                                    {{$personanatural->numerodocumento}} - {{$personanatural->nombrecompleto}}
                                </option>
                                @else
                                <option
                                    data-tokens="{{$personanatural->numerodocumento}} {{$personanatural->nombrecompleto}}"
                                    value="{{$personanatural->id}}">
                                    {{$personanatural->numerodocumento}} - {{$personanatural->nombrecompleto}}
                                </option>
                                @endif
                            
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="proceso_id">{{'Proceso *'}}</label>
                        <select class="form-control selectpicker" data-live-search="true" id="proceso_id"
                            name="proceso_id">
                            @foreach ($Procesos as $proceso)
                                @if ($proceso->id == $clienteproceso->proceso_id)
                                <option
                                    data-tokens="{{$proceso->numero}}"
                                    value="{{$proceso->id}}" selected>
                                    {{$proceso->numero}}
                                </option>
                                @else
                                <option
                                    data-tokens="{{$proceso->numero}}"
                                    value="{{$proceso->id}}">
                                    {{$proceso->numero}}
                                </option>
                                @endif
                            
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tipodemanda_id">{{'Tipo de demanda *'}}</label>
                        <select class="form-control selectpicker" data-live-search="true" id="tipodemanda_id"
                            name="tipodemanda_id">
                            @foreach ($Tiposdemandas as $tipodemanda)
                                @if ($tipodemanda->id == $clienteproceso->tipodemanda_id)
                                <option
                                    data-tokens="{{$tipodemanda->abreviatura}} {{$tipodemanda->descripcion}}"
                                    value="{{$tipodemanda->id}}" selected>
                                    {{$tipodemanda->abreviatura}} - {{$tipodemanda->descripcion}}
                                </option>
                                @else
                                <option
                                    data-tokens="{{$tipodemanda->abreviatura}} {{$tipodemanda->descripcion}}"
                                    value="{{$tipodemanda->id}}">
                                    {{$tipodemanda->abreviatura}} - {{$tipodemanda->descripcion}}
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
                    <a href="{{route('clienteproceso.index')}}" class="btn btn-secondary" role="button" aria-label="Cancelar">
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
