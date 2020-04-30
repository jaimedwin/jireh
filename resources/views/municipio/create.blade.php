@extends('admin.index')

@section('content')
<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title"><a href="{{route('municipio.index')}}">{{'Lugar de expedición'}}</a></h3>
    </div>
    
    <div class="card-body">

        @include('admin.errors')

        <form action="{{ route('municipio.store')}}" method="post" autocomplete="off">
            @csrf
            <div class="row mb-4">
                <div class="col-12">
                    <div class="form-group">
                        <label for="municipio.nombre">{{'Municipio *'}}</label>
                        <input type="text" class="form-control" id="municipio.nombre" name="nombre">
                    </div>
                    <div class="form-group">
                        <label for="departamento_id">{{'Departamento *'}}</label>
                        <select class="form-control selectpicker" data-live-search="true" id="departamento_id"
                            name="departamento_id">
                            <option selected>Seleccione ...</option>
                            @foreach ($Departamentos as $departamento)
                            <option data-tokens="{{$departamento->nombre}}" value="{{$departamento->id}}">
                                {{$departamento->nombre}}
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

                    <a href="{{route('municipio.index')}}" class="btn btn-secondary" role="button" aria-label="Buscar">
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