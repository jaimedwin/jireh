@extends('admin.index')

@section('content')

<div class="card card-secondary">

	<div class="card-header">
		<h3 class="card-title"><a href="{{route('proceso.documento.index', $proceso_id)}}">{{'Documento'}}</a></h3>
		<div class="card-tools">
			<form action="{{route('proceso.documento.index', $proceso_id)}}" method="get" autocomplete="off">
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
				<a href="{{route('proceso.documento.create', $proceso_id)}}" class="btn btn-primary" role="button"
					aria-label="Buscar">
					<i class="fas fa-plus-square"></i>
					{{'Crear nuevo documento'}}
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
							<th>{{'Tipo de documento'}}</th>
							<th style="width: 80px" class="text-center">{{'Documento'}}</th>
							<th style="width: 160px" class="text-center">{{'Acciones'}}</th>
						</tr>
					</thead>
					<tbody>

						@foreach ($Documentosproceso as $documentoproceso)
						<tr>
							<td>{{$loop->iteration}}</td>
							<td>{{$documentoproceso->tipodocumento}}</td>
							<td class="text-center">
								@if ($documentoproceso->nombrearchivo)
								<a href="{{route('descargas_proceso_documentos', 
								[
									'proceso' => $documentoproceso->proceso_id, 
									'name' => $documentoproceso->nombrearchivo
								])}}" class="btn btn-outline-success">
									<i class="fa fa-download"></i>
								</a>
								@endif
							</td>
							<td class="text-center">
								<form action="{{route('proceso.documento.destroy',
							['proceso' => $proceso_id, 'documento' => $documentoproceso->id])}}" method="post">
									@method('DELETE')
									@csrf
									<div class="btn-group" role="group" aria-label="Acciones">
										<a href="{{route('proceso.documento.show', 
									['proceso' => $proceso_id, 'documento' => $documentoproceso->id])}}" class="btn btn-info" role="button"
											aria-label="Mostrar">
											<i class="far fa-eye" aria-hidden="true"></i>
										</a>
										<a href="{{route('proceso.documento.edit', 
									['proceso' => $proceso_id, 'documento' => $documentoproceso->id])}}" class="btn btn-warning"
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
		<div class="float-right">{{$Documentosproceso->links()}}</div>
	</div>
</div>
@endsection