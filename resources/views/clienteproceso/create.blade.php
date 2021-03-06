@extends('admin.index')

@section('content')

<div class="card card-secondary">

    <div class="card-header">
        <h3 class="card-title"><a href="{{route('clienteproceso.index')}}">{{'Cliente y proceso'}}</a></h3>
    </div>

    <div class="card-body">

        @include('admin.success')
        @include('admin.errors')

        <form action="{{ route('clienteproceso.store')}}" method="post" autocomplete="off">
            <div class="row mb-4">
                <div class="col-12">
                    @csrf

                    <div class="form-group">
                        <label for="personanatural_id">{{'Persona natural *'}}</label>
                        <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" id="personanatural_id"
                            name="personanatural_id">
                            <option selected>Seleccione ...</option>
                            @foreach ($Personasnaturales as $personanatural)
                            <option
                                data-tokens="{{$personanatural->numerodocumento}} {{$personanatural->nombrecompleto}}"
                                value="{{$personanatural->id}}"
                                data-subtext="{{$personanatural->nombrecompleto}}">
                                {{$personanatural->numerodocumento}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="proceso_id">{{'Proceso *'}}</label>
                        <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" id="proceso_id"
                            name="proceso_id">
                            <option selected>Seleccione ...</option>
                            @foreach ($Procesos as $proceso)
                            <option data-tokens="{{$proceso->numero}} {{$proceso->codigo}}" 
                                value="{{$proceso->id}}"
                                data-subtext="{{$proceso->numero}}">
                                {{$proceso->codigo}} 
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tipodemanda_id">{{'Tipo de demanda *'}}</label>
                        <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" id="tipodemanda_id"
                            name="tipodemanda_id">
                            <option selected>Seleccione ...</option>
                            @foreach ($Tiposdemandas as $tipodemanda)
                            <option data-tokens="{{$tipodemanda->abreviatura}} {{$tipodemanda->descripcion}}"
                                value="{{$tipodemanda->id}}"
                                data-subtext="{{$tipodemanda->descripcion}}">
                                {{$tipodemanda->abreviatura}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="box_id">{{'Box *'}}</label>
                        <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" id="box_id"
                            name="box_id">
                            <option selected>Seleccione ...</option>
                            @foreach ($Boxs as $box)
                            <option data-tokens="{{$box->abreviatura}} {{$box->descripcion}}"
                                value="{{$box->id}}"
                                data-subtext="{{$box->descripcion}}">
                                {{$box->abreviatura}}
                            </option>
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
                    <a href="{{route('clienteproceso.index')}}" class="btn btn-secondary" role="button"
                        aria-label="Buscar">
                        {{'Cancelar'}}
                    </a>
                    <button type="submit" class="btn btn-success float-right">
                        {{'Agregar'}}
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="card-footer clearfix">
    </div>
</div>
@endsection