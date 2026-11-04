{{-- layouts/navbar.blade.php --}}
<nav class="main-header navbar navbar-expand navbar-white navbar-light shadow-sm">

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link fs-4" data-widget="pushmenu" href="#" role="button">☰</a>
        </li>
    </ul>

    <ul class="navbar-nav ms-auto align-items-center pe-3">

        {{-- Nombre y rol del usuario --}}
        @auth
            <li class="nav-item me-3 d-none d-sm-flex align-items-center">
                <span class="fw-semibold me-1">👤 {{ auth()->user()->name }}</span>
                <span class="badge rounded-pill ms-1" style="background:#e74c3c; font-size:.75rem;">
                    {{ auth()->user()->role->name ?? '' }}
                </span>
            </li>

            {{-- Reportes (solo Admin y Waiter) --}}
            @if(auth()->user()->isAdmin())
                <li class="nav-item dropdown me-2">
                    <a class="nav-link fw-semibold dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-bar-chart-fill"></i> Reportes
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow">
                        <li>
                            <a class="dropdown-item" href="{{ route('reports.orders') }}">
                                <i class="bi bi-receipt me-2 text-danger"></i>Reporte de Órdenes
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('reports.top_dishes') }}">
                                <i class="bi bi-trophy-fill me-2 text-warning"></i>Platos Más Vendidos
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            {{-- Logout --}}
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3">
                        <i class="bi bi-box-arrow-right me-1"></i>Salir
                    </button>
                </form>
            </li>
        @endauth

    </ul>

</nav>