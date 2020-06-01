@extends('admin.index')

@section('content')
<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title"><a href="{{route('contrato.index')}}">{{'Contrato'}}</a></h3>
    </div>


    <div class="card-body">
        @include('admin.errors')

        <form action="{{route('contrato.update', $contrato->id)}}" method="post" enctype="multipart/form-data"
            autocomplete="off" onsubmit="return check_size(209715200)">
            @csrf
            @method('PUT')
            <div class="row mb-4">
                <div class="col-12">
                    <div class="form-group">
                        <label for="contrato.numero">{{'Número del contrato /'}}</label>
                        <input type="text" class="form-control" id="contrato.numero" name="numero"
                            value="{{$contrato->numero}}">
                    </div>

                    <div class="form-group">
                        <label for="contrato.valor">{{'Valor *'}}</label>
                        <input type="text" class="form-control" id="contrato.valor" name="valor"
                            value="{{$contrato->valor}}">
                    </div>

                    <div class="form-group">
                        <label for="contrato_id">{{'Tipo de contrato *'}}</label>
                        <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true"
                            id="contrato_id" name="tipocontrato_id">
                            @foreach ($Tipocontratos as $tipocontrato)
                            <option data-tokens="{{$tipocontrato->descripcion}}" 
                                value="{{$tipocontrato->id}}" 
                                @if ($tipocontrato->id == $contrato->tipocontrato_id)
                                selected
                                @endif>
                                {{$tipocontrato->descripcion}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="personanatural_id">{{'Persona natural *'}}</label>
                        <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true"
                            id="personanatural_id" name="personanatural_id">
                            @foreach ($Personasnaturales as $personanatural)
                            <option
                                data-tokens="{{$personanatural->numerodocumento}} {{$personanatural->nombrecompleto}}"
                                value="{{$personanatural->id}}" 
                                data-subtext="{{$personanatural->nombrecompleto}}"
                                @if ($personanatural->id == $contrato->personanatural_id)
                                selected
                                @endif>
                                {{$personanatural->numerodocumento}}                                    
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="proceso_id">{{'Proceso *'}}</label>
                        <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true"
                            id="proceso_id" name="proceso_id">
                            @foreach ($Procesos as $proceso)
                            <option data-tokens="{{$proceso->codigo}} {{$proceso->numero}}" 
                                value="{{$proceso->id}}" 
                                data-subtext="{{$proceso->numero}}"
                                @if ($proceso->id == $contrato->proceso_id)
                                selected
                                @endif
                                >
                                {{$proceso->codigo}}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label
                            for="contrato.nombrearchivo">{{'El archivo cargado previamente será borrado. Seleccione documento *'}}</label><br>
                        <input class="btn btn-primary" type="file" id="upload" name="nombrearchivo"
                            aria-describedby="nombrearchivo"
                            accept=".pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="users_id">users_id</label>
                        <input id="users_id" class="form-control" type="hidden" name="users_id" value="{{ Auth::id()}}">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="nombrearchivo_anterior">nombrearchivo_anterior</label>
                        <input id="nombrearchivo_anterior" class="form-control" type="hidden"
                            name="nombrearchivo_anterior" value="{{$contrato->nombrearchivo}}">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="personanatural_anterior">personanatural_anterior</label>
                        <input id="personanatural_anterior" class="form-control" type="hidden"
                            name="personanatural_anterior" value="{{$contrato->personanatural_id}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="{{route('contrato.index')}}" class="btn btn-secondary" role="button" aria-label="Cancelar">
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