@extends('admin.index')

@section('content')

<div class="card card-secondary">

	<div class="card-header">
		<h3 class="card-title"><a
				href="{{route('fuerza.carrera.grado.index', [$fuerza_id, $carrera_id])}}">{{'Grado'}}</a></h3>
		<div class="card-tools">
			<form action="{{route('fuerza.carrera.grado.index', [$fuerza_id, $carrera_id])}}" method="get" autocomplete="off">
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


	<form action="{{ route('fuerza.carrera.grado.store', [$fuerza_id, $carrera_id])}}" method="post">
		@csrf

		<div class="card-body">

			@include('admin.success')
			@include('admin.errors')

			<div class="row">
				<div class=" col-12 table-responsive">
					<div class="form-group">
						<label for="fuerza.carrera.grado.abreviatura">{{'Abreviatura *'}}</label>
						<input type="text" class="form-control" id="fuerza.carrera.grado.abreviatura"
							name="abreviatura">
					</div>
					<div class="form-group">
						<label for="fuerza.carrera.grado.descripcion">{{'Descripción *'}}</label>
						<input type="text" class="form-control" id="fuerza.carrera.grado.descripcion"
							name="descripcion">
					</div>
					<div class="form-group">
						<label class="sr-only" for="users_id">users_id</label>
						<input id="users_id" class="form-control" type="hidden" name="users_id" value="{{ Auth::id()}}">
					</div>
					<div class="form-group">
						<label class="sr-only" for="fuerza_id">fuerza_id</label>
						<input id="fuerza_id" class="form-control" type="hidden" name="fuerza_id"
							value="{{$fuerza_id}}">
					</div>
					<div class="form-group">
						<label class="sr-only" for="carrera_id">carrera_id</label>
						<input id="carrera_id" class="form-control" type="hidden" name="carrera_id"
							value="{{$carrera_id}}">
					</div>
				</div>
			</div>
		</div>

		<div class="card-footer clearfix">
			<a href="{{route('fuerza.carrera.grado.index', [$fuerza_id, $carrera_id])}}" class="btn btn-secondary"
				role="button" aria-label="Buscar">{{'Cancelar'}}</a>
			<button type="submit" class="btn btn-success float-right">{{'Agregar'}}</button>
		</div>
	</form>
</div>
@endsection