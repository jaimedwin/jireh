<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
        <span class="brand-text font-weight-light">
            <center>{{config('app.name')}}</center>
        </span>
    </a>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-compact nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-header">CLIENTES</li>
            
            <li class="nav-item has-treeview menu-open nav-compact">
                <a href="#" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                        Personas
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route ('personanatural.index')}}" class="nav-link">
                            <i class="fas fa-male nav-icon"></i>
                            <p>
                                {{'Persona natural'}}
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
                        <a href="{{ route ('eps.index')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>
                                {{'Eps'}}
                            </p>
                        </a>
                    </li>
        
                    <li class="nav-item">
                        <a href="{{ route ('fuerza.index')}}" class="nav-link">
                            <i class="fas fa-shield-alt nav-icon"></i>
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
                        <a href="{{ route ('tipodocumentoidentificacion.index')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>
                                {{'Documento de identificación'}}
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route ('personajuridica.index')}}" class="nav-link">
                            <i class="fas fa-industry nav-icon"></i>
                            <p>
                                {{'Persona jurica'}}
                            </p>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="nav-item has-treeview nav-compact">
                <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                        Contratos
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route ('contrato.index')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>
                                {{'Contrato'}}
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
                </ul>
            </li>

            

            <li class="nav-item has-treeview nav-compact">
                <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                        Archivos
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route ('documento.index')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>
                                {{'Documento'}}
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
                </ul>
            </li>

            

            <li class="nav-header">PROCESOS</li>

            <li class="nav-item">
                <a href="{{ route ('proceso.index')}}" class="nav-link">
                    <i class="fas fa-cog nav-icon"></i>
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

            <li class="nav-header">CLIENTES Y PROCESOS</li>

            <li class="nav-item">
                <a href="{{ route ('clienteproceso.index')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                        {{'Persona natural y proceso'}}
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
            
            <li class="nav-header">MANTENIMIENTO</li>

            <li class="nav-item">
                <a href="{{route ('copiadb.index')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                        {{'Copia de la base de datos'}}
                    </p>
                </a>
            </li>
            
        </ul>
    </nav>
    <!-- /.sidebar-menu -->

    <!-- /.sidebar -->
</aside>