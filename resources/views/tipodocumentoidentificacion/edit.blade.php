@extends('admin.index')

@section('content')
<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title"><a
                href="{{route('tipodocumentoidentificacion.index')}}">{{'Documento de identificación'}}</a></h3>
    </div>
    <div class="card-body">
        @include('admin.errors')

        <form action="{{route('tipodocumentoidentificacion.update', $tipodocumentoidentificacion->id)}}" method="post" autocomplete="off" >
            @csrf
            @method('PUT')
            <div class="row mb-4">
                <div class="col-12">
                    <div class="form-group">
                        <label for="tipodocumentoidentificacion.abreviatura">{{'Abreviatura *'}}</label>
                        <input type="text" class="form-control" id="tipodocumentoidentificacion.abreviatura"
                            name="abreviatura" value="{{$tipodocumentoidentificacion->abreviatura}}">
                    </div>
                    <div class="form-group">
                        <label for="tipodocumentoidentificacion.descripcion">{{'Descripción *'}}</label>
                        <input type="text" class="form-control" id="tipodocumentoidentificacion.descripcion"
                            name="descripcion" value="{{$tipodocumentoidentificacion->descripcion}}">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="users_id">users_id</label>
                        <input id="users_id" class="form-control" type="hidden" name="users_id" value="{{ Auth::id()}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="{{route('tipodocumentoidentificacion.index')}}" class="btn btn-secondary" role="button"
                        aria-label="Cancelar">
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