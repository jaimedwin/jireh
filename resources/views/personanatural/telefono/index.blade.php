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


	<div class="card-body">

		@if ($message = Session::get('success'))
		<div class="row">
			<div class="col-12">
				<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
						<span aria-hidden="true">&times;</span>
					</button>
					<h5><i class="icon fa fa-check"></i> {{'Alerta!'}}</h5>
					<ul>
						<li>{{$message}}</li>
					</ul>
				</div>
			</div>
		</div>
		@endif

		@include('admin.errors')

		<div class="row mb-4"">
      <div class=" col-12">
			<form action="{{ route('personanatural.telefono.store', $personanatural_id)}}" method="post">
				@csrf
				<div class="row mb-4">
					<div class="col-12">
						<div class="form-group">
							<label for="personanatural.telefono.prefijo">{{'Prefijo'}}</label>
							<input type="text" class="form-control" id="personanatural.telefono.prefijo" name="prefijo">
						</div>
						<div class="form-group">
							<label for="personanatural.telefono.numero">{{'Número'}}</label>
							<input type="text" class="form-control" id="personanatural.telefono.numero" name="numero">
						</div>
						<div class="form-group">
							<label
								for="proceso.actuacion.nombrearchivo">{{'¿Telefono principal?'}}</label>
							<div class="btn-group btn-group-toggle" data-toggle="buttons">
								<label class="btn btn-primary">
									<input type="radio" name="principal" id="option1" autocomplete="off" value="1">
									{{'Sí'}}
								</label>
								<label class="btn btn-primary active">
									<input type="radio" name="principal" id="option0" autocomplete="off" value="0"
									checked>
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
							<input id="personanatural_id" class="form-control" type="hidden" name="personanatural_id"
								value="{{$personanatural_id}}">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<a href="{{route('personanatural.telefono.index', $personanatural_id)}}"
							class="btn btn-secondary" role="button" aria-label="Buscar">
							{{'Cancelar'}}
						</a>
						<button type="submit" class="btn btn-success float-right">
							{{'Agregar'}}
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>



	<div class="row">
		<div class="col-12 table-responsive">
			<table class="table table-bordered table-striped">
				<thead class="">
					<tr>
						<th style="width: 10px">{{'#'}}</th>
						<th>{{'Prefijo'}}</th>
						<th>{{'Número'}}</th>
						<th style="width: 60px" class="text-center">{{'Principal'}}</th>
						<th style="width: 160px" class="text-center">{{'Acciones'}}</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($Telefonos as $telefono)
					<tr>
						<td>{{$loop->iteration}}</td>
						<td>{{$telefono->prefijo}}</td>
						<td>{{$telefono->numero}}</td>
						<td class="text-center">
							@if ($telefono->principal == 1)
								<i class="fas fa-check-circle text-success"></i>
							@endif
						</td>
						<td class="text-center">
							<form action="{{route('personanatural.telefono.destroy', 
                			['personanatural' => $personanatural_id, 'telefono' => $telefono->id])}}" method="post">
								@method('DELETE')
								@csrf
								<div class="btn-group" role="group" aria-label="Acciones">
									<a href="{{route('personanatural.telefono.show', 
                    				['personanatural' => $personanatural_id, 'telefono' => $telefono->id])}}" class="btn btn-info"
										role="button" aria-label="Mostrar">
										<i class="far fa-eye" aria-hidden="true"></i>
									</a>
									<a href="{{route('personanatural.telefono.edit', 
                    ['personanatural' => $personanatural_id, 'telefono' => $telefono->id])}}" class="btn btn-warning"
										aria-label="Editar">
										<i class="fas fa-pen" aria-hidden="true"></i>
									</a>
									<button type="submit" class="btn btn-danger" aria-label="Borrar"
										onclick="return confirm('¿Realmente desea eliminar?')">
										<i class="fa fa-trash" aria-hidden="true"></i>
									</button>
								</div>
							</form>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- /.card-body -->
<div class="card-footer clearfix">
	<a href="{{route('personanatural.index')}}" class="btn btn-secondary" role="button" aria-label="Buscar">
		{{'Atras'}}
	</a>
	<div class="float-right">{{$Telefonos->links()}}</div>
</div>
</div>
@endsection