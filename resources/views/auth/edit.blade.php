@extends('admin.index')

@section('content')
<div class="card card-secondary">
    <div class="card-header">
		<h3 class="card-title"><a href="{{route('user.index')}}">{{'Administrador de usuarios'}}</a></h3>
	</div>


    <div class="card-body">
        @include('admin.errors')

        <form action="{{route('user.update', $user->id)}}" method="post">
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

                    <div class="form-group clearfix">
                        <label for="roles">{{'Roles *'}}</label><br>
                        @foreach ($roles as $role)
                            <div class="icheck-primary d-inline">
                                <input type="checkbox" name="roles[]" id="user.roles.{{$role->id}}" value="{{ $role->id}}"
                                @if($user->roles->pluck('id')->contains($role->id)) checked @endif>
                                <label for="user.roles.{{$role->id}}">{{ $role->name}}</label>
                            </div>
                        @endforeach
                    </div>

                    <div class="form-group">
                        <label class="sr-only" for="users_id">users_id</label>
                        <input id="users_id" class="form-control" type="hidden" name="users_id" value="{{ Auth::id()}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="{{route('user.index')}}" class="btn btn-secondary" role="button" aria-label="Cancelar">
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