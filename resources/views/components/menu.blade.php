<li class="nav-header">Menu</li>
<li class="nav-item">
    <a href="{{url('home')}}" class="nav-link">
        <i class="nav-icon fa fa-home"></i>
        <p>Inicio</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{url('entrada')}}" class="nav-link">
        <i class="nav-icon fa fa-arrow-up"></i>
        <p>Registrar Entrada</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{url('salida')}}" class="nav-link">
        <i class="nav-icon fa fa-arrow-down"></i>
        <p>Registrar Salida</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{url('ver-entradas')}}" class="nav-link">
        <i class="nav-icon fa fa-list-ul"></i>
        <p>Ver Entrada</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{url('ver-salidas')}}" class="nav-link">
        <i class="nav-icon fa fa-list-ul"></i>
        <p>Ver Salida</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{url('balance')}}" class="nav-link">
        <i class="nav-icon fa fa-balance-scale"></i>
        <p>Mostrar balance</p>
    </a>
</li>
<li class=" nav-item">
    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
        <p>
            <i class="nav-icon fa fa-power-off"></i><span class="menu-title text-truncate">Cerrar Sesión</span>
        </p>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </a>
</li>