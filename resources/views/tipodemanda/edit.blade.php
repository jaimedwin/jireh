@extends('admin.index')

@section('content')
<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title"><a href="{{route('tipodemanda.index')}}">{{'Tipo de demanda'}}</a></h3>
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

        <form action="{{route('tipodemanda.update', $tipodemanda->id)}}" method="post">
            @csrf
            @method('PUT')
            <div class="row mb-4">
                <div class="col-12">
                    <div class="form-group">
                        <label for="tipodemanda.abreviatura">{{'Abreviatura'}}</label>
                        <input type="text" class="form-control" id="tipodemanda.abreviatura" name="abreviatura"
                            value="{{$tipodemanda->abreviatura}}">
                    </div>
                    <div class="form-group">
                        <label for="tipodemanda.descripcion">{{'Descripción'}}</label>
                        <input type="text" class="form-control" id="tipodemanda.descripcion" name="descripcion"
                            value="{{$tipodemanda->descripcion}}">
                    </div>
                    <div class="form-group">
                        <label for="tipodemanda.comentario">{{'Comentario'}}</label>
                        <textarea class="form-control" rows="3" class="form-control" id="tipodemanda.comentario"
                            name="comentario" value="{{$tipodemanda->comentario}}">
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="users_id">users_id</label>
                        <input id="users_id" class="form-control" type="hidden" name="users_id" value="{{ Auth::id()}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="{{route('tipodemanda.index')}}" class="btn btn-secondary" role="button"
                        aria-label="Cancelar">
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