@extends('layouts.app')

@section('content')
<div class="row g-4">

    {{-- Encabezado --}}
    <div class="col-12">
        <div class="card px-4 py-3" style="background: linear-gradient(135deg,#1a6b3c,#27ae60); color:#fff; border-radius:16px;">
            <div class="d-flex align-items-center gap-3">
                <span style="font-size:2.5rem;">🥗</span>
                <div>
                    <h4 class="mb-1 fw-bold">Panel Nutricional — API Externa</h4>
                    <p class="mb-0 opacity-75">Datos obtenidos en tiempo real desde la API de nutrición</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Gráfico de Barras --}}
    <div class="col-12 col-lg-6">
        <div class="card p-4">
            <h5 class="mb-3">
                <i class="bi bi-bar-chart-fill text-success me-2"></i>
                Comparativa Nutricional (Barras)
            </h5>
            <div id="grafico-barras" style="min-height:350px;"></div>
        </div>
    </div>

    {{-- Gráfico de Torta --}}
    <div class="col-12 col-lg-6">
        <div class="card p-4">
            <h5 class="mb-3">
                <i class="bi bi-pie-chart-fill text-success me-2"></i>
                Distribución Nutricional (Torta)
            </h5>
            <div id="grafico-torta" style="min-height:350px;"></div>
        </div>
    </div>

    {{-- Botón volver --}}
    <div class="col-12">
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Volver al Dashboard
        </a>
    </div>

</div>
@endsection

@section('scripts')
<script src="https://cdn.plot.ly/plotly-2.24.1.min.js" charset="utf-8"></script>
<script>
    // Endpoint del proxy Laravel — evita CORS al consumir Fruityvice
    window.FRUITS_ENDPOINT = "{{ route('api.fruits') }}";
</script>
<script src="{{ asset('js/externalAPI.js') }}"></script>
@endsection
