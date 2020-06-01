@extends('admin.index')

@section('content')

<div class="card card-secondary">

    <div class="card-header">
        <h3 class="card-title"><a href="{{route('contrato.index')}}">{{'Contrato'}}</a></h3>
    </div>

    <div class="card-body">

        @include('admin.success')
        @include('admin.errors')

        <form action="{{ route('contrato.store')}}" method="post" 
            enctype="multipart/form-data" autocomplete="off"
            onsubmit="return check_size(209715200)">
            <div class="row mb-4">
                <div class="col-12">

                    @csrf
                    <div class="form-group">
                        <label for="contrato.numero">{{'Número del contrato *'}}</label>
                        <input type="text" class="form-control" id="contrato.numero" name="numero">
                    </div>

                    <div class="form-group">
                        <label for="contrato.valor">{{'Valor *'}}</label>
                        <input type="text" class="form-control" id="contrato.valor" name="valor">
                    </div>


                    <div class="form-group">
                        <label for="tipocontrato_id">{{'Tipo de contrato *'}}</label>
                        <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" id="tipocontrato_id"
                            name="tipocontrato_id">
                            <option selected>Seleccione ...</option>
                            @foreach ($Tipocontratos as $tipocontrato)
                            <option data-tokens="{{$tipocontrato->descripcion}}" value="{{$tipocontrato->id}}">
                                {{$tipocontrato->descripcion}}
                            </option>
                            @endforeach
                        </select>
                    </div>
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
                            <option data-tokens="{{$proceso->codigo}} {{$proceso->numero}}" 
                                value="{{$proceso->id}}"
                                data-subtext="{{$proceso->numero}}">
                                {{$proceso->codigo}}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="contrato.nombrearchivo">{{'Seleccione documento *'}}</label>
                        <input class="btn btn-primary" type="file" id="upload" name="nombrearchivo"
                            aria-describedby="nombrearchivo"
                            accept=".pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="users_id">users_id</label>
                        <input id="users_id" class="form-control" type="hidden" name="users_id" value="{{ Auth::id()}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="{{route('contrato.index')}}" class="btn btn-secondary" role="button" aria-label="Buscar">
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