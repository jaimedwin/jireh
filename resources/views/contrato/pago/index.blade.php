@extends('admin.index')

@section('content')

<div class="card card-secondary">

	<div class="card-header">
		<h3 class="card-title"><a href="{{route('contrato.pago.index', $contrato_id)}}">{{'Pago'}}</a></h3>
		<div class="card-tools">
			<form action="{{route('contrato.pago.index', $contrato_id)}}" method="get">
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

		<div class="row mb-4"">
      <div class=" col-12">
			@if ($errors->any())
			<div class="row mb-4">
				<div class="col-12">
					<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
							<span aria-hidden="true">&times;</span>
						</button>
						<h5><i class="fas fa-exclamation-triangle"></i>
							<strong>{{'Error!'}}</strong>
						</h5>
						<ul>
							@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
			@endif

			<form action="{{ route('contrato.pago.store', $contrato_id)}}" method="post">
				@csrf
				<div class="row mb-4">
					<div class="col-12">
						<div class="form-group">
							<label for="contrato.pago.abono">{{'Abono'}}</label>
							<input type="text" class="form-control" id="contrato.pago.abono" name="abono">
						</div>
						<div class="form-group">
							<label for="contrato.pago.nrecibo">{{'Número de recibo'}}</label>
							<input type="text" class="form-control" id="contrato.pago.nrecibo" name="nrecibo">
						</div>
						<div class="form-group">
							<label for="contrato.pago.fecha">{{'Fecha de recibo'}}</label>
							<input class="form-control" type="date" id="contrato.pago.fecha" name="fecha"
							max="{{ \Carbon\Carbon::now()->toDateString() }}">
						</div>
						<div class="form-group">
							<label class="sr-only" for="users_id">users_id</label>
							<input id="users_id" class="form-control" type="hidden" name="users_id"
								value="{{ Auth::id()}}">
						</div>
						<div class="form-group">
							<label class="sr-only" for="contrato_id">contrato_id</label>
							<input id="contrato_id" class="form-control" type="hidden" name="contrato_id"
								value="{{$contrato_id}}">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<a href="{{route('contrato.pago.index', $contrato_id)}}" class="btn btn-secondary" role="button"
							aria-label="Buscar">
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
						<th>{{'Abono'}}</th>
						<th>{{'Número de recibo'}}</th>
						<th>{{'Fecha de recibo'}}</th>
						<th style="width: 160px" class="text-center">{{'Acciones'}}</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($Pagos as $pago)
					<tr>
						<td>{{$loop->iteration}}</td>
						<td>{{$pago->abono}}</td>
						<td>{{$pago->nrecibo}}</td>
						<td>{{$pago->fecha}}</td>
						<td class="text-center">
							<form action="{{route('contrato.pago.destroy', 
                				['contrato' => $contrato_id, 'pago' => $pago->id])}}" method="post">
								@method('DELETE')
								@csrf
								<div class="btn-group" role="group" aria-label="Acciones">
									<a href="{{route('contrato.pago.show', 
                    					['contrato' => $contrato_id, 'pago' => $pago->id])}}" class="btn btn-info" role="button"
										aria-label="Mostrar">
										<i class="far fa-eye" aria-hidden="true"></i>
									</a>
									<a href="{{route('contrato.pago.edit', 
                    					['contrato' => $contrato_id, 'pago' => $pago->id])}}" class="btn btn-warning"
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
	<a href="{{route('contrato.index')}}" class="btn btn-secondary" role="button" aria-label="Buscar">
		{{'Atras'}}
	</a>
	<div class="float-right">{{$Pagos->links()}}</div>
</div>
</div>
@endsection