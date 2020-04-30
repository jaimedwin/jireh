@extends('admin.index')

@section('content')

<div class="card card-secondary">

	<div class="card-header">
		<h3 class="card-title"><a
				href="{{route('personanatural.telefono.index', $personanatural_id)}}">{{'Telefono'}}</a></h3>
		<div class="card-tools">
			<form action="{{route('personanatural.telefono.index', $personanatural_id)}}" method="get">
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


	<form action="{{ route('personanatural.telefono.store', $personanatural_id)}}" method="post" autocomplete="off" >
		@csrf

		<div class="card-body">

			@include('admin.success')
			@include('admin.errors')

			<div class="row mb-4">
				<div class=" col-12">

					<div class="row mb-4">
						<div class="col-12">
							<div class="form-group">
								<label for="personanatural.telefono.prefijo">{{'Prefijo *'}}</label>
								<input type="text" class="form-control" id="personanatural.telefono.prefijo"
									name="prefijo">
							</div>
							<div class="form-group">
								<label for="personanatural.telefono.numero">{{'Número *'}}</label>
								<input type="text" class="form-control" id="personanatural.telefono.numero"
									name="numero">
							</div>
							<div class="form-group">
								<label for="proceso.actuacion.nombrearchivo">{{'¿Telefono principal? *'}}</label>
								<div class="btn-group btn-group-toggle" data-toggle="buttons">
									<label class="btn btn-primary">
										<input type="radio" name="principal" id="option1" value="1">
										{{'Sí'}}
									</label>
									<label class="btn btn-primary">
										<input type="radio" name="principal" id="option0" value="0">
										{{'No'}}
									</label>
								</div>
							</div>
							<div class="form-group">
								<label class="sr-only" for="users_id">users_id</label>
								<input id="users_id" class="form-control" type="hidden" name="users_id"
									value="{{ Auth::id()}}">
							</div>
							<div class="form-group">
								<label class="sr-only" for="personanatural_id">personanatural_id</label>
								<input id="personanatural_id" class="form-control" type="hidden"
									name="personanatural_id" value="{{$personanatural_id}}">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="card-footer clearfix">
			<a href="{{route('personanatural.telefono.index', $personanatural_id)}}" class="btn btn-secondary"
				role="button" aria-label="Buscar">
				{{'Cancelar'}}</a>
			<button type="submit" class="btn btn-success float-right">{{'Agregar'}}</button>
		</div>
	</form>
</div>
@endsection