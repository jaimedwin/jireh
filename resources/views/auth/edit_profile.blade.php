@extends('admin.index')

@section('content')
<div class="card card-secondary">
    <div class="card-header">
		<h3 class="card-title">{{'Editar información de usuario'}}</h3>
	</div>


    <div class="card-body">
        @include('admin.errors')

        <form action="{{route('update_profile')}}" method="post">
            @csrf
            @method('PUT')
            <div class="row mb-4">
                <div class="col-12">

                    
                    <div class="form-group">
                        <label for="user.name">{{'Nombre *'}}</label>
                        <input type="text" class="form-control" id="user.name" name="name"
                            value="{{$user->name}}">
                    </div>
                    <div class="form-group">
                        <label for="user.email">{{'Email *'}}</label>
                        <input type="text" class="form-control" id="user.email" name="email"
                            value="{{$user->email}}">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="id">id</label>
                        <input id="id" class="form-control" type="hidden" name="id" value="{{$user->id}}">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="users_id">users_id</label>
                        <input id="users_id" class="form-control" type="hidden" name="users_id" value="{{ Auth::id()}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-success float-right">
                        {{'Actualizar'}}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection