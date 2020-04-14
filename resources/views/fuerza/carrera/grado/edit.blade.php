@extends('admin.index')

@section('content')
<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title"><a href="{{route('fuerza.carrera.grado.index', [$fuerza_id, $carrera_id])}}">{{'Grado'}}</a></h3>
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

        <form action="{{route('fuerza.carrera.grado.update', ['fuerza' => $fuerza_id, 'carrera' => $carrera_id, 'grado' => $grado->id])}}" method="post">
            @csrf
            @method('PUT')
            <div class="row mb-4">
                <div class="col-12">
                    <div class="form-group">
                        <label for="fuerza.carrera.grado.abreviatura">{{'Abreviatura *'}}</label>
                        <input type="text" class="form-control" id="fuerza.carrera.grado.abreviatura" name="abreviatura"
                            value="{{$grado->abreviatura}}">
                    </div>
                    <div class="form-group">
                        <label for="fuerza.carrera.grado.descripcion">{{'Descripción *'}}</label>
                        <input type="text" class="form-control" id="fuerza.carrera.grado.descripcion" name="descripcion"
                            value="{{$grado->descripcion}}">
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
                    <div class="form-group">
                        <label class="sr-only" for="carrera_id">carrera_id</label>
                        <input id="carrera_id" class="form-control" type="hidden" name="carrera_id"
                            value="{{$carrera_id}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="{{route('fuerza.carrera.grado.index', [$fuerza_id, $carrera_id])}}" class="btn btn-secondary" role="button" aria-label="Cancelar">
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