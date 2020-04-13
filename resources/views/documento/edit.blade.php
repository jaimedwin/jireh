@extends('admin.index')

@section('content')
<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title"><a href="{{route('documento.index')}}">{{'Documento'}}</a></h3>
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

        <form action="{{route('documento.update', $documento->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row mb-4">
                <div class="col-12">
                    <div class="form-group">
                        <label for="tipodocumento_id">{{'Tipo de documento'}}</label>
                        <select class="form-control selectpicker" data-live-search="true" id="tipodocumento_id"
                            name="tipodocumento_id">
                            @foreach ($Tipodocumentos as $tipodocumento)
                                @if ($tipodocumento->id == $documento->tipodocumento_id)
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
                        <label for="personanatural_id">{{'Persona natural'}}</label>
                        <select class="form-control selectpicker" data-live-search="true" id="personanatural_id"
                            name="personanatural_id">
                            <option selected>Seleccione ...</option>
                            @foreach ($Personasnaturales as $personanatural)
                                @if ($personanatural->id == $documento->personanatural_id)
                                <option
                                    data-tokens="{{$personanatural->numerodocumento}} - {{$personanatural->nombrecompleto}}"
                                    value="{{$personanatural->id}}" selected>
                                    {{$personanatural->numerodocumento}} - {{$personanatural->nombrecompleto}}
                                </option>
                                @else
                                <option
                                    data-tokens="{{$personanatural->numerodocumento}} - {{$personanatural->nombrecompleto}}"
                                    value="{{$personanatural->id}}">
                                    {{$personanatural->numerodocumento}} - {{$personanatural->nombrecompleto}}
                                </option>
                                @endif
                            
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="contrato.nombrearchivo">{{'El archivo cargado previamente será borrado. Seleccione documento'}}</label><br>
                        <input class="btn btn-primary" type="file" id="documento.nombrearchivo" name="nombrearchivo"
                            aria-describedby="nombrearchivo"
                            accept=".pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="users_id">users_id</label>
                        <input id="users_id" class="form-control" type="hidden" name="users_id" value="{{ Auth::id()}}">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="nombrearchivo_anterior">nombrearchivo_anterior</label>
                        <input id="nombrearchivo_anterior" class="form-control" type="hidden" name="nombrearchivo_anterior" 
                        value="{{$documento->nombrearchivo}}">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="personanatural_anterior">personanatural_anterior</label>
                        <input id="personanatural_anterior" class="form-control" type="hidden" name="personanatural_anterior" 
                        value="{{$documento->personanatural_id}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="{{route('documento.index')}}" class="btn btn-secondary" role="button" aria-label="Cancelar">
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
