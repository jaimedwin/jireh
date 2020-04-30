@extends('admin.index')

@section('content')
<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title"><a href="{{route('proceso.actuacion.index', $proceso_id)}}">{{'Actuación'}}</a></h3>
    </div>

    <div class="card-body">
        @include('admin.errors')

        <form action="{{route('proceso.actuacion.update', 
        ['proceso' => $proceso_id, 'actuacion' => $id])}}" method="post" enctype="multipart/form-data" autocomplete="off" >
            @csrf
            @method('PUT')
            <div class="row mb-4">
                <div class="col-12">

                    
                    <div class="form-group">
                        <label for="proceso.actuacion.fechaactuacion"
                            class="col-2 col-form-label">{{'Fecha de actuacion *'}}</label>
                        <input class="form-control" type="date" id="proceso.actuacion.fechaactuacion"
                            name="fechaactuacion" value="{{$actuacionproceso->fechaactuacion}}"
                            max="{{ \Carbon\Carbon::now()->toDateString() }}">
                    </div>
                    <div class="form-group">
                        <label for="proceso.actuacion.actuacion">{{'Actuacion *'}}</label>
                        <input type="text" class="form-control" id="proceso.actuacion.actuacion" name="actuacion"
                            value="{{$actuacionproceso->actuacion}}">
                    </div>
                    <div class="form-group">
                        <label for="proceso.actuacion.anotacion">{{'Anotacion'}}</label>
                        <input type="text" class="form-control" id="proceso.actuacion.anotacion" name="anotacion"
                            value="{{$actuacionproceso->anotacion}}">
                    </div>
                    <div class="form-group">
                        <label for="proceso.actuacion.fechainiciatermino">{{'Fecha inicia termino'}}</label>
                        <input class="form-control" type="date" id="proceso.actuacion.fechainiciatermino"
                            name="fechainiciatermino" value="{{$actuacionproceso->fechainiciatermino}}">
                    </div>
                    <div class="form-group">
                        <label for="proceso.actuacion.fechafinalizatermino">{{'Fecha finaliza termino'}}</label>
                        <input class="form-control" type="date" id="proceso.actuacion.fechafinalizatermino"
                            name="fechafinalizatermino" value="{{$actuacionproceso->fechafinalizatermino}}">
                    </div>
                    <div class="form-group">
                        <label for="proceso.actuacion.fecharegistro">{{'Fecha registro *'}}</label>
                        <input class="form-control" type="date" id="proceso.actuacion.fecharegistro"
                            name="fecharegistro" value="{{$actuacionproceso->fecharegistro}}">
                    </div>

                    @if ($actuacionproceso->nombrearchivo)
                        <div class="form-group">
                            <label for="proceso.actuacion.nombrearchivo">{{'Hay un archivo cargado previamente, ¿desea remplazarlo?'}}</label>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-primary active" onclick="show({{'1'}})">
                                    <input type="radio" name="options" id="option1" value="1" checked> 
                                    {{'Sí'}}
                                </label>
                                <label class="btn btn-primary" onclick="show({{'0'}})">
                                    <input type="radio" name="options" id="option0" value="2"> 
                                    {{'No'}}
                                </label>
                            </div>
                        </div>
                    @endif

                    <div id="{{'1'}}" class="topic">
                        <div class="form-group">
                            <label for="proceso.actuacion.nombrearchivo">{{'Seleccione documento'}}</label>
                            <input class="btn btn-primary" type="file" id="proceso.actuacion.nombrearchivo" 
                            name="nombrearchivo" aria-describedby="nombrearchivo"
                            accept=".pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                        </div>
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
                    <a href="{{route('proceso.actuacion.index', $proceso_id)}}" class="btn btn-secondary" role="button" aria-label="Cancelar">
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

{{-- <script type="text/javascript">
function show(id) {
    //$('.topic').addClass('hidden');
    //$('#' + id).removeClass('hidden');
    $('.topic').addClass('d-none');
    $('#' + id).removeClass('d-none');

}

$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script> --}}