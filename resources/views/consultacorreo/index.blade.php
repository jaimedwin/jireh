@extends('admin.index')

@section('content')

<div class="card card-secondary">

	<div class="card-header">
		<h3 class="card-title"><a href="{{route('consultacorreo.index')}}">{{'Consulta de envio de correos'}}</a></h3>
		<div class="card-tools">
			<form action="{{route('consultacorreo.index')}}" method="get" autocomplete="off">
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
							<th>{{'Tipo de correo'}}</th>
							<th>{{'A'}}</th>
							<th>{{'Resumen mensaje'}}</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($Consultacorreos as $consultacorreo)
						<tr>
							<td>{{$loop->iteration}}</td>
							<td>{{$consultacorreo->created_at}}</td>
							<td>{{$consultacorreo->consultacorreotipo}}</td>
							<td>{{$consultacorreo->a}}</td>
							<td>{!! $consultacorreo->mensaje !!}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="card-footer clearfix">
		<div class="float-right">{{$Consultacorreos->links()}}</div>
	</div>
</div>
@endsection