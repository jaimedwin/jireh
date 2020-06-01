@extends('admin.index')

@section('content')

<div class="card card-secondary">

	<div class="card-header">
		<h3 class="card-title"><a href="{{route('contrato.index')}}">{{'Contrato'}}</a></h3>
		<div class="card-tools">
			<form action="{{route('contrato.index')}}" method="get" autocomplete="off">
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
				<a href="{{route('contrato.create')}}" class="btn btn-primary" role="button" aria-label="Buscar">
					<i class="fas fa-plus-square"></i>
					{{'Crear nuevo contrato'}}
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
							<th>{{'Número del contrato'}}</th>
							<th>{{'Valor'}}</th>
							<th>{{'Tipo de contrato'}}</th>
							<th>{{'Identificación'}}</th>
							<th>{{'Persona natural'}}</th>
							<th>{{'Código del proceso'}}</th>
							<th>{{'Número del proceso'}}</th>
							<th style="width: 80px" class="text-center">{{'Documento'}}</th>
							<th style="width: 80px" class="text-center">{{'Pagos'}}</th>
							<th style="width: 160px" class="text-center">{{'Acciones'}}</th>
						</tr>
					</thead>
					<tbody>

						@foreach ($Contratos as $contrato)
						<tr>
							<td>{{$loop->iteration}}</td>
							<td>{{$contrato->numero}}</td>
							<td class="row_data">{{$contrato->valor}}</td>
							<td>{{$contrato->tipocontrato}}</td>
							<td>{{$contrato->numerodocumento}}</td>
							<td>{{$contrato->nombrecompleto}}</td>
							<td>{{$contrato->proceso_codigo}}</td>
							<td>{{$contrato->proceso_numero}}</td>
							<td class="text-center">
								@if ($contrato->nombrearchivo)
								<a href="{{route('descargas_otrosdocumentos_contrato', 
                  [
                    'personanatural' => $contrato->personanatural_id, 
                    'name' => $contrato->nombrearchivo
                  ])}}" class="btn btn-outline-success">
									<i class="fa fa-download"></i>
								</a>
								@endif
							</td>
							<td class="text-center">
								<a href="{{route('contrato.pago.index', $contrato->id)}}"
									class="btn btn-outline-success" role="button" aria-label="Pagos">
									<i class="fas fa-dollar-sign" aria-hidden="true"></i>
								</a>
							</td>
							<td class="text-center">
								<form action="{{route('contrato.destroy', $contrato->id)}}" method="post">
									@method('DELETE')
									@csrf
									<div class="btn-group" role="group" aria-label="Acciones">
										<a href="{{route('contrato.show', $contrato->id)}}" class="btn btn-info"
											role="button" aria-label="Mostrar">
											<i class="far fa-eye" aria-hidden="true"></i>
										</a>
										<a href="{{route('contrato.edit', $contrato->id)}}" class="btn btn-warning"
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
		<div class="float-right">{{$Contratos->links()}}</div>
	</div>
</div>
@endsection