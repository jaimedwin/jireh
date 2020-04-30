<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
	<!-- Left navbar links -->
	@can('use-app-user')
	<ul class="navbar-nav">
		
		<li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
		</li>
		
		<li class="nav-item d-none d-sm-inline-block">
			<a href="{{route('admin')}}" class="nav-link">Principal</a>
		</li>
	</ul>
	@endcan

	<!-- Right navbar links -->
	<ul class="navbar-nav ml-auto">
		<li class="nav-item dropdown">
			<a class="nav-link" data-toggle="dropdown" href="#">
				<i class="fas fa-user-circle nav-icon"> {{ Auth::user()->name }} </i>

			</a>
			<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

				@can('use-app-user')
				<a href="{{route('edit_profile', Auth::id())}}" class="dropdown-item">
					<i class="fas fa-user-edit mr-2"></i>{{'Editar información del usuario'}}
				</a>
				
				<a href="{{ route('validate_email')}}" class="dropdown-item">
					<i class="fas fa-user-lock mr-2"></i> {{'Cambiar contraseña'}}
				</a>
				@endcan
				@can('use-app-admin')
				<a class="dropdown-item" href="{{ route('user.index') }}">
					<i class="fas fa-users-cog mr-2"></i> {{'Administrador de usuarios'}}
				</a>
				@endcan
				
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
        			document.getElementById('logout-form').submit();">
					<i class="nav-icon fas fa-sign-out-alt mr-2"></i>{{('Cerrar sesión')}}
				</a>
				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
					@csrf
				</form>
			</div>
		</li>
	</ul>
</nav>
<!-- /.navbar -->