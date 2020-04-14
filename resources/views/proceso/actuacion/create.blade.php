@extends('admin.index')

@section('content')
<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title"><a href="{{route('proceso.actuacion.index', $proceso_id)}}">{{'Actuación ponente'}}</a>
        </h3>
    </div>

    <div class="card-body">

        @if ($errors->any())
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-danger alert-dismissible" role="alert">
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
            </div>
        </div>
        @endif

        <form action="{{ route('proceso.actuacion.store', $proceso_id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row mb-4">
                <div class="col-12">

                    <div class="form-group">
                        <label for="proceso.actuacion.fechaactuacion"
                            class="col-2 col-form-label">{{'Fecha de actuacion *'}}</label>
                        <input class="form-control" type="date" id="proceso.actuacion.fechaactuacion"
                            name="fechaactuacion" max="{{ \Carbon\Carbon::now()->toDateString() }}">
                    </div>
                    <div class="form-group">
                        <label for="proceso.actuacion.actuacion">{{'Actuacion *'}}</label>
                        <input type="text" class="form-control" id="proceso.actuacion.actuacion" name="actuacion">
                    </div>
                    <div class="form-group">
                        <label for="proceso.actuacion.anotacion">{{'Anotacion'}}</label>
                        <input type="text" class="form-control" id="proceso.actuacion.anotacion" name="anotacion">
                    </div>
                    <div class="form-group">
                        <label for="proceso.actuacion.fechainiciatermino">{{'Fecha inicia termino'}}</label>
                        <input class="form-control" type="date" id="proceso.actuacion.fechainiciatermino"
                            name="fechainiciatermino">
                    </div>
                    <div class="form-group">
                        <label for="proceso.actuacion.fechafinalizatermino">{{'Fecha finaliza termino'}}</label>
                        <input class="form-control" type="date" id="proceso.actuacion.fechafinalizatermino"
                            name="fechafinalizatermino">
                    </div>
                    <div class="form-group">
                        <label for="proceso.actuacion.fecharegistro">{{'Fecha registro *'}}</label>
                        <input class="form-control" type="date" id="proceso.actuacion.fecharegistro"
                            name="fecharegistro">
                    </div>
                    
                    <div class="form-group">
                        <label for="proceso.actuacion.nombrearchivo">{{'Seleccione documento'}}</label>
                        <input class="btn btn-primary" type="file" id="proceso.actuacion.nombrearchivo" 
                        name="nombrearchivo" aria-describedby="nombrearchivo"
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
                </div>
            </div>
            <div class="row">
                <div class="col-12">

                    <a href="{{route('proceso.actuacion.index', $proceso_id)}}" class="btn btn-secondary" role="button"
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
</div>
@endsection
