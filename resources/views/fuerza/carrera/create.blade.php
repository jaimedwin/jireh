@extends('admin.index')

@section('content')

<div class="card card-secondary">

	<div class="card-header">
		<h3 class="card-title"><a href="{{route('fuerza.carrera.index', $fuerza_id)}}">{{'Carrera'}}</a></h3>
		<div class="card-tools">
			<form action="{{route('fuerza.carrera.index', $fuerza_id)}}" method="get">
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

	<form action="{{ route('fuerza.carrera.store', $fuerza_id)}}" method="post" autocomplete="off">
		@csrf
		<div class="card-body">

			@include('admin.success')
			@include('admin.errors')

			<div class="row">
				<div class=" col-12">
					<div class="form-group">
						<label for="fuerza.carrera.abreviatura">{{'Abreviatura *'}}</label>
						<input type="text" class="form-control" id="fuerza.carrera.abreviatura" name="abreviatura">
					</div>
					<div class="form-group">
						<label for="fuerza.carrera.descripcion">{{'Descripción *'}}</label>
						<input type="text" class="form-control" id="fuerza.carrera.descripcion" name="descripcion">
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
				</div>
			</div>
		</div>

		<div class="card-footer clearfix">
			<a href="{{route('fuerza.carrera.index', $fuerza_id)}}" class="btn btn-secondary" role="button"
				aria-label="Camcelar">{{'Cancelar'}}</a>
			<button type="submit" class="btn btn-success float-right">{{'Agregar'}}</button>
		</div>
	</form>
</div>
@endsection