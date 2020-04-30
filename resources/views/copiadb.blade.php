@extends('admin.index')

@section('content')

<div class="card card-secondary">

	<div class="card-header">
		<h3 class="card-title"><a href="{{route('copiadb.index')}}">{{'Copia de la base de datos'}}</a></h3>
	</div>


	<div class="card-body">

		@include('admin.success')
		@include('admin.errors')

		<div class="row  mb-4">
			<div class="col-12">
				<a href="{{route('copiadb.create')}}" class="btn btn-primary" role="button" aria-label="Crear">
					<i class="fas fa-plus-square"></i>
					{{'Crear nueva copia de la base de datos'}}
				</a>
			</div>
		</div>

		<div class="row">
			<div class="col-12 table-responsive">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th style="width: 10px">{{'#'}}</th>
							<th>{{'Nombre archivo'}}</th>
							<th>{{'Descarga'}}</th>
							<th>{{'Borrar'}}</th>
						</tr>
					</thead>
					<tbody>

						@foreach ($files_name as $file)
						<tr>
							<td>{{$loop->iteration}}</td>
							<td>{{$file}}</td>
							<td><a href="{{route('descargas_copiasbasesdedatos', $file)}}"
									class="btn btn-outline-success">
									<i class="fa fa-download"></i>
								</a>
							</td>
							<td><a href="{{route('borrar_copiasbasesdedatos', $file)}}" class="btn btn-outline-danger" aria-label="Borrar" onclick="return confirm('¿Realmente desea eliminar la copia de la base de datos?')">
									<i class="fa fa-trash"></i>
								</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection