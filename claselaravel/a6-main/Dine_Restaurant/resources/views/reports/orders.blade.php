@extends('layouts.app')

@section('content')
{{-- Estilos de impresión --}}
<style>
@media print {
    .no-print { display: none !important; }
    .main-sidebar, .main-header, .main-footer, .content-header { display: none !important; }
    .content-wrapper { margin-left: 0 !important; background: #fff !important; }
    body { background: #fff !important; }
    .card { box-shadow: none !important; border: 1px solid #dee2e6 !important; }
    .report-title { color: #000 !important; }
    table { font-size: 11px; }
    .badge { border: 1px solid #999; color: #000 !important; background: #eee !important; }
}
</style>

<div class="d-flex justify-content-between align-items-center mb-3 no-print">
    <h4 class="mb-0"><i class="bi bi-receipt text-danger me-2"></i>Reporte de Órdenes</h4>
    <div class="d-flex gap-2">
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm">← Volver</a>
        <button onclick="window.print()" class="btn btn-danger btn-sm">
            <i class="bi bi-printer-fill me-1"></i> Imprimir / Guardar PDF
        </button>
    </div>
</div>

{{-- Filtro de fechas --}}
<div class="card mb-4 no-print">
    <div class="card-body py-3">
        <form method="GET" action="{{ route('reports.orders') }}" class="row g-2 align-items-end">
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

{{-- Encabezado del PDF (visible en impresión) --}}
<div class="text-center mb-4 d-none d-print-block">
    <h2 class="report-title">🍽 Dine Restaurant</h2>
    <h4>Reporte de Órdenes</h4>
    <p class="text-muted">Período: {{ \Carbon\Carbon::parse($from)->format('d/m/Y') }} — {{ \Carbon\Carbon::parse($to)->format('d/m/Y') }}</p>
    <p class="text-muted">Generado el {{ now()->format('d/m/Y H:i') }} por {{ auth()->user()->name }}</p>
    <hr>
</div>

{{-- Tarjetas de resumen --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="card text-center py-3">
            <div class="fs-3">🧾</div>
            <div class="fw-bold fs-5">{{ $orders->count() }}</div>
            <small class="text-muted">Total órdenes</small>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card text-center py-3">
            <div class="fs-3">✅</div>
            <div class="fw-bold fs-5">{{ $countByStatus->get('closed', 0) }}</div>
            <small class="text-muted">Cerradas</small>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card text-center py-3">
            <div class="fs-3">⏳</div>
            <div class="fw-bold fs-5">{{ $orders->whereIn('status', ['open','in_preparation','ready'])->count() }}</div>
            <small class="text-muted">En curso</small>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card text-center py-3" style="background:linear-gradient(135deg,#c0392b,#e74c3c);color:#fff;">
            <div class="fs-3">💰</div>
            <div class="fw-bold fs-5">${{ number_format($totalRevenue, 2) }}</div>
            <small style="opacity:.85">Ingresos totales</small>
        </div>
    </div>
</div>

{{-- Tabla de órdenes --}}
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <span class="fw-semibold">Detalle de órdenes — {{ $from }} al {{ $to }}</span>
        <span class="badge bg-secondary">{{ $orders->count() }} registros</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Mesa</th>
                        <th>Mozo</th>
                        <th>Estado</th>
                        <th>Método pago</th>
                        <th>Apertura</th>
                        <th>Cierre</th>
                        <th class="text-end">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->table->number ?? 'N/A' }}</td>
                        <td>{{ $order->user->name ?? 'N/A' }}</td>
                        <td>
                            @php
                                $colors = [
                                    'open'           => 'primary',
                                    'in_preparation' => 'warning',
                                    'ready'          => 'info',
                                    'closed'         => 'success',
                                ];
                                $labels = [
                                    'open'           => 'Abierta',
                                    'in_preparation' => 'En preparación',
                                    'ready'          => 'Lista',
                                    'closed'         => 'Cerrada',
                                ];
                            @endphp
                            <span class="badge bg-{{ $colors[$order->status] ?? 'secondary' }}">
                                {{ $labels[$order->status] ?? $order->status }}
                            </span>
                        </td>
                        <td>{{ $order->payMethod->name ?? '—' }}</td>
                        <td>{{ \Carbon\Carbon::parse($order->opened_at)->format('d/m/Y H:i') }}</td>
                        <td>{{ $order->closed_at ? \Carbon\Carbon::parse($order->closed_at)->format('d/m/Y H:i') : '—' }}</td>
                        <td class="text-end fw-semibold">${{ number_format($order->total, 2) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">No hay órdenes en este período.</td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <td colspan="7" class="fw-bold text-end">TOTAL INGRESOS (cerradas):</td>
                        <td class="fw-bold text-end text-danger">${{ number_format($totalRevenue, 2) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<script>
// Auto-abre el diálogo de impresión cuando se accede con ?print=1
if (new URLSearchParams(window.location.search).get('print') === '1') {
    window.onload = () => window.print();
}
</script>
@endsection