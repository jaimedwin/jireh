@extends('admin.index')

@section('content')
<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title"><a href="{{route('estado.index')}}">{{'Estado'}}</a></h3>
        <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="table_search" class="form-control float-right" placeholder="Buscar">

                <div class="input-group-append">
                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>
    </div>


    <div class="card-body">

        <form action="{{ route('estado.store')}}" method="post">
            @csrf
            <div class="row mb-4">
                <div class="col-12">



                    <div class="form-group">
                        <label for="formGroupExampleInput">{{'Descripción'}}</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" name="descripcion"
                            placeholder="{{'ej: Activo'}}">
                        <input type="hidden" name="users_id" id="users_id" value="{{ Auth::id()}}">
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-12">

                    <a href="{{route('estado.index')}}" class="btn btn-secondary" role="button" aria-label="Buscar">
                        {{'Cancelar'}}
                    </a>
                    <button type="submit" class="btn btn-success float-right">
                        {{'Agregar'}}
                    </button>


                </div>
            </div>
        </form>
    </div>


    @endsection