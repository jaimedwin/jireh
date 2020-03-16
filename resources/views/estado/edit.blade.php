@extends('admin.index')

@section('content')
<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title"><a href="{{route('estado.index')}}">{{'Estado'}}</a></h3>
    </div>


    <div class="card-body">

        @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{route('estado.update', $estado->id)}}" method="post">
            @csrf
            @method('PUT')
            <div class="row mb-4">
                <div class="col-12">
                    <div class="form-group">
                        <label for="formGroupExampleInput">{{'Descripción'}}</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" name="descripcion"
                            value="{{$estado->descripcion}}">
                        <input type="hidden" name="users_id" value="{{ Auth::id()}}">
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-12">

                    <a href="{{route('estado.index')}}" class="btn btn-secondary" role="button" aria-label="Cancelar">
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