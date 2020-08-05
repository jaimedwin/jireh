@extends('admin.index')

@section('content')
<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title"><a href="{{route('box.index')}}">{{'Boxs'}}</a></h3>
    </div>
    <div class="card-body">
        
        @include('admin.errors')

        <form action="{{ route('box.store')}}" method="post" autocomplete="off">
            @csrf
            <div class="row mb-4">
                <div class="col-12">
                    <div class="form-group">
                        <label for="box.abreviatura">{{'Abreviatura *'}}</label>
                        <input type="text" class="form-control" id="box.abreviatura" name="abreviatura">
                    </div>
                    <div class="form-group">
                        <label for="box.descripcion">{{'Descripción *'}}</label>
                        <input type="text" class="form-control" id="box.descripcion" name="descripcion">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="users_id">users_id</label>
                        <input id="users_id" class="form-control" type="hidden" name="users_id" value="{{ Auth::id()}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">

                    <a href="{{route('box.index')}}" class="btn btn-secondary" role="button" aria-label="Buscar">
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