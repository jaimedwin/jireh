@extends('admin.index')

@section('content')

<div class="card card-secondary">

	<div class="card-header">
		<h3 class="card-title"><a href="{{route('fuerza.carrera.index', $fuerza_id)}}">{{'Carrera'}}</a></h3>
		<div class="card-tools">
			<form action="{{route('fuerza.carrera.index', $fuerza_id)}}" method="get" autocomplete="off">
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
				<a href="{{route('fuerza.carrera.create', $fuerza_id)}}" class="btn btn-primary" role="button"
					aria-label="Crear">
					<i class="fas fa-plus-square"></i>
					{{'Crear nueva carrera'}}
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
							<th style="width: 80px" class="text-center">{{'Grado'}}</th>
							<th style="width: 160px" class="text-center">{{'Acciones'}}</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($Carreras as $carrera)
						<tr>
							<td>{{$loop->iteration}}</td>
							<td>{{$carrera->abreviatura}}</td>
							<td>{{$carrera->descripcion}}</td>
							<td class="text-center">
								<a href="{{route('fuerza.carrera.grado.index', ['fuerza' => $fuerza_id, 'carrera' => $carrera->id])}}"
									class="btn btn-outline-success" role="button" aria-label="Mostrar">
									<i class="fas fa-shield-alt" aria-hidden="true"></i>
								</a>
							</td>
							<td class="text-center">
								<form action="{{route('fuerza.carrera.destroy', 
                ['fuerza' => $fuerza_id, 'carrera' => $carrera->id])}}" method="post">
									@method('DELETE')
									@csrf
									<div class="btn-group" role="group" aria-label="Acciones">
										<a href="{{route('fuerza.carrera.show', 
                    ['fuerza' => $fuerza_id, 'carrera' => $carrera->id])}}" class="btn btn-info" role="button"
											aria-label="Mostrar">
											<i class="far fa-eye" aria-hidden="true"></i>
										</a>
										<a href="{{route('fuerza.carrera.edit', 
                    ['fuerza' => $fuerza_id, 'carrera' => $carrera->id])}}" class="btn btn-warning"
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
		<a href="{{route('fuerza.index')}}" class="btn btn-secondary" role="button" aria-label="Buscar">
			{{'Atras'}}
		</a>
		<div class="float-right">{{$Carreras->links()}}</div>
	</div>
</div>
@endsection