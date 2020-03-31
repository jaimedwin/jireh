@extends('admin.index')

@section('content')
<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title"><a href="{{route('contrato.index')}}">{{'Contrato'}}</a></h3>
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

        <form action="{{route('contrato.update', $contrato->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row mb-4">
                <div class="col-12">
                    <div class="form-group">
                        <label for="contrato.numero">{{'Número del contrato'}}</label>
                        <input type="text" class="form-control" id="contrato.numero" name="numero"
                        value="{{$contrato->numero}}">
                    </div>

                    <div class="form-group">
                        <label for="contrato.valor">{{'Valor'}}</label>
                        <input type="text" class="form-control" id="contrato.valor" name="valor"
                        value="{{$contrato->valor}}">
                    </div>
                    
                    <div class="form-group">
                        <label for="contrato_id">{{'Tipo de contrato'}}</label>
                        <select class="form-control selectpicker" data-live-search="true" id="contrato_id"
                            name="tipocontrato_id">
                            @foreach ($Tipocontratos as $tipocontrato)
                                @if ($tipocontrato->id == $contrato->tipocontrato_id)
                                    <option data-tokens="{{$tipocontrato->descripcion}}" value="{{$tipocontrato->id}}" selected>
                                        {{$tipocontrato->descripcion}}
                                    </option>    
                                @else
                                    <option data-tokens="{{$tipocontrato->descripcion}}" value="{{$tipocontrato->id}}">
                                        {{$tipocontrato->descripcion}}
                                    </option>
                                @endif
                                    
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="personanatural_id">{{'Persona natural'}}</label>
                        <select class="form-control selectpicker" data-live-search="true" id="personanatural_id"
                            name="personanatural_id">
                            <option selected>Seleccione ...</option>
                            @foreach ($Personasnaturales as $personanatural)
                                @if ($personanatural->id == $contrato->personanatural_id)
                                <option
                                    data-tokens="{{$personanatural->nombres}} {{$personanatural->apellidopaterno}} {{$personanatural->apellidomaterno}}"
                                    value="{{$personanatural->id}}" selected>
                                    {{$personanatural->nombres}} {{$personanatural->apellidopaterno}}
                                    {{$personanatural->apellidomaterno}}
                                </option>
                                @else
                                <option
                                    data-tokens="{{$personanatural->nombres}} {{$personanatural->apellidopaterno}} {{$personanatural->apellidomaterno}}"
                                    value="{{$personanatural->id}}">
                                    {{$personanatural->nombres}} {{$personanatural->apellidopaterno}}
                                    {{$personanatural->apellidomaterno}}
                                </option>
                                @endif
                            
                            @endforeach
                        </select>
                    </div>
                    {{-- @if ($contrato->nombrearchivo)
                        <div class="form-group">
                            <label for="contrato.nombrearchivo">{{'Hay un archivo cargado previamente, ¿desea remplazarlo?'}}</label>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-primary active" onclick="show({{'1'}})">
                                    <input type="radio" name="options" id="option1" autocomplete="off" value="1" checked> 
                                    {{'Sí'}}
                                </label>
                                <label class="btn btn-primary" onclick="show({{'0'}})">
                                    <input type="radio" name="options" id="option0" autocomplete="off" value="2"> 
                                    {{'No'}}
                                </label>
                            </div>
                        </div>
                    @endif --}}

                    <div class="form-group">
                        <label for="contrato.nombrearchivo">{{'Seleccione documento'}}</label>
                        <input class="btn btn-primary" type="file" id="contrato.nombrearchivo" name="nombrearchivo"
                            aria-describedby="nombrearchivo"
                            accept=".pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="users_id">users_id</label>
                        <input id="users_id" class="form-control" type="hidden" name="users_id" value="{{ Auth::id()}}">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="nombrearchivo_anterior">nombrearchivo_anterior</label>
                        <input id="nombrearchivo_anterior" class="form-control" type="hidden" name="nombrearchivo_anterior" 
                        value="{{$contrato->nombrearchivo}}">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="personanatural_anterior">personanatural_anterior</label>
                        <input id="personanatural_anterior" class="form-control" type="hidden" name="personanatural_anterior" 
                        value="{{$contrato->personanatural_id}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="{{route('contrato.index')}}" class="btn btn-secondary" role="button" aria-label="Cancelar">
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
