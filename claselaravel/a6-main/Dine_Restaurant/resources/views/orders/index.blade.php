@include('partials.header')

<div class="d-flex justify-content-between mb-3">
    <h2>Órdenes</h2>
    <a href="/orders/create" class="btn btn-primary">+ Crear</a>
</div>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Mesa</th>
            <th>Usuario</th>
            <th>Pago</th>
            <th>Estado</th>
            <th>Total</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        @foreach($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->table->number ?? 'N/A' }}</td>
            <td>{{ $order->user->name ?? 'N/A' }}</td>
            <td>{{ $order->payMethod->name ?? 'N/A' }}</td>
            <td>
                <span class="badge bg-info">{{ $order->status }}</span>
            </td>
            <td>${{ $order->total }}</td>
            <td>
                <a href="/orders/{{ $order->id }}" class="btn btn-info btn-sm">Ver</a>
                <a href="/orders/{{ $order->id }}/edit" class="btn btn-warning btn-sm">Editar</a>

                <form action="/orders/{{ $order->id }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@include('partials.footer')
