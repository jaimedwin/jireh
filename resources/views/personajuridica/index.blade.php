@extends('admin.index')

@section('content')

<div class="card card-secondary">

	<div class="card-header">
		<h3 class="card-title"><a href="{{route('personajuridica.index')}}">{{'Persona juridica'}}</a></h3>
		<div class="card-tools">
			<form action="{{route('personajuridica.index')}}" method="get" autocomplete="off">
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
				<a href="{{route('personajuridica.create')}}" class="btn btn-primary" role="button" aria-label="Buscar">
					<i class="fas fa-plus-square"></i>
					{{'Crear nueva persona juridica'}}
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
							<th>{{'Nit'}}</th>
							<th>{{'Razón social'}}</th>
							<th>{{'Dirección'}}</th>
							<th>{{'Persona natural'}}</th>
							<th style="width: 160px" class="text-center">{{'Acciones'}}</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($Personasjuridicas as $personajuridica)
						<tr>
							<td>{{$loop->iteration}}</td>
							<td>{{$personajuridica->nit}}</td>
							<td>{{$personajuridica->razonsocial}}</td>
							<td>{{$personajuridica->direccion}}</td>
							<td>{{$personajuridica->nombrecompleto}}</td>
							<td class="text-center">
								<form action="{{route('personajuridica.destroy', $personajuridica->id)}}" method="post">
									@method('DELETE')
									@csrf
									<div class="btn-group" role="group" aria-label="Acciones">
										<a href="{{route('personajuridica.show', $personajuridica->id)}}"
											class="btn btn-info" role="button" aria-label="Mostrar">
											<i class="far fa-eye" aria-hidden="true"></i>
										</a>
										<a href="{{route('personajuridica.edit', $personajuridica->id)}}"
											class="btn btn-warning" aria-label="Editar">
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
		<div class="float-right">{{$Personasjuridicas->links()}}</div>
	</div>
</div>
@endsection