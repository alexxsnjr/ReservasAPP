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
            <li {{ request()->is('aulas/importar-xml') ? 'class=active' : '' }}>
                <a href="{{ route('aulas.importarXML') }}">
                    <i class="fa fa-folder-open"></i>
                    Cargar XML
                </a>
            </li>
        </ul>
    </li>
</ul>