<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
	<!-- Left navbar links -->
	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
		</li>
		<li class="nav-item d-none d-sm-inline-block">
			<a href="{{route('admin')}}" class="nav-link">Principal</a>
		</li>
	</ul>

	<!-- SEARCH FORM 
  <form class="form-inline ml-3">
    <div class="input-group input-group-sm">
      <input class="form-control form-control-navbar" type="search" placeholder="Buscar" aria-label="Buscar">
      <div class="input-group-append">
        <button class="btn btn-navbar" type="submit">
          <i class="fas fa-search"></i>
        </button>
      </div>
    </div>
  </form>
  -->

	<!-- Right navbar links -->
	<ul class="navbar-nav ml-auto">



		<li class="nav-item dropdown">
			<a class="nav-link" data-toggle="dropdown" href="#">
				<i class="fas fa-user-circle nav-icon"> {{ Auth::user()->name }} </i>

			</a>
			<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
				<!--
				<a href="#" class="dropdown-item">
					<i class="fas fa-envelope mr-2"></i> 4 new messages
					<span class="float-right text-muted text-sm">3 mins</span>
				</a>
				-->

				@can('use-app')
				<a href="{{route('edit_profile', Auth::id())}}" class="dropdown-item">
					<i class="fas fa-user-edit mr-2"></i>{{'Editar información del usuario'}}
				</a>
				
				<a href="{{ route('validate_email')}}" class="dropdown-item">
					<i class="fas fa-user-lock mr-2"></i> {{'Cambiar contraseña'}}
				</a>
				@endcan
				@can('manager-users')
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

		<!-- Notifications Dropdown Menu 
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge">15</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">15 Notifications</span>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-envelope mr-2"></i> 4 new messages
          <span class="float-right text-muted text-sm">3 mins</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-users mr-2"></i> 8 friend requests
          <span class="float-right text-muted text-sm">12 hours</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-file mr-2"></i> 3 new reports
          <span class="float-right text-muted text-sm">2 days</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
      </div>
    </li>
    
    <li class="nav-item">
      <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
        <i class="fas fa-th-large"></i>
      </a>
    </li>
    -->
	</ul>
</nav>
<!-- /.navbar -->