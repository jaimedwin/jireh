@extends('admin.index')

@section('content')
<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title"><a href="{{route('clienteproceso.index')}}">{{'Cliente y proceso'}}</a></h3>
    </div>


    <div class="card-body">
        @include('admin.errors')

        <form action="{{route('clienteproceso.update', $clienteproceso->id)}}" method="post" autocomplete="off">
            @csrf
            @method('PUT')
            <div class="row mb-4">
                <div class="col-12">
                    <div class="form-group">
                        <label for="personanatural_id">{{'Persona natural *'}}</label>
                        <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" id="personanatural_id"
                            name="personanatural_id">
                            @foreach ($Personasnaturales as $personanatural)
                                @if ($personanatural->id == $clienteproceso->personanatural_id)
                                <option
                                    data-tokens="{{$personanatural->numerodocumento}} {{$personanatural->nombrecompleto}}"
                                    value="{{$personanatural->id}}" 
                                    data-subtext="{{$personanatural->nombrecompleto}}" selected>
                                    {{$personanatural->numerodocumento}}
                                </option>
                                @else
                                <option
                                    data-tokens="{{$personanatural->numerodocumento}} {{$personanatural->nombrecompleto}}"
                                    value="{{$personanatural->id}}" 
                                    data-subtext="{{$personanatural->nombrecompleto}}">
                                    {{$personanatural->numerodocumento}}
                                </option>
                                @endif
                            
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="proceso_id">{{'Proceso *'}}</label>
                        <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" id="proceso_id"
                            name="proceso_id">
                            @foreach ($Procesos as $proceso)
                                @if ($proceso->id == $clienteproceso->proceso_id)
                                <option
                                    data-tokens="{{$proceso->numero}} {{$proceso->codigo}}"
                                    value="{{$proceso->id}}" 
                                    data-subtext="{{$proceso->numero}}"  selected>
                                    {{$proceso->codigo}}
                                </option>
                                @else
                                <option
                                    data-tokens="{{$proceso->numero}} {{$proceso->codigo}}"
                                    value="{{$proceso->id}}"
                                    data-subtext="{{$proceso->numero}}">
                                    {{$proceso->codigo}}
                                </option>
                                @endif
                            
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tipodemanda_id">{{'Tipo de demanda *'}}</label>
                        <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" id="tipodemanda_id"
                            name="tipodemanda_id">
                            @foreach ($Tiposdemandas as $tipodemanda)
                                @if ($tipodemanda->id == $clienteproceso->tipodemanda_id)
                                <option
                                    data-tokens="{{$tipodemanda->abreviatura}} {{$tipodemanda->descripcion}}"
                                    value="{{$tipodemanda->id}}" 
                                    data-subtext="{{$tipodemanda->descripcion}}" selected>
                                    {{$tipodemanda->abreviatura}}
                                </option>
                                @else
                                <option
                                    data-tokens="{{$tipodemanda->abreviatura}} {{$tipodemanda->descripcion}}"
                                    value="{{$tipodemanda->id}}"
                                    data-subtext="{{$tipodemanda->descripcion}}">
                                    {{$tipodemanda->abreviatura}}
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
