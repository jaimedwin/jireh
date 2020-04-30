@extends('admin.index')

@section('content')

<div class="card card-secondary">

	<div class="card-header">
		<h3 class="card-title">
			<a href="{{route('personanatural.telefono.index', $personanatural_id)}}">{{'Telefono'}}</a>
		</h3>
		<div class="card-tools">
			<form action="{{route('personanatural.telefono.index', $personanatural_id)}}" method="get" autocomplete="off">
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
				<a href="{{route('personanatural.telefono.create', $personanatural_id)}}" class="btn btn-primary"
					role="button" aria-label="Crear">
					<i class="fas fa-plus-square"></i>
					{{'Crear nuevo telefono'}}
				</a>
			</div>
		</div>

		<div class="row">
			<div class="col-12 table-responsive">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th style="width: 10px">{{'#'}}</th>
							<th>{{'Prefijo'}}</th>
							<th>{{'Número'}}</th>
							<th style="width: 60px" class="text-center">{{'Principal'}}</th>
							<th style="width: 160px" class="text-center">{{'Acciones'}}</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($Telefonos as $telefono)
						<tr>
							<td>{{$loop->iteration}}</td>
							<td>{{$telefono->prefijo}}</td>
							<td>{{$telefono->numero}}</td>
							<td class="text-center">
								@if ($telefono->principal == 1)
								<i class="fas fa-check-circle text-success"></i>
								@endif
							</td>
							<td class="text-center">
								<form action="{{route('personanatural.telefono.destroy', 
                			['personanatural' => $personanatural_id, 'telefono' => $telefono->id])}}" method="post">
									@method('DELETE')
									@csrf
									<div class="btn-group" role="group" aria-label="Acciones">
										<a href="{{route('personanatural.telefono.show', 
                    				['personanatural' => $personanatural_id, 'telefono' => $telefono->id])}}" class="btn btn-info"
											role="button" aria-label="Mostrar">
											<i class="far fa-eye" aria-hidden="true"></i>
										</a>
										<a href="{{route('personanatural.telefono.edit', 
                    ['personanatural' => $personanatural_id, 'telefono' => $telefono->id])}}" class="btn btn-warning"
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
		<a href="{{route('personanatural.index')}}" class="btn btn-secondary" role="button" aria-label="Buscar">
			{{'Atras'}}
		</a>
		<div class="float-right">{{$Telefonos->links()}}</div>
	</div>
</div>
@endsection