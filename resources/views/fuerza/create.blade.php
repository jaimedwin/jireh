@extends('admin.index')

@section('content')

<div class="card card-secondary">

	<div class="card-header">
		<h3 class="card-title"><a href="{{route('fuerza.index')}}">{{'Fuerza'}}</a></h3>
		<div class="card-tools">
			<form action="{{route('fuerza.index')}}" method="get">
				@csrf
				<div class="input-group input-group-sm" style="width: 150px;">
					<input type="text" name="buscar" class="form-control float-right" placeholder="Buscar">
					<div class="input-group-append">
						<button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
					</div>

				</div>
			</form>
		</div>
	</div>

	<form action="{{ route('fuerza.store')}}" method="post" autocomplete="off">
		@csrf

		<div class="card-body">

			@include('admin.success')
			@include('admin.errors')

			<div class="row mb-4">
				<div class=" col-12">
					<div class="row mb-4">
						<div class="col-12">
							<div class="form-group">
								<label for="fuerza.abreviatura">{{'Abreviatura *'}}</label>
								<input type="text" class="form-control" id="fuerza.abreviatura" name="abreviatura">
							</div>
							<div class="form-group">
								<label for="fuerza.descripcion">{{'Descripción *'}}</label>
								<input type="text" class="form-control" id="fuerza.descripcion" name="descripcion">
							</div>
							<div class="form-group">
								<label class="sr-only" for="users_id">users_id</label>
								<input id="users_id" class="form-control" type="hidden" name="users_id"
									value="{{ Auth::id()}}">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="card-footer clearfix">
			<a href="{{route('fuerza.index')}}" class="btn btn-secondary" role="button" aria-label="Cancelar">
				{{'Cancelar'}}
			</a>
			<button type="submit" class="btn btn-success float-right">
				{{'Agregar'}}
			</button>
		</div>
	</form>

</div>
@endsection