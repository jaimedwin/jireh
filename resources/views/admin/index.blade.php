<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>{{ config('app.name') }}</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{url('/')}}/adminlte/plugins/fontawesome-free/css/all.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- iCheck for checkboxes and radio inputs -->
	<link rel="stylesheet" href="{{url('/')}}/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="{{ url('/') }}/adminlte/dist/css/adminlte.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

	<link rel="stylesheet"
		href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
</head>

<body class="hold-transition sidebar-mini text-sm">
	<!-- Site wrapper -->
	<div class="wrapper">

		@include('admin.navbar')
		@include('admin.menu')

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1>@yield('entidad')</h1>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>

			<!-- Main content -->
			<section class="content">

				@yield('content')



			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

		@include('admin.footer')


		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>
		<!-- /.control-sidebar -->
	</div>
	<!-- ./wrapper -->

	<!-- jQuery -->
	<script src="{{ url('/') }}/adminlte/plugins/jquery/jquery.min.js"></script>
	<!--  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script> -->

	<!-- Bootstrap 4 bundle -->
	<script src="{{ url('/') }}/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- Latest compiled and JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.12/js/bootstrap-select.min.js"></script>
	<!-- AdminLTE App -->
	<script src="{{ url('/') }}/adminlte/dist/js/adminlte.min.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="{{ url('/') }}/adminlte/dist/js/demo.js"></script>
	<script src="{{ url('/') }}/js/closealert.js"></script>
	<script src="{{ url('/') }}/js/correo_telefono.js"></script>
	<script src="{{ url('/') }}/js/hidenoptionfile.js"></script>

</body>

</html>