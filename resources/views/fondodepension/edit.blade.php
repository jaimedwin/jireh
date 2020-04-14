@extends('admin.index')

@section('content')
<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title"><a href="{{route('fondodepension.index')}}">{{'Fondo de pensión'}}</a></h3>
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

        <form action="{{route('fondodepension.update', $fondodepension->id)}}" method="post">
            @csrf
            @method('PUT')
            <div class="row mb-4">
                <div class="col-12">
                    <div class="form-group">
                        <label for="fondodepension.abreviatura">{{'Abreviatura *'}}</label>
                        <input type="text" class="form-control" id="fondodepension.abreviatura" name="abreviatura"
                            value="{{$fondodepension->abreviatura}}">
                    </div>
                    <div class="form-group">
                        <label for="fondodepension.descripcion">{{'Descripción'}}</label>
                        <input type="text" class="form-control" id="fondodepension.descripcion" name="descripcion"
                            value="{{$fondodepension->descripcion}}">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="users_id">users_id</label>
                        <input id="users_id" class="form-control" type="hidden" name="users_id" value="{{ Auth::id()}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="{{route('fondodepension.index')}}" class="btn btn-secondary" role="button" aria-label="Cancelar">
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