@extends('admin.index')

@section('content')
<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title"><a href="{{route('personanatural.telefono.index', $personanatural_id)}}">{{'Telefono'}}</a></h3>
    </div>


    <div class="card-body">
        @include('admin.errors')

        <form action="{{route('personanatural.telefono.update', ['personanatural' => $personanatural_id, 'telefono' => $telefono->id])}}" method="post" autocomplete="off" >
            @csrf
            @method('PUT')
            <div class="row mb-4">
                <div class="col-12">
                    <div class="form-group">
                        <label for="personanatural.telefono.prefijo">{{'Prefijo *'}}</label>
                        <input type="text" class="form-control" id="personanatural.telefono.prefijo" name="prefijo"
                        value="{{$telefono->prefijo}}">
                    </div>
                    <div class="form-group">
                        <label for="personanatural.telefono.numero">{{'Número *'}}</label>
                        <input type="text" class="form-control" id="personanatural.telefono.numero" name="numero"
                        value="{{$telefono->numero}}">
                    </div>
                    <div class="form-group">
                        <label
                            for="proceso.actuacion.nombrearchivo">{{'¿Telefono principal? *'}}</label>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            @if ($telefono->principal == 0)
                                <label class="btn btn-primary">
                                    <input type="radio" name="principal" id="option1" value="1">
                                    {{'Sí'}}
                                </label>
                                <label class="btn btn-primary active">
                                    <input type="radio" name="principal" id="option0" value="0"
                                    checked>
                                    {{'No'}}
                                </label>
                            @else
                                <label class="btn btn-primary active">
                                    <input type="radio" name="principal" id="option1" value="1"
                                        checked>
                                    {{'Sí'}}
                                </label>
                                <label class="btn btn-primary">
                                    <input type="radio" name="principal" id="option0" value="0">
                                    {{'No'}}
                                </label>
                            @endif
                            
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="sr-only" for="users_id">users_id</label>
                        <input id="users_id" class="form-control" type="hidden" name="users_id" value="{{ Auth::id()}}">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="personanatural_id">personanatural_id</label>
                        <input id="personanatural_id" class="form-control" type="hidden" name="personanatural_id"
                            value="{{$personanatural_id}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="{{route('personanatural.telefono.index', $personanatural_id)}}" class="btn btn-secondary" role="button" aria-label="Cancelar">
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