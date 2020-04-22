@extends('admin.index')

@section('content')
<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title"><a href="{{route('proceso.index')}}">{{'Proceso'}}</a></h3>
    </div>

    <div class="card-body">

        @include('admin.errors')
            
        <form action="{{ route('proceso.store')}}" method="post" autocomplete="off">
            @csrf
            <div class="row mb-4">

                <div class="col-12">
                    <div class="form-group">
                        <label for="proceso.codigo">{{'Código *'}}</label>
                        <input type="text" class="form-control" id="proceso.codigo" name="codigo" >
                    </div>
                    <div class="form-group">
                        <label for="proceso.numero">{{'Número del proceso *'}}</label>
                        <input type="text" class="form-control" id="forma_numero_input" name="numero">
                    </div>


                    <div class="form-group">
                        <label for="proceso.ciudadproceso">{{'Ciudad de proceso *'}}</label>
                        <select class="form-control selectpicker" data-live-search="true" id="proceso.ciudadproceso" name="ciudadproceso_id">
                            <option selected>Seleccione ...</option>
                            @foreach ($ciudadprocesos as $ciudadproceso)
                                <option data-tokens="{{$ciudadproceso->nombre}}" value="{{$ciudadproceso->id}}">
                                    {{$ciudadproceso->nombre}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="proceso.coporacion">{{'Corporación *'}}</label>
                        <select class="form-control selectpicker" data-live-search="true" id="proceso.coporacion" name="corporacion_id">
                            <option selected>Seleccione ...</option>
                            @foreach ($corporacions as $corporacion)
                                <option data-tokens="{{$corporacion->nombre}}" value="{{$corporacion->id}}">
                                    {{$corporacion->nombre}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="proceso.ponente">{{'Ponente *'}}</label>
                        <select class="form-control selectpicker" data-live-search="true" id="proceso.ponente" name="ponente_id">
                            <option selected>Seleccione ...</option>
                            @foreach ($ponentes as $ponente)
                                <option data-tokens="{{$ponente->nombrecompleto}}" value="{{$ponente->id}}">
                                    {{$ponente->nombrecompleto}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="proceso.estado">{{'Estado *'}}</label>
                        <select class="form-control selectpicker" data-live-search="true" id="proceso.estado" name="estado_id">
                            <option selected>Seleccione ...</option>
                            @foreach ($estados as $estado)
                                <option data-tokens="{{$estado->descripcion}}" value="{{$estado->id}}">
                                    {{$estado->descripcion}}
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
            <div class="row">
                <div class="col-12">

                    <a href="{{route('proceso.index')}}" class="btn btn-secondary" role="button" aria-label="Buscar">
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