@extends('admin.index')

@section('content')
<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title"><a href="{{route('personajuridica.index')}}">{{'Persona juridica'}}</a></h3>
    </div>


    <div class="card-body">
        @include('admin.errors')

        <form action="{{route('personajuridica.update', $personajuridica->id)}}" method="post" autocomplete="off">
            @csrf
            @method('PUT')
            <div class="row mb-4">
                <div class="col-12">
                    <div class="form-group">
                        <label for="personajuridica.nit">{{'Nit *'}}</label>
                        <input type="text" class="form-control" id="personajuridica.nit" name="nit"
                        value="{{$personajuridica->nit}}">
                    </div>

                    <div class="form-group">
                        <label for="personajuridica.razonsocial">{{'Razón social *'}}</label>
                        <input type="text" class="form-control" id="personajuridica.razonsocial" name="razonsocial"
                        value="{{$personajuridica->razonsocial}}">
                    </div>

                    <div class="form-group">
                        <label for="personajuridica.direccion">{{'Dirección'}}</label>
                        <input type="text" class="form-control" id="personajuridica.direccion" name="direccion"
                        value="{{$personajuridica->direccion}}">
                    </div>
                    <div class="form-group">
                        <label for="personanatural_id">{{'Persona natural *'}}</label>
                        <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" id="personanatural_id"
                            name="personanatural_id">
                            @foreach ($Personasnaturales as $personanatural)
                                @if ($personanatural->id == $personajuridica->personanatural_id)
                                <option
                                    data-tokens="{{$personanatural->numerodocumento}} {{$personanatural->nombrecompleto}}"
                                    value="{{$personanatural->id}}" selected>
                                    {{$personanatural->numerodocumento}} - {{$personanatural->nombrecompleto}}
                                </option>
                                @else
                                <option
                                    data-tokens="{{$personanatural->numerodocumento}} {{$personanatural->nombrecompleto}}"
                                    value="{{$personanatural->id}}">
                                    {{$personanatural->numerodocumento}} - {{$personanatural->nombrecompleto}}
                                </option>
                                @endif
                            
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="users_id">users_id</label>
                        <input id="users_id" class="form-control" type="hidden" name="users_id" value="{{ Auth::id()}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="{{route('personajuridica.index')}}" class="btn btn-secondary" role="button" aria-label="Cancelar">
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
