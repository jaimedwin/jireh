@extends('admin.index')

@section('entidad', 'Principal')

@section('content')
<section class="content">
	<div class="container-fluid">
		<!-- Info boxes -->
		<div class="row">
			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box">
					<span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

					<div class="info-box-content">
						<span class="info-box-text">CPU</span>
						<span class="info-box-number">{{$cpu}}</span>
					</div>
					<!-- /.info-box-content -->
				</div>
				<!-- /.info-box -->
			</div>
			<!-- /.col -->
			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box mb-3">
					<span class="info-box-icon bg-danger elevation-1"><i class="fas fa-memory"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Memoria</span>
						<span class="info-box-number">{{$mem}}</span>
					</div>
					<!-- /.info-box-content -->
				</div>
				<!-- /.info-box -->
			</div>
			<!-- /.col -->
			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box mb-3">
					<span class="info-box-icon bg-success elevation-1"><i class="fas fa-hdd"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Disco duro disponible</span>
						<span class="info-box-number">{{$dfg}}</span>
					</div>
					<!-- /.info-box-content -->
				</div>
				<!-- /.info-box -->
			</div>
			<!-- /.col -->
			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box mb-3">
					<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-bell"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Recordatorios por semana</span>
						<span class="info-box-number">{{$rec}}</span>
					</div>
					<!-- /.info-box-content -->
				</div>
				<!-- /.info-box -->
			</div>
			<!-- /.col -->
		</div>
	</div>


	<div class="container-fluid">
		<div class="card card-secondary">
			<div class="card-header">
				<h3 class="card-title">{{'Recordatorio de los últimos 30 días'}}</h3>
				<div class="card-tools"></div>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<div class="row">
					<div class="col-12 table-responsive">
						<table class="table table-bordered table-striped">
							<thead class="">
								<tr>
									<th style="width: 10px">{{'#'}}</th>
									<th style="width: 200px">{{'Fecha'}}</th>
									<th>{{'Observación'}}</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($Recordatorios as $rec)
								<tr>
									<td>{{$loop->iteration}}</td>
									<td>{{$rec->fecha}}</td>
									<td>{{$rec->observacion}}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

</section>



@endsection