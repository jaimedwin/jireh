@extends('admin.index')

@section('content')
<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title"><a href="{{route('proceso.documento.index', $proceso_id)}}">{{'Documento'}}</a></h3>
    </div>

    <div class="card-body">
        @include('admin.errors')

        <form action="{{route('proceso.documento.update', ['proceso' => $proceso_id, 'documento' => $documentoproceso->id])}}" method="post" enctype="multipart/form-data" autocomplete="off">
            @csrf
            @method('PUT')
            <div class="row mb-4">
                <div class="col-12">
                    <div class="form-group">
                        <label for="tipodocumento_id">{{'Tipo de documento *'}}</label>
                        <select class="form-control selectpicker" data-live-search="true" id="tipodocumento_id"
                            name="tipodocumento_id">
                            @foreach ($Tipodocumentos as $tipodocumento)
                                @if ($tipodocumento->id == $documentoproceso->tipodocumento_id)
                                    <option data-tokens="{{$tipodocumento->abreviatura}} {{$tipodocumento->descripcion}}" value="{{$tipodocumento->id}}" selected>
                                        {{$tipodocumento->abreviatura}} - {{$tipodocumento->descripcion}}
                                    </option>    
                                @else
                                    <option data-tokens="{{$tipodocumento->abreviatura}} {{$tipodocumento->descripcion}}" value="{{$tipodocumento->id}}">
                                        {{$tipodocumento->abreviatura}} - {{$tipodocumento->descripcion}}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="contrato.nombrearchivo">{{'El archivo cargado previamente será borrado. Seleccione documento *'}}</label><br>
                        <input class="btn btn-primary" type="file" id="documento.nombrearchivo" name="nombrearchivo"
                            aria-describedby="nombrearchivo"
                            accept=".pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="users_id">users_id</label>
                        <input id="users_id" class="form-control" type="hidden" name="users_id" value="{{ Auth::id()}}">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="proceso_id">proceso_id</label>
                        <input id="proceso_id" class="form-control" type="hidden" name="proceso_id"
                            value="{{$proceso_id}}">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="nombrearchivo_anterior">nombrearchivo_anterior</label>
                        <input id="nombrearchivo_anterior" class="form-control" type="hidden" name="nombrearchivo_anterior" 
                        value="{{$documentoproceso->nombrearchivo}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="{{route('proceso.documento.index', $proceso_id)}}" class="btn btn-secondary" role="button" aria-label="Cancelar">
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
