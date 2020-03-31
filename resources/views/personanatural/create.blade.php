@extends('admin.index')

@section('content')

<div class="card card-secondary">

	<div class="card-header">
		<h3 class="card-title"><a href="{{route('personanatural.index')}}">{{'Persona natural'}}</a></h3>
	</div>


	<div class="card-body">

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


		<form action="{{ route('personanatural.store')}}" method="post">
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
							data-live-search="true" name="tipodocumentoidentificacion_id">
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
						<label for="personanatural.expedicion">{{'Lugar de expedición *'}}</label>
						<select class="form-control selectpicker" id="personanatural.expedicion" data-live-search="true"
							name="expedicion_id">
							<option selected>Seleccione ...</option>
							@foreach ($Expediciones as $expe)
							<option data-tokens="{{$expe->lugar}}" value="{{$expe->id}}">
								{{$expe->lugar}}
							</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-lg">
					<div class="form-group">
						<label for="personanatural.fechaexpedicion">{{'Fecha de expedicion'}}</label>
						<input class="form-control" type="date" id="personanatural.fechaexpedicion" name="fechaexpedicion">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-lg-4">
					<label for="personanatural.fechanacimiento">{{'Fecha de nacimiento'}}</label>
					<input class="form-control" type="date" id="personanatural.fechanacimiento" name="fechanacimiento">
				</div>
				<div class="form-group col-lg-8">
					<label for="personanatural.direccion">{{'Dirección *'}}</label>
					<input type="text" class="form-control" id="personanatural.direccion" name="direccion">
				</div>
			</div>
			<div class="row">
				<div class="form-group col-lg">
					<label for="personanatural.fondodepension">{{'Fondo de pensiones *'}}</label>
					<select class="form-control selectpicker" id="personanatural.fondodepension" data-live-search="true"
						name="fondodepension_id">
						<option selected>Seleccione ...</option>
						@foreach ($Fondodepensiones as $fdp)
						<option data-tokens="{{$fdp->abreviatura}}" value="{{$fdp->id}}" data-subtext="{{$fdp->descripcion}}">
							{{$fdp->abreviatura}}
						</option>
						@endforeach
					</select>
				</div>
				<div class="form-group col-lg">
					<label for="personanatural.eps">{{'Eps *'}}</label>
					<select class="form-control selectpicker" id="personanatural.eps" data-live-search="true"
						name="eps_id">
						<option selected>Seleccione ...</option>
						@foreach ($Eps as $ep)
						<option data-tokens="{{$ep->abreviatura}}" value="{{$ep->id}}">
							{{$ep->abreviatura}}
						</option>
						@endforeach
					</select>
				</div>
				<div class="form-group col-lg">
					<label for="personanatural.grado">{{'Grado *'}}</label>
					<select class="form-control selectpicker" id="personanatural.grado" data-live-search="true"
						name="grado_id">
						<option selected>Seleccione ...</option>
						@foreach ($Grados as $g)
						<option data-tokens="{{$g->fuerza}} {{$g->abreviatura}} {{$g->descripcion}}" value="{{$g->id}}" data-subtext="{{$g->descripcion}}">
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
				<div class="form-group col-lg">
					<label for="telefonos">{{'Telefono(s) *'}}</label>
					<table id="tableTelefono" class="table">
						<thead>
							<tr>
								<th scope="col">Principal</th>
								<th scope="col">Prefijo</th>
								<th scope="col">Número</th>
								<th scope="col">Acción</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th scope="row">
									<div class="form-group clearfix">
										<div class="icheck-primary d-inline">
											<input type="radio" name="telefono_principal"
												id="telefono_radio1" value="tr1" checked="">
											<label for="telefono_radio1"></label>
										</div>
									</div>
								</th>
								<td>
									<input type="text" class="form-control" name="telefono_prefijo[]" />
								</td>
								<td>
									<input type="text" class="form-control" name="telefono_numero[]" />
									<input type="hidden" class="form-control" name="telefono_select[]" value="tr1"></td>
								</td>
								<td>
									<a id="deleteTel" class="btn btn-danger"><i class="fa fa-trash"></i></a>
								</td>
							</tr>
						</tbody>

					</table>
					<p>
						<a id="insertTel" class="btn btn-primary btn-block">{{'Insertar teléfono'}}</a>
					</p>
				</div>

				<div class="form-group col-lg">
					<label for="correos">{{'Correo(s) *'}}</label>
					<table id="tableCorreo" class="table">
						<thead>
							<tr>
								<th scope="col">Principal</th>
								<th scope="col">Dirección</th>
								<th scope="col">Acción</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th scope="row">
									<div class="form-group clearfix">
										<div class="icheck-primary d-inline">
											<input type="radio" name="correo_principal" id="correo_radio1" value="cr1" checked="">
											<label for="correo_radio1"></label>
										</div>
									</div>
								</th>
								<td>
									<input type="text" class="form-control" name="correo_electronico[]" />
									<input type="hidden" class="form-control" name="correo_select[]" value="cr1">
								</td>
								<td>
									<a id="deleteCorreo" class="btn btn-danger"><i class="fa fa-trash"></i></a>
								</td>
							</tr>
						</tbody>

					</table>
					<p>
						<a id="insertCorreo" class="btn btn-primary btn-block">{{'Insertar correo'}}</a>
					</p>
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