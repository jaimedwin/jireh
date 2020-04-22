@extends('admin.index')

@section('content')

<div class="card card-secondary">

	<div class="card-header">
		<h3 class="card-title"><a href="{{route('clienteproceso.index')}}">{{'Cliente y proceso'}}</a></h3>
		<div class="card-tools">
			<form action="{{route('clienteproceso.index')}}" method="get">
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
		<div class="row mb-4">
			<div class="col-12">
				<a href="{{route('clienteproceso.create')}}" class="btn btn-primary" role="button" aria-label="Buscar">
					<i class="fas fa-plus-square"></i>
					{{'Crear nueva relacion personanatural y proceso'}}
				</a>
			</div>
		</div>

		@if ($messages = Session::get('success'))
		<div class="row">
			<div class="col-12">
				<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
						<span aria-hidden="true">&times;</span>
					</button>
					<h5><i class="icon fa fa-check"></i> {{'Alerta!'}}</h5>
					<ul>
						@foreach ($messages as $message)
						<li>{{$message}}</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
		@endif

		@include('admin.errors')

		<div class="row">
			<div class="col-12 table-responsive">
				<table class="table table-bordered table-striped">
					<thead class="">
						<tr>
							<th style="width: 10px">{{'#'}}</th>
							<th>{{'Persona natural'}}</th>
							<th>{{'Proceso'}}</th>
							<th>{{'Tipo de demanda'}}</th>
							<th style="width: 160px" class="text-center">{{'Acciones'}}</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($Clientesprocesos as $clienteproceso)

						<tr>
							<td>{{$loop->iteration}}</td>
							<td>{{$clienteproceso->nombrecompleto}}</td>
							<td>{{$clienteproceso->proceso}}</td>
							<td>{{$clienteproceso->tipodemanda}}</td>
							<td class="text-center">
								<form action="{{route('clienteproceso.destroy', $clienteproceso->id)}}" method="post">
									@method('DELETE')
									@csrf
									<div class="btn-group" role="group" aria-label="Acciones">
										<a href="{{route('clienteproceso.show', $clienteproceso->id)}}"
											class="btn btn-info" role="button" aria-label="Mostrar">
											<i class="far fa-eye" aria-hidden="true"></i>
										</a>
										<a href="{{route('clienteproceso.edit', $clienteproceso->id)}}"
											class="btn btn-warning" aria-label="Editar">
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
		<div class="float-right">{{$Clientesprocesos->links()}}</div>
	</div>
</div>
@endsection