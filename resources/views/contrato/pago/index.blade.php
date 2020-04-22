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

		<div class="row mb-4">
			<div class="col-sm-6 col-md-7 col-lg-8 col-xl-9">
			  <a href="{{route('contrato.pago.create', $contrato_id)}}" class="btn btn-primary" role="button" aria-label="Buscar">
				<i class="fas fa-plus-square"></i>
				{{'Crear nuevo pago'}}
			  </a>
			</div>
			<div class="col-sm-6 col-md-5 col-lg-4 col-xl-3">
			  <div class="form-group row"> 
				<label for="inputPassword" class="col-5 col-form-label">{{'Saldo:'}}</label>
    			<div class="form-control col-7 row_data">
					{{$Saldo}}
    			</div>
			  </div>
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
							<td class="row_data">{{$pago->abono}}</td>
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