@extends('admin.index')

@section('content')
<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title"><a href="{{route('corporacion.index')}}">{{'Corporación'}}</a></h3>
    </div>
    
    <div class="card-body">

        @include('admin.errors')

        <form action="{{ route('corporacion.store')}}" method="post" autocomplete="off">
            @csrf
            <div class="row mb-4">
                <div class="col-12">
                    <div class="form-group">
                        <label for="corporacion.nombre">{{'Nombre *'}}</label>
                        <input type="text" class="form-control" id="corporacion.nombre" name="nombre">
                    </div>
                    <div class="form-group">
                        <label for="corporacion.correonotificacion">{{'Correo de notificación'}}</label>
                        <input type="text" class="form-control" id="corporacion.correonotificacion" name="correonotificacion">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="users_id">users_id</label>
                        <input id="users_id" class="form-control" type="hidden" name="users_id" value="{{ Auth::id()}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">

                    <a href="{{route('corporacion.index')}}" class="btn btn-secondary" role="button" aria-label="Buscar">
                        {{'Cancelar'}}
                    </a>
                    <button type="submit" class="btn btn-success float-right">
                        {{'Agregar'}}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection