@include('partials.header')

<h2>Detalle Orden</h2>

<div class="card">
    <div class="card-body">
        <p><strong>Mesa:</strong> {{ $order->table->number }}</p>
        <p><strong>Usuario:</strong> {{ $order->user->name }}</p>
        <p><strong>Método de Pago:</strong> {{ $order->payMethod->name ?? 'N/A' }}</p>
        <p><strong>Estado:</strong> {{ $order->status }}</p>
        <p><strong>Total:</strong> ${{ $order->total }}</p>
        <p><strong>Abierta:</strong> {{ $order->opened_at }}</p>
        <p><strong>Cerrada:</strong> {{ $order->closed_at ?? '—' }}</p>
    </div>
</div>

<a href="/orders" class="btn btn-secondary mt-3">Volver</a>

@include('partials.footer')
