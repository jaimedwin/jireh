@extends('admin.index')

@section('content')

<div class="card card-secondary">

	<div class="card-header">
		<h3 class="card-title"><a href="{{route('personanatural.index')}}">{{'Persona natural'}}</a></h3>
	</div>


	<div class="card-body">

		@include('admin.errors')

		<form action="{{ route('personanatural.store')}}" method="post" autocomplete="off">
			@csrf
			<div class="row">
				<div class="form-group col-lg">
					<label for="personanatural.numero">{{'Codigo *'}}</label>
					<input type="text" class="form-control" id="personanatural.numero" name="codigo">
				</div>
				<div class="form-group col-lg">
					<label for="personanatural.nombres">{{'Nombres *'}}</label>
					<input type="text" class="form-control" id="personanatural.nombres" name="nombres">
				</div>

				<div class="form-group col-lg">
					<label for="personanatural.apellidopaterno">{{'Apellido paterno'}}</label>
					<input type="text" class="form-control" id="personanatural.apellidopaterno" name="apellidopaterno">
				</div>
				<div class="form-group col-lg">
					<label for="personanatural.apellidomaterno">{{'Apellido materno'}}</label>
					<input type="text" class="form-control" id="personanatural.apellidomaterno" name="apellidomaterno">
				</div>
			</div>

			<div class="row">
				<div class="col-lg">
					<div class="form-group">
						<label
							for="personanatural.tipodocumentoindentificacion">{{'Tipo de documento de indentificacion *'}}</label>
						<select class="form-control selectpicker" id="personanatural.tipodocumentoindentificacion"
							data-show-subtext="true" data-live-search="true" name="tipodocumentoidentificacion_id">
							<option selected>Seleccione ...</option>

							@foreach ($Tiposdocumentosidentificacion as $tdi)
							<option data-tokens="{{$tdi->abreviatura}} {{$tdi->descripcion}}" value="{{$tdi->id}}"
								data-subtext="{{$tdi->descripcion}}">
								{{$tdi->abreviatura}}
							</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-lg">
					<div class="form-group">
						<label for="personanatural.numerodocumento">{{'Número de documento *'}}</label>
						<input type="text" class="form-control" id="personanatural.numerodocumento"
							name="numerodocumento">
					</div>
				</div>
				<div class="col-lg">
					<div class="form-group">
						<label for="personanatural.municipio">{{'Lugar de expedición *'}}</label>
						<select class="form-control selectpicker" id="personanatural.municipio" data-show-subtext="true" data-live-search="true"
							name="municipio_id">
							<option selected>Seleccione ...</option>
							@foreach ($Expediciones as $expe)
							<option data-tokens="{{$expe->municipio}} {{$expe->departamento}}" value="{{$expe->id}}"
								data-subtext="{{$expe->departamento}}">
								{{$expe->municipio}}
							</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-lg">
					<div class="form-group">
						<label for="personanatural.fechaexpedicion">{{'Fecha de expedicion'}}</label>
						<input class="form-control" type="date" id="personanatural.fechaexpedicion"
							name="fechaexpedicion" max="{{ \Carbon\Carbon::now()->toDateString() }}">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-lg-4">
					<label for="personanatural.fechanacimiento">{{'Fecha de nacimiento'}}</label>
					<input class="form-control" type="date" id="personanatural.fechanacimiento" name="fechanacimiento"
						max="{{ \Carbon\Carbon::now()->toDateString() }}">
				</div>
				<div class="form-group col-lg-8">
					<label for="personanatural.direccion">{{'Dirección *'}}</label>
					<input type="text" class="form-control" id="personanatural.direccion" name="direccion">
				</div>
			</div>
			<div class="row">
				<div class="form-group col-lg">
					<label for="personanatural.fondodepension">{{'Fondo de pensiones *'}}</label>
					<select class="form-control selectpicker" id="personanatural.fondodepension" data-show-subtext="true" data-live-search="true"
						name="fondodepension_id">
						<option selected>Seleccione ...</option>
						@foreach ($Fondodepensiones as $fdp)
						<option data-tokens="{{$fdp->abreviatura}}" value="{{$fdp->id}}"
							data-subtext="{{$fdp->descripcion}}">
							{{$fdp->abreviatura}}
						</option>
						@endforeach
					</select>
				</div>
				<div class="form-group col-lg">
					<label for="personanatural.eps">{{'Eps *'}}</label>
					<select class="form-control selectpicker" id="personanatural.eps" data-show-subtext="true" data-live-search="true"
						name="eps_id">
						<option selected>Seleccione ...</option>
						@foreach ($Eps as $ep)
						<option data-tokens="{{$ep->abreviatura}} {{$ep->descripcion}}" value="{{$ep->id}}"
							data-subtext="{{$ep->descripcion}}">
							{{$ep->abreviatura}}
						</option>
						@endforeach
					</select>
				</div>
				<div class="form-group col-lg">
					<label for="personanatural.grado">{{'Grado *'}}</label>
					<select class="form-control selectpicker" id="personanatural.grado" data-show-subtext="true" data-live-search="true"
						name="grado_id">
						<option selected>Seleccione ...</option>
						@foreach ($Grados as $g)
						<option data-tokens="{{$g->fuerza}} {{$g->abreviatura}} {{$g->descripcion}}" value="{{$g->id}}"
							data-subtext="{{$g->descripcion}}">
							{{$g->fuerza}} - {{$g->abreviatura}}
						</option>
						@endforeach
					</select>
				</div>
				
				<div class="form-group">
					<label class="sr-only" for="users_id">users_id</label>
					<input id="users_id" class="form-control" type="hidden" name="users_id" value="{{ Auth::id()}}">
				</div>
			</div>

			<div class="row">
				<div class="col-lg">
					<a href="{{route('personanatural.index')}}" class="btn btn-secondary" role="button"
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
	<div class="card-footer clearfix">

	</div>
</div>
@endsection