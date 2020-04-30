@extends('admin.index')

@section('content')
<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title"><a href="{{route('fuerza.carrera.index', $fuerza_id)}}">{{'Carrera'}}</a></h3>
    </div>


    <div class="card-body">
        @include('admin.errors')

        <form action="{{route('fuerza.carrera.update', ['fuerza' => $fuerza_id, 'carrera' => $carrera->id])}}" method="post" autocomplete="off">
            @csrf
            @method('PUT')
            <div class="row mb-4">
                <div class="col-12">
                    <div class="form-group">
                        <label for="fuerza.carrera.abreviatura">{{'Abreviatura *'}}</label>
                        <input type="text" class="form-control" id="fuerza.carrera.abreviatura" name="abreviatura"
                            value="{{$carrera->abreviatura}}">
                    </div>
                    <div class="form-group">
                        <label for="fuerza.carrera.descripcion">{{'Descripción *'}}</label>
                        <input type="text" class="form-control" id="fuerza.carrera.descripcion" name="descripcion"
                            value="{{$carrera->descripcion}}">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="users_id">users_id</label>
                        <input id="users_id" class="form-control" type="hidden" name="users_id" value="{{ Auth::id()}}">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="fuerza_id">fuerza_id</label>
                        <input id="fuerza_id" class="form-control" type="hidden" name="fuerza_id"
                            value="{{$fuerza_id}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="{{route('fuerza.carrera.index', $fuerza_id)}}" class="btn btn-secondary" role="button" aria-label="Cancelar">
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