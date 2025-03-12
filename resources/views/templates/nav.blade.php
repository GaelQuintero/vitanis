<nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark border-bottom border-body" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('inicio') }}">Vitanis Inventory</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('dashboard') }}">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('inicio') }}">Graficas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('inventario.index') }}">Inventario</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('categoria.index') }}">Categorias</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('movimientos.index') }}">Movimientos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('usuarios.index') }}">Usuario</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('notificaciones.index') }}">
                        🛎️ Notificaciones <span
                            class="badge bg-danger">{{ auth()->user()->unreadNotifications->count() }}</span>
                    </a>
                </li>
              
                 
            </ul>
               <!-- Authentication -->
               <form method="POST" class="pt-2 d-flex" action="{{ route('logout') }}">
                @csrf

                <button class="nav-link text-danger" href="route('logout')"
                    onclick="event.preventDefault();
                        this.closest('form').submit();">
                    {{ __('Cerrar sesión') }}
            </button>
            </form>
      
        </div>
    </div>
</nav>
