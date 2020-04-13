@extends('admin.index')

@section('content')
<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title"><a href="{{route('personanatural.index')}}">{{'Persona natural'}}</a></h3>
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

        <form action="{{route('personanatural.update', $personanatural->id)}}" method="post">
            @csrf
            @method('PUT')
            <div class="row mb-4">
                <div class="col-12">
                    <div class="row">
                        <div class="form-group col-lg">
                            <label for="personanatural.numero">{{'Codigo *'}}</label>
                            <input type="text" class="form-control" id="personanatural.numero" name="codigo"
                            value="{{$personanatural->codigo}}">
                        </div>
                        <div class="form-group col-lg">
                            <label for="personanatural.nombres">{{'Nombres *'}}</label>
                            <input type="text" class="form-control" id="personanatural.nombres" name="nombres"
                            value="{{$personanatural->nombres}}">
                        </div>
        
                        <div class="form-group col-lg">
                            <label for="personanatural.apellidopaterno">{{'Apellido paterno'}}</label>
                            <input type="text" class="form-control" id="personanatural.apellidopaterno" name="apellidopaterno"
                            value="{{$personanatural->apellidopaterno}}">
                        </div>
                        <div class="form-group col-lg">
                            <label for="personanatural.apellidomaterno">{{'Apellido materno'}}</label>
                            <input type="text" class="form-control" id="personanatural.apellidomaterno" name="apellidomaterno"
                            value="{{$personanatural->apellidomaterno}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <div class="form-group">
                                <label
                                    for="personanatural.tipodocumentoindentificacion">{{'Tipo de documento de indentificacion *'}}</label>
                                <select class="form-control selectpicker" id="personanatural.tipodocumentoindentificacion"
                                    data-live-search="true" name="tipodocumentoidentificacion_id">
                                    @foreach ($Tiposdocumentosidentificacion as $tdi)
                                        @if ($tdi->id == $personanatural->tipodocumentoidentificacion_id)
                                            <option data-tokens="{{$tdi->abreviatura}} {{$tdi->descripcion}}" value="{{$tdi->id}}"
                                                data-subtext="{{$tdi->descripcion}}" selected>
                                                {{$tdi->abreviatura}}
                                            </option>
                                        @else
                                            <option data-tokens="{{$tdi->abreviatura}} {{$tdi->descripcion}}" value="{{$tdi->id}}"
                                                data-subtext="{{$tdi->descripcion}}">
                                                {{$tdi->abreviatura}}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="form-group">
                                <label for="personanatural.numerodocumento">{{'Número de documento *'}}</label>
                                <input type="text" class="form-control" id="personanatural.numerodocumento"
                                    name="numerodocumento" value="{{$personanatural->numerodocumento}}">
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="form-group">
                                <label for="personanatural.expedicion">{{'Lugar de expedición *'}}</label>
                                <select class="form-control selectpicker" id="personanatural.expedicion" data-live-search="true"
                                    name="expedicion_id">
                                    @foreach ($Expediciones as $expe)
                                        @if ($expe->id == $personanatural->expedicion_id)
                                            <option data-tokens="{{$expe->lugar}}" value="{{$expe->id}}" selected>
                                                {{$expe->lugar}}
                                            </option>
                                        @else
                                            <option data-tokens="{{$expe->lugar}}" value="{{$expe->id}}">
                                                {{$expe->lugar}}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="form-group">
                                <label for="personanatural.fechaexpedicion">{{'Fecha de expedicion'}}</label>
                                <input class="form-control" type="date" id="personanatural.fechaexpedicion" name="fechaexpedicion"
                                value="{{$personanatural->fechaexpedicion}}" max="{{ \Carbon\Carbon::now()->toDateString() }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-4">
                            <label for="personanatural.fechanacimiento">{{'Fecha de nacimiento'}}</label>
                            <input class="form-control" type="date" id="personanatural.fechanacimiento" name="fechanacimiento"
                            value="{{$personanatural->fechanacimiento}}" max="{{ \Carbon\Carbon::now()->toDateString() }}">
                        </div>
                        <div class="form-group col-lg-8">
                            <label for="personanatural.direccion">{{'Dirección *'}}</label>
                            <input type="text" class="form-control" id="personanatural.direccion" name="direccion"
                            value="{{$personanatural->direccion}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg">
                            <label for="personanatural.fondodepension">{{'Fondo de pensiones *'}}</label>
                            <select class="form-control selectpicker" id="personanatural.fondodepension" data-live-search="true"
                                name="fondodepension_id">
                                @foreach ($Fondodepensiones as $fdp)
                                        @if ($fdp->id == $personanatural->fondodepension_id)
                                        <option data-tokens="{{$fdp->abreviatura}}" value="{{$fdp->id}}" data-subtext="{{$fdp->descripcion}}"
                                            selected>
                                            {{$fdp->abreviatura}}
                                        </option>
                                    @else
                                        <option data-tokens="{{$fdp->abreviatura}}" value="{{$fdp->id}}" data-subtext="{{$fdp->descripcion}}">
                                            {{$fdp->abreviatura}}
                                        </option>
                                    @endif

                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg">
                            <label for="personanatural.eps">{{'Eps *'}}</label>
                            <select class="form-control selectpicker" id="personanatural.eps" data-live-search="true"
                                name="eps_id">
                                @foreach ($Eps as $ep)
                                    @if ($ep->id == $personanatural->eps_id)
                                        <option data-tokens="{{$ep->abreviatura}}" value="{{$ep->id}}"
                                            selected>
                                            {{$ep->abreviatura}}
                                        </option>
                                    @else
                                        <option data-tokens="{{$ep->abreviatura}}" value="{{$ep->id}}">
                                            {{$ep->abreviatura}}
                                        </option>
                                    @endif

                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg">
                            <label for="personanatural.grado">{{'Grado *'}}</label>
                            <select class="form-control selectpicker" id="personanatural.grado" data-live-search="true"
                                name="grado_id">

                                @foreach ($Grados as $g)
                                    @if ($g->id == $personanatural->grado_id)
                                        <option data-tokens="{{$g->fuerza}} {{$g->abreviatura}} {{$g->descripcion}}" value="{{$g->id}}" 
                                            data-subtext="{{$g->descripcion}}" selected>
                                            {{$g->fuerza}} - {{$g->abreviatura}}
                                        </option>
                                    @else
                                        <option data-tokens="{{$g->fuerza}} {{$g->abreviatura}} {{$g->descripcion}}" value="{{$g->id}}" data-subtext="{{$g->descripcion}}">
                                            {{$g->fuerza}} - {{$g->abreviatura}}
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
                    <div class="form-group">
                        <label class="sr-only" for="users_id">users_id</label>
                        <input id="users_id" class="form-control" type="hidden" name="users_id" value="{{ Auth::id()}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="{{route('personanatural.index')}}" class="btn btn-secondary" role="button" aria-label="Cancelar">
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