@extends('admin.index')

@section('content')

<div class="card card-secondary">

    <div class="card-header">
        <h3 class="card-title"><a href="{{route('personajuridica.index')}}">{{'Persona juridica'}}</a></h3>
    </div>

    <form action="{{ route('personajuridica.store')}}" method="post" autocomplete="off">
        <div class="card-body">

            @include('admin.success')
		    @include('admin.errors')

            <div class="row mb-4">
                <div class="col-12">

                    @csrf
                    <div class="form-group">
                        <label for="personajuridica.nit">{{'Nit *'}}</label>
                        <input type="text" class="form-control" id="personasjuridica.nit" name="nit">
                    </div>

                    <div class="form-group">
                        <label for="personajuridica.razonsocial">{{'Razón social *'}}</label>
                        <input type="text" class="form-control" id="personasjuridica.razonsocial" name="razonsocial">
                    </div>
                    <div class="form-group">
                        <label for="personajuridica.direccion">{{'Dirección'}}</label>
                        <input type="text" class="form-control" id="personasjuridica.direccion" name="direccion">
                    </div>
                    <div class="form-group">
                        <label for="personanatural_id">{{'Persona natural *'}}</label>
                        <select class="form-control selectpicker" data-live-search="true" id="personanatural_id"
                            name="personanatural_id">
                            <option selected>Seleccione ...</option>
                            @foreach ($Personasnaturales as $personanatural)
                            <option
                                data-tokens="{{$personanatural->numerodocumento}} {{$personanatural->nombrecompleto}}"
                                value="{{$personanatural->id}}">
                                {{$personanatural->numerodocumento}} - {{$personanatural->nombrecompleto}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="users_id">users_id</label>
                        <input id="users_id" class="form-control" type="hidden" name="users_id" value="{{ Auth::id()}}">
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer clearfix">
            <a href="{{route('personajuridica.index')}}" class="btn btn-secondary" role="button" aria-label="Buscar">
                {{'Cancelar'}}
            </a>
            <button type="submit" class="btn btn-success float-right">
                {{'Agregar'}}
            </button>
        </div>

    </form>
</div>
@endsection