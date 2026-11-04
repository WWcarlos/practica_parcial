{{-- layouts/sidebar.blade.php --}}
<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="{{ route('dashboard') }}" class="brand-link text-center">
        <span class="brand-text fw-bold fs-4">🍽 Dine</span>
    </a>

    <div class="sidebar pt-3">

        @auth
        <div class="px-3 pb-3 text-center">
            <div class="text-white fw-semibold">{{ auth()->user()->name }}</div>
            <span class="badge rounded-pill mt-1" style="background:#e74c3c; font-size:.75rem;">
                {{ auth()->user()->role->name ?? 'Sin rol' }}
            </span>
        </div>
        @endauth

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview">

                {{-- Dashboard (todos) --}}
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer2"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{-- Administrador + Waiter --}}
                @if(auth()->user()->isAdmin() || auth()->user()->isWaiter())
                <li class="nav-item">
                    <a href="{{ route('orders.index') }}" class="nav-link {{ request()->is('orders*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-receipt-cutoff"></i>
                        <p>Órdenes</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('tables.index') }}" class="nav-link {{ request()->is('tables*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-grid-3x3-gap-fill"></i>
                        <p>Mesas</p>
                    </a>
                </li>
                @endif

                {{-- Administrador + Chef --}}
                @if(auth()->user()->isAdmin() || auth()->user()->isChef())
                <li class="nav-item">
                    <a href="{{ route('categories.index') }}" class="nav-link {{ request()->is('categories*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-tags-fill"></i>
                        <p>Categorías</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dishes.index') }}" class="nav-link {{ request()->is('dishes*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-cup-hot-fill"></i>
                        <p>Platos</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('menus.index') }}" class="nav-link {{ request()->is('menus*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-journal-text"></i>
                        <p>Menús</p>
                    </a>
                </li>
                @endif

                {{-- Solo Administrador --}}
                @if(auth()->user()->isAdmin())
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link {{ request()->is('users*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-people-fill"></i>
                        <p>Usuarios</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('roles.index') }}" class="nav-link {{ request()->is('roles*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-shield-lock-fill"></i>
                        <p>Roles</p>
                    </a>
                </li>
                                <li class="nav-item">
                    <a href="http://localhost:5173"
                    target="_blank"
                    class="nav-link">

                        <i class="nav-icon bi bi-code-slash"></i>
                        <p>Frontend React</p>

                    </a>
                </li>

                {{-- Reportes --}}
                <li class="nav-item has-treeview {{ request()->is('reports*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('reports*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-bar-chart-fill"></i>
                        <p>Reportes <i class="right bi bi-chevron-right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('reports.orders') }}" class="nav-link ps-4 {{ request()->is('reports/orders') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-receipt"></i>
                                <p>Órdenes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('reports.top_dishes') }}" class="nav-link ps-4 {{ request()->is('reports/top-dishes') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-trophy-fill"></i>
                                <p>Platos Top</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

            </ul>
        </nav>

    </div>

</aside>