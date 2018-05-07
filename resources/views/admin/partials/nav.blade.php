<ul class="sidebar-menu" data-widget="tree">
    <li class="header">Navegador</li>
    <!-- Optionally, you can add icons to the links -->
    <li {{ request()->is('admin') ? 'class=active' : '' }}>
        <a href="{{ route('admin') }}">
            <i class="fa fa-dashboard"></i> <span>Inicio</span>
        </a>
    </li>

    <li class="treeview {{ request()->is('aulas/*') ? 'active' : '' }}">
        <a href="#"><i class="fa fa-university"></i> <span>Aulas</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
        </a>
        <ul class="treeview-menu">
            <li {{ request()->is('aulas/listar') ? 'class=active' : '' }}>
                <a href="{{ route('aulas.listar') }}">
                    <i class="fa fa-list-ul"></i>
                    Ver listado de aulas
                </a>
            </li>
        </ul>
    </li>

    <li class="treeview {{ request()->is('profesores/*') ? 'active' : '' }}">
        <a href="#"><i class="fa fa-users"></i> <span>Profesores</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
        </a>
        <ul class="treeview-menu">
            <li {{ request()->is('profesores/listar') ? 'class=active' : '' }}>
                <a href="{{ route('profesores.listar') }}">
                    <i class="fa fa-list-ul"></i>
                    Ver listado de profesores
                </a>
            </li>
        </ul>
    </li>

    <li class="treeview {{ request()->is('reservas/*') ? 'active' : '' }}">
        <a href="#"><i class="fa fa-calendar"></i> <span>Reservas</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
        </a>
        <ul class="treeview-menu">
            <li {{ request()->is('reservas/listar') ? 'class=active' : '' }}>
                <a href="{{ route('reservas.listar') }}">
                    <i class="fa fa-list-ul"></i>
                    Ver reservas
                </a>
            </li>
        </ul>
    </li>

    <li class="header">Configuración</li>
    <li {{ request()->is('importar-xml') ? 'class=active' : '' }}>
        <a href="{{ route('importarXML') }}">
            <i class="fa fa-folder-open"></i> <span>Importar XML</span>
        </a>
    </li>
</ul>