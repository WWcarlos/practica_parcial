@php
    // Compatibilidad: redirige al login si no está autenticado
    if (!auth()->check()) {
        header('Location: /login');
        exit;
    }
@endphp
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dine Restaurant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .navbar-custom { background: linear-gradient(90deg,#111827,#1f2937); padding:14px 0; }
        .navbar-brand { font-size:1.7rem; font-weight:700; letter-spacing:1px; }
        .navbar-custom .nav-link { color:#fff!important; font-size:1.05rem; font-weight:500; margin-left:8px; padding:7px 12px!important; border-radius:8px; transition:all .25s; }
        .navbar-custom .nav-link:hover { background:rgba(255,255,255,.12); }
        body { background-color:#f8f9fa; }
        .container-main { max-width:1200px; margin:2rem auto; padding:0 1rem; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom shadow">
    <div class="container">
        <a class="navbar-brand text-white" href="/dashboard">🍽 Dine</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menuNav">
            <ul class="navbar-nav ms-auto align-items-center">

                @if(auth()->user()->isAdmin() || auth()->user()->isWaiter())
                <li class="nav-item"><a class="nav-link" href="/orders"><i class="bi bi-receipt-cutoff me-1"></i>Órdenes</a></li>
                <li class="nav-item"><a class="nav-link" href="/tables"><i class="bi bi-grid-3x3-gap-fill me-1"></i>Mesas</a></li>
                @endif

                @if(auth()->user()->isAdmin() || auth()->user()->isChef())
                <li class="nav-item"><a class="nav-link" href="/categories"><i class="bi bi-tags-fill me-1"></i>Categorías</a></li>
                <li class="nav-item"><a class="nav-link" href="/dishes"><i class="bi bi-cup-hot-fill me-1"></i>Platos</a></li>
                <li class="nav-item"><a class="nav-link" href="/menus"><i class="bi bi-journal-text me-1"></i>Menús</a></li>
                @endif

                @if(auth()->user()->isAdmin())
                <li class="nav-item"><a class="nav-link" href="/users"><i class="bi bi-people-fill me-1"></i>Usuarios</a></li>
                <li class="nav-item"><a class="nav-link" href="/roles"><i class="bi bi-shield-lock-fill me-1"></i>Roles</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><i class="bi bi-bar-chart-fill me-1"></i>Reportes</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/reports/orders">Reporte de Órdenes</a></li>
                        <li><a class="dropdown-item" href="/reports/top-dishes">Platos Más Vendidos</a></li>
                    </ul>
                </li>
                @endif

                <li class="nav-item ms-2">
                    <span class="nav-link text-warning fw-semibold">
                        👤 {{ auth()->user()->name }}
                        <span class="badge rounded-pill ms-1" style="background:#e74c3c;font-size:.7rem;">
                            {{ auth()->user()->role->name ?? '' }}
                        </span>
                    </span>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-outline-light btn-sm rounded-pill ms-2">
                            <i class="bi bi-box-arrow-right me-1"></i>Salir
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-main">
