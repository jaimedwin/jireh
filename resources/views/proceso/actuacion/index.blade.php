@extends('admin.index')

@section('content')

<div class="card card-secondary">
	<div class="card-header">
		<h3 class="card-title"><a href="{{route('proceso.actuacion.index', $proceso_id)}}">{{'Actuación'}}</a></h3>
		<div class="card-tools">
			<form action="{{route('proceso.actuacion.index', $proceso_id)}}" method="get" autocomplete="off">
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
		<div class="row  mb-4">
			<div class="col-12">
				<a href="{{route('proceso.actuacion.create', $proceso_id)}}" class="btn btn-primary" role="button"
					aria-label="Buscar">
					<i class="fas fa-plus-square"></i>
					{{'Crear nuevo actuacion'}}
				</a>
				@include('admin.descarga_csv',
					[
					'route_name' => 'proceso.actuacion.csv',
					'parameter' => [$proceso_id],
					'title_btn' => 'Descargar CSV'
					])
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
							<th>{{'Fecha de actuación'}}</th>
							<th>{{'Actuación'}}</th>
							<th>{{'Anotación'}}</th>
							<th>{{'Fecha inicia termino'}}</th>
							<th>{{'fecha finaliza termino'}}</th>
							<th>{{'fecha registro'}}</th>
							<th style="width: 60px" class="text-center">{{'Documento'}}</th>
							<th style="width: 160px" class="text-center">{{'Acciones'}}</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($Actuacionprocesos as $actuacionproceso)
						<tr>

							<td>{{$loop->iteration}}</td>
							<td>{{$actuacionproceso->fechaactuacion}}</td>
							<td>{{$actuacionproceso->actuacion}}</td>
							<td>{{$actuacionproceso->anotacion}}</td>
							<td>{{$actuacionproceso->fechainiciatermino}}</td>
							<td>{{$actuacionproceso->fechafinalizatermino}}</td>
							<td>{{$actuacionproceso->fecharegistro}}</td>
							<td class="text-center">
								@if ($actuacionproceso->nombrearchivo)
								<a href="{{route('descargas_actuaciones', 
									[
										'proceso' => $proceso_id, 
										'name' => $actuacionproceso->nombrearchivo
									])}}" class="btn btn-outline-success">
									<i class="fa fa-download"></i>
								</a>
								@endif

							</td>
							<td class="text-center">
								<form action="{{route('proceso.actuacion.destroy', 
                  ['proceso' => $proceso_id, 'actuacion' => $actuacionproceso->id])}}" method="post">
									@method('DELETE')
									@csrf
									<div class="btn-group" role="group" aria-label="Acciones">
										<a href="{{route('proceso.actuacion.show', 
                      ['proceso' => $proceso_id, 'actuacion' => $actuacionproceso->id])}}" class="btn btn-info"
											role="button" aria-label="Mostrar">
											<i class="far fa-eye" aria-hidden="true"></i>
										</a>
										<a href="{{route('proceso.actuacion.edit', 
                      ['proceso' => $proceso_id, 'actuacion' => $actuacionproceso->id])}}" class="btn btn-warning"
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
		<a href="{{route('proceso.index')}}" class="btn btn-secondary" role="button" aria-label="Atras">
			{{'Atras'}}
		</a>
		<div class="float-right">{{$Actuacionprocesos->links()}}</div>
	</div>
</div>
@endsection