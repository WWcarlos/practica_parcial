@extends('layouts.app')

@section('content')
    <div class="row g-4">

        {{-- Bienvenida --}}
        <div class="col-12">
            <div class="card px-4 py-3"
                style="background: linear-gradient(135deg,#c0392b,#e74c3c); color:#fff; border-radius:16px;">
                <h4 class="mb-1">👋 Bienvenido, {{ auth()->user()->name }}</h4>
                <p class="mb-0 opacity-75">
                    Rol: <strong>{{ auth()->user()->role->name ?? 'Sin rol' }}</strong>
                    &nbsp;|&nbsp; {{ now()->format('l, d \d\e F \d\e Y') }}
                </p>
            </div>
        </div>

        {{-- Tarjetas de estadísticas visibles según rol --}}
        @php $user = auth()->user(); @endphp

        @if($user->isAdmin() || $user->isWaiter())
            <div class="col-sm-6 col-xl-3">
                <div class="card text-center py-4">
                    <div style="font-size:2.5rem;">🧾</div>
                    <h5 class="mt-2 mb-0">Órdenes hoy</h5>
                    <p class="fs-4 fw-bold text-danger mb-0">
                        {{ \App\Models\Order::whereDate('opened_at', today())->count() }}
                    </p>
                    <a href="{{ route('orders.index') }}" class="btn btn-outline-danger btn-sm mt-2 mx-4">Ver órdenes</a>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="card text-center py-4">
                    <div style="font-size:2.5rem;">🪑</div>
                    <h5 class="mt-2 mb-0">Mesas activas</h5>
                    <p class="fs-4 fw-bold text-danger mb-0">
                        {{ \App\Models\Table::count() }}
                    </p>
                    <a href="{{ route('tables.index') }}" class="btn btn-outline-danger btn-sm mt-2 mx-4">Ver mesas</a>
                </div>
            </div>
        @endif

        @if($user->isAdmin() || $user->isChef())
            <div class="col-sm-6 col-xl-3">
                <div class="card text-center py-4">
                    <div style="font-size:2.5rem;">🍽</div>
                    <h5 class="mt-2 mb-0">Platos</h5>
                    <p class="fs-4 fw-bold text-danger mb-0">
                        {{ \App\Models\Dish::count() }}
                    </p>
                    <a href="/dishes" class="btn btn-outline-danger btn-sm mt-2 mx-4">Ver platos</a>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="card text-center py-4">
                    <div style="font-size:2.5rem;">📋</div>
                    <h5 class="mt-2 mb-0">Menús</h5>
                    <p class="fs-4 fw-bold text-danger mb-0">
                        {{ \App\Models\Menu::count() }}
                    </p>
                    <a href="{{ route('menus.index') }}" class="btn btn-outline-danger btn-sm mt-2 mx-4">Ver menús</a>
                </div>
            </div>
        @endif

        @if($user->isAdmin())
            <div class="col-sm-6 col-xl-3">
                <div class="card text-center py-4">
                    <div style="font-size:2.5rem;">👥</div>
                    <h5 class="mt-2 mb-0">Usuarios</h5>
                    <p class="fs-4 fw-bold text-danger mb-0">
                        {{ \App\Models\User::count() }}
                    </p>
                    <a href="{{ route('users.index') }}" class="btn btn-outline-danger btn-sm mt-2 mx-4">Ver usuarios</a>
                </div>
            </div>

            {{-- Acceso rápido a reportes --}}
            <div class="col-12">
                <div class="card p-3">
                    <h5 class="mb-3"><i class="bi bi-bar-chart-fill text-danger me-2"></i>Reportes</h5>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('reports.orders') }}" class="btn btn-danger">
                            <i class="bi bi-file-earmark-pdf me-1"></i> Reporte de Órdenes
                        </a>
                        <a href="{{ route('reports.top_dishes') }}" class="btn btn-outline-danger">
                            <i class="bi bi-trophy-fill me-1"></i> Platos Más Vendidos
                        </a>
                    </div>
                </div>
            </div>
        @endif

        {{-- Panel Nutricional — visible para todos los roles --}}
        <div class="col-12">
            <div class="card p-3" style="border-left: 5px solid #27ae60;">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div class="d-flex align-items-center gap-3">
                        <span style="font-size:2rem;">🥗</span>
                        <div>
                            <h5 class="mb-0 fw-bold">Panel Nutricional</h5>
                            <small class="text-muted">Consulta gráficas nutricionales en tiempo real desde una API
                                externa</small>
                        </div>
                    </div>
                    <a href="{{ route('panel.nutricion') }}" class="btn btn-success px-4">
                        <i class="bi bi-graph-up-arrow me-1"></i> Ver Panel de Nutrición (API)
                    </a>
                </div>
            </div>
        </div>

    </div>
@endsection