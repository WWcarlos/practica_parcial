@extends('layouts.app')

@section('content')
<style>
@media print {
    .no-print { display: none !important; }
    .main-sidebar, .main-header, .main-footer, .content-header { display: none !important; }
    .content-wrapper { margin-left: 0 !important; background: #fff !important; }
    body { background: #fff !important; }
    .card { box-shadow: none !important; border: 1px solid #dee2e6 !important; }
    .bar-fill { print-color-adjust: exact; -webkit-print-color-adjust: exact; }
    table { font-size: 11px; }
}
</style>

<div class="d-flex justify-content-between align-items-center mb-3 no-print">
    <h4 class="mb-0"><i class="bi bi-trophy-fill text-warning me-2"></i>Platos Más Vendidos</h4>
    <div class="d-flex gap-2">
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm">← Volver</a>
        <button onclick="window.print()" class="btn btn-danger btn-sm">
            <i class="bi bi-printer-fill me-1"></i> Imprimir / Guardar PDF
        </button>
    </div>
</div>

{{-- Filtro --}}
<div class="card mb-4 no-print">
    <div class="card-body py-3">
        <form method="GET" action="{{ route('reports.top_dishes') }}" class="row g-2 align-items-end">
            <div class="col-auto">
                <label class="form-label fw-semibold mb-1">Desde</label>
                <input type="date" name="from" class="form-control form-control-sm" value="{{ $from }}">
            </div>
            <div class="col-auto">
                <label class="form-label fw-semibold mb-1">Hasta</label>
                <input type="date" name="to" class="form-control form-control-sm" value="{{ $to }}">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-danger btn-sm">
                    <i class="bi bi-funnel-fill me-1"></i>Filtrar
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Encabezado PDF --}}
<div class="text-center mb-4 d-none d-print-block">
    <h2>🍽 Dine Restaurant</h2>
    <h4>Reporte: Platos Más Vendidos (Top 20)</h4>
    <p class="text-muted">Período: {{ \Carbon\Carbon::parse($from)->format('d/m/Y') }} — {{ \Carbon\Carbon::parse($to)->format('d/m/Y') }}</p>
    <p class="text-muted">Generado el {{ now()->format('d/m/Y H:i') }} por {{ auth()->user()->name }}</p>
    <hr>
</div>

@php $maxOrders = $dishes->max('times_ordered') ?: 1; @endphp

@if($dishes->isEmpty())
    <div class="alert alert-warning">No hay datos de ventas en el período seleccionado.</div>
@else

{{-- Tabla con barras visuales --}}
<div class="card mb-4">
    <div class="card-header bg-white">
        <span class="fw-semibold">Top 20 platos — {{ $from }} al {{ $to }}</span>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped mb-0">
            <thead class="table-dark">
                <tr>
                    <th width="40">#</th>
                    <th>Plato</th>
                    <th>Categoría</th>
                    <th class="text-center">Pedidos</th>
                    <th width="200" class="no-print">Popularidad</th>
                    <th class="text-end">Precio unit.</th>
                    <th class="text-end">Ingresos</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dishes as $i => $dish)
                <tr>
                    <td>
                        @if($i === 0) 🥇
                        @elseif($i === 1) 🥈
                        @elseif($i === 2) 🥉
                        @else {{ $i + 1 }}
                        @endif
                    </td>
                    <td class="fw-semibold">{{ $dish->name }}</td>
                    <td><span class="badge bg-secondary">{{ $dish->category->name ?? 'Sin cat.' }}</span></td>
                    <td class="text-center fw-bold text-danger">{{ $dish->times_ordered }}</td>
                    <td class="no-print">
                        <div style="background:#f0f0f0; border-radius:6px; height:10px; overflow:hidden;">
                            <div class="bar-fill"
                                 style="width:{{ round($dish->times_ordered / $maxOrders * 100) }}%;
                                        height:100%;
                                        background: linear-gradient(90deg,#c0392b,#e74c3c);
                                        border-radius:6px;">
                            </div>
                        </div>
                        <small class="text-muted">{{ round($dish->times_ordered / $maxOrders * 100) }}%</small>
                    </td>
                    <td class="text-end">${{ number_format($dish->price, 2) }}</td>
                    <td class="text-end fw-semibold">
                        ${{ number_format($dishRevenue[$dish->id] ?? 0, 2) }}
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot class="table-light">
                <tr>
                    <td colspan="3" class="fw-bold text-end">TOTALES:</td>
                    <td class="fw-bold text-center text-danger">{{ $dishes->sum('times_ordered') }}</td>
                    <td class="no-print"></td>
                    <td></td>
                    <td class="fw-bold text-end text-danger">
                        ${{ number_format($dishes->sum(fn($d) => $dishRevenue[$d->id] ?? 0), 2) }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

{{-- Gráfica de barras simple (solo pantalla) --}}
<div class="card no-print">
    <div class="card-header bg-white fw-semibold">Gráfica de popularidad (Top 10)</div>
    <div class="card-body">
        @foreach($dishes->take(10) as $i => $dish)
        <div class="d-flex align-items-center mb-2">
            <div style="width:160px; font-size:.85rem; text-overflow:ellipsis; overflow:hidden; white-space:nowrap;"
                 title="{{ $dish->name }}">
                {{ $dish->name }}
            </div>
            <div class="flex-grow-1 mx-2" style="background:#f0f0f0; border-radius:6px; height:18px; overflow:hidden;">
                <div style="width:{{ round($dish->times_ordered / $maxOrders * 100) }}%;
                            height:100%;
                            background: linear-gradient(90deg,#c0392b,#e74c3c);
                            border-radius:6px;
                            transition: width .4s;">
                </div>
            </div>
            <div style="width:60px; text-align:right; font-weight:700; color:#c0392b;">
                {{ $dish->times_ordered }}
            </div>
        </div>
        @endforeach
    </div>
</div>

@endif
@endsection
