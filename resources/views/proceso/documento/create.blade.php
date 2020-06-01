@extends('admin.index')

@section('content')

<div class="card card-secondary">

    <div class="card-header">
        <h3 class="card-title"><a href="{{route('proceso.documento.index', $proceso_id)}}">{{'Documento'}}</a></h3>
    </div>


    <div class="card-body">

        @include('admin.success')
		@include('admin.errors')

        <form action="{{ route('proceso.documento.store', $proceso_id)}}" 
            method="post" enctype="multipart/form-data" autocomplete="off"
            onsubmit="return check_size(209715200)">
            <div class="row mb-4">
                <div class="col-12">
                    @csrf
                    <div class="form-group">
                        <label for="tipodocumento_id">{{'Tipo de documento *'}}</label>
                        <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" id="tipodocumento_id"
                            name="tipodocumento_id">
                            <option selected>Seleccione ...</option>
                            @foreach ($Tipodocumentos as $tipodocumento)
                            <option data-tokens="{{$tipodocumento->descripcion}} {{$tipodocumento->abreviatura}} " value="{{$tipodocumento->id}}"
                                data-subtext="{{$tipodocumento->descripcion}}">
                                {{$tipodocumento->abreviatura}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="documento.nombrearchivo">{{'Seleccione documento *'}}</label>
                        <input class="btn btn-primary" type="file" id="upload" name="nombrearchivo"
                            aria-describedby="nombrearchivo"
                            accept=".pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="proceso_id">proceso_id</label>
                        <input id="proceso_id" class="form-control" type="hidden" name="proceso_id"
                            value="{{$proceso_id}}">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="users_id">users_id</label>
                        <input id="users_id" class="form-control" type="hidden" name="users_id" value="{{ Auth::id()}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="{{route('proceso.documento.index', $proceso_id)}}" class="btn btn-secondary" role="button" aria-label="Cancelar">
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