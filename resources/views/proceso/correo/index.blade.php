@extends('admin.index')

@section('content')

<div class="card card-secondary">
	<div class="card-header">
		<h3 class="card-title"><a href="{{route('proceso.correo.index', $id)}}">{{'Lista de correo(s) a notificar'}}</a></h3>
		<div class="card-tools">
			<form action="{{route('proceso.correo.index', $id)}}" method="get" autocomplete="off">
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
                            <th>{{'Número de documento'}}</th>
                            <th>{{'Nombre completo'}}</th>
                            <th>{{'Email'}}</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($consultas as $consulta)
						<tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$consulta->personanatural_numerodocumento}}</td>
                            <td>{{$consulta->nombrecompleto}}</td>
							<td>{{$consulta->email}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="card-footer clearfix">
        <div class="row">
            <div class="col-12">
                <div class="float-right">{{$consultas->links()}}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <a href="{{route('proceso.index')}}" class="btn btn-secondary" role="button" aria-label="Cancelar">
                    {{'Cancelar'}}
                </a>
                <a href="{{route ('proceso.correo.sendemail',$id)}}"
                    class="btn btn-success float-right" role="button">
                    {{'Enviar notificación'}}
                </a>
            </div>
        </div>
	</div>
</div>


@endsection