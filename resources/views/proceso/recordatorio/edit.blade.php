@extends('admin.index')

@section('content')
<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title"><a href="{{route('proceso.recordatorio.index', $proceso_id)}}">{{'Recordatorio'}}</a></h3>
    </div>

    <div class="card-body">
        @include('admin.errors')

        <form action="{{route('proceso.recordatorio.update', 
        ['proceso' => $proceso_id, 'recordatorio' => $id])}}" method="post" autocomplete="off">
            @csrf
            @method('PUT')
            <div class="row mb-4">
                <div class="col-12">    
                    <div class="form-group">
                        <label for="proceso.recordatorio.fecha"
                            class="col-2 col-form-label">{{'Fecha *'}}</label>
                        <input class="form-control" type="date" id="proceso.recordatorio.fecha" name="fecha"
                        value="{{$recordatorioproceso->fecha}}" min="{{ \Carbon\Carbon::now()->toDateString() }}">
                    </div>
                    <div class="form-group">
                        <label for="proceso.recordatorio.observacion">{{'Observación *'}}</label>
                        <input type="text" class="form-control" id="proceso.recordatorio.observacion" name="observacion"
                        value="{{$recordatorioproceso->observacion}}">
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
                    <a href="{{route('proceso.recordatorio.index', $proceso_id)}}" class="btn btn-secondary" role="button" aria-label="Cancelar">
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