<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
        <span class="brand-text font-weight-light">
            <center>{{config('app.name')}}</center>
        </span>
    </a>

    <!-- Sidebar User-->
    <div class="mt-2 user-panel">
        <!-- Sidebar user (optional) -->
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-item has-treeview nav-compact">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-user"></i>
                    <p>
                        {{ Auth::user()->name }}
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>

        </ul>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-compact" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-header">CLIENTES</li>
            
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                        {{'Persona natural'}}
                    </p>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                        {{'Persona jurica'}}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                        {{'Contrato'}}
                    </p>
                </a>
            </li>

            <li class="nav-header">PROCESOS</li>

            <li class="nav-item">
                <a href="{{ route ('proceso.index')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                        {{'Proceso'}}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route ('estado.index')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                        {{'Estado del proceso'}}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route ('fondodepension.index')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                        {{'Fondo de pensión'}}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route ('tipodocumento.index')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                        {{'Tipo de documento'}}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route ('eps.index')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                        {{'Eps'}}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route ('fuerza.index')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                        {{'Fuerza'}}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route ('expedicion.index')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                        {{'Expedición'}}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route ('tipocontrato.index')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                        {{'Tipo de contrato'}}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route ('tipodocumentoidentificacion.index')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                        {{'Documento de identificación'}}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route ('tipodemanda.index')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                        {{'Tipo de demanda'}}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route ('corporacion.index')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                        {{'Corporación'}}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route ('ponente.index')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                        {{'Ponente'}}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route ('ciudadproceso.index')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                        {{'Ciudad de proceso'}}
                    </p>
                </a>
            </li>

            <li class="nav-header">REPORTES</li>

            <!--
            <li class="nav-item has-treeview menu-open nav-compact">
                <a href="#" class="nav-link active">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        Extras
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="../examples/login.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Login</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../examples/register.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Register</p>
                        </a>
                    </li>

                </ul>
            </li>
            
            <li class="nav-item has-treeview nav-compact">
                <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                        Estados
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="../../adminlte/index.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Dashboard v1</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../../adminlte/index2.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Dashboard v2</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../../adminlte/index3.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Dashboard v3</p>
                        </a>
                    </li>
                </ul>
            </li>
            
            <li class="nav-item nav-compact">
                <a href="../widgets.html" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Widgets
                        <span class="right badge badge-danger">New</span>
                    </p>
                </a>
            </li>

            <li class="nav-item has-treeview nav-compact">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        Layout Options
                        <i class="fas fa-angle-left right"></i>
                        <span class="badge badge-info right">6</span>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="../layout/top-nav.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Top Navigation</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../layout/top-nav-sidebar.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Top Navigation + Sidebar</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../layout/boxed.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Boxed</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../layout/fixed-sidebar.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Fixed Sidebar</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../layout/fixed-topnav.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Fixed Navbar</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../layout/fixed-footer.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Fixed Footer</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../layout/collapsed-sidebar.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Collapsed Sidebar</p>
                        </a>
                    </li>
                </ul>
            </li>
            -->

        </ul>
    </nav>
    <!-- /.sidebar-menu -->

    <!-- /.sidebar -->
</aside>