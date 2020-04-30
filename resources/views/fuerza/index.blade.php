@extends('admin.index')

@section('content')

<div class="card card-secondary">

	<div class="card-header">
		<h3 class="card-title"><a href="{{route('fuerza.index')}}">{{'Fuerza'}}</a></h3>
		<div class="card-tools">
			<form action="{{route('fuerza.index')}}" method="get" autocomplete="off">
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

		@include('admin.success')
		@include('admin.errors')

		<div class="row  mb-4">
			<div class="col-12">
				<a href="{{route('fuerza.create')}}" class="btn btn-primary" role="button" aria-label="Crear">
					<i class="fas fa-plus-square"></i>
					{{'Crear nueva fuerza'}}
				</a>
			</div>
		</div>

		<div class="row">
			<div class="col-12 table-responsive">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th style="width: 10px">{{'#'}}</th>
							<th>{{'Abreviatura'}}</th>
							<th>{{'Descripción'}}</th>
							<th style="width: 80px" class="text-center">{{'Carrera'}}</th>
							<th style="width: 160px" class="text-center">{{'Acciones'}}</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($Fuerzas as $fuerza)
						<tr>
							<td>{{$loop->iteration}}</td>
							<td>{{$fuerza->abreviatura}}</td>
							<td>{{$fuerza->descripcion}}</td>
							<td class="text-center">
								<a href="{{route('fuerza.carrera.index', $fuerza->id)}}" class="btn btn-outline-success"
									role="button" aria-label="Mostrar">
									<i class="fas fa-shield-alt" aria-hidden="true"></i>
								</a>
							</td>
							<td class="text-center">
								<form action="{{route('fuerza.destroy', $fuerza->id)}}" method="post">
									@method('DELETE')
									@csrf
									<div class="btn-group" role="group" aria-label="Acciones">
										<a href="{{route('fuerza.show', $fuerza->id)}}" class="btn btn-info"
											role="button" aria-label="Mostrar">
											<i class="far fa-eye" aria-hidden="true"></i>
										</a>
										<a href="{{route('fuerza.edit', $fuerza->id)}}" class="btn btn-warning"
											aria-label="Editar">
											<i class="fas fa-pen" aria-hidden="true"></i>
										</a>
										@include('admin.btn_delete')
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

	<div class="card-footer clearfix">
		<div class="float-right">{{$Fuerzas->links()}}</div>
	</div>
</div>
@endsection