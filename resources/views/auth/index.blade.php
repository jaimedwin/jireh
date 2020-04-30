@extends('admin.index')

@section('content')

<div class="card card-secondary">

	<div class="card-header">
		<h3 class="card-title"><a href="{{route('user.index')}}">{{'Administrador de usuarios'}}</a></h3>
	</div>

	<div class="card-body">
		<div class="row  mb-4">
			<div class="col-12">
				<a href="{{route('register')}}" class="btn btn-primary" role="button" aria-label="Buscar">
					<i class="fas fa-plus-square"></i>
					{{'Crear nuevo user'}}
				</a>
			</div>
		</div>

		@include('admin.success')
		@include('admin.errors')

		<div class="row">
			<div class="col-12 table-responsive">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th style="width: 10px">{{'#'}}</th>
							<th>{{'Nombre'}}</th>
							<th>{{'Email'}}</th>
							<th>{{'Roles'}}</th>
							<th style="width: 160px" class="text-center">{{'Acciones'}}</th>
						</tr>
					</thead>
					<tbody>

						@foreach ($usuarios as $user)
						<tr>

							<td>{{$loop->iteration}}</td>
							<td>{{$user->name}}</td>
							<td>{{$user->email}}</td>
							<td>{{implode(', ', $user->roles()->get()->pluck('name')->toArray())}}</td>
							<td class="text-center">
								@if(!(Auth::id()==$user->id))
								<div class="btn-group" role="group" aria-label="Acciones">
									<a href="{{route('user.edit', $user->id)}}" class="btn btn-warning"
										aria-label="Editar">
										<i class="fas fa-pen" aria-hidden="true"></i>
									</a>
								</div>
								@endif
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="card-footer clearfix">
		<div class="float-right"></div>
	</div>
</div>
@endsection