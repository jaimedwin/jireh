@extends('admin.index')

@section('content')

<div class="card card-secondary">

	<div class="card-header">
		<h3 class="card-title"><a href="{{route('registroconsulta.index')}}">{{'Consulta de acceo de clientes'}}</a></h3>
		<div class="card-tools">
			<form action="{{route('registroconsulta.index')}}" method="get" autocomplete="off">
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

		<div class="row">
			<div class="col-12 table-responsive">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th style="width: 10px">{{'#'}}</th>
							<th>{{'Fecha y hora'}}</th>
							<th>{{'Identificación'}}</th>
							<th>{{'Nombre completo'}}</th>
							<th>{{'Número del proceo'}}</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($Registrosconsulta as $registroconsulta)
						<tr>
							<td>{{$loop->iteration}}</td>
							<td>{{$registroconsulta->created_at}}</td>
							<td>{{$registroconsulta->numerodocumento}}</td>
							<td>{{$registroconsulta->nombrecompleto}}</td>
							<td>{{$registroconsulta->proceso}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="card-footer clearfix">
		<div class="float-right">{{$Registrosconsulta->links()}}</div>
	</div>
</div>
@endsection