@include('partials.header')

<h2>Editar Orden</h2>

<form action="/orders/{{ $order->id }}" method="POST" class="form-validable">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Mesa</label>
        <select name="table_id" class="form-control" required>
            <option value="">— Seleccionar —</option>
            @foreach($tables as $table)
                <option value="{{ $table->id }}" {{ $order->table_id == $table->id ? 'selected' : '' }}>
                    {{ $table->number }}
                </option>
            @endforeach
        </select>
        <span class="text-danger error-msg" id="error-table_id"></span>
    </div>

    <div class="mb-3">
        <label>Usuario</label>
        <select name="user_id" class="form-control" required>
            <option value="">— Seleccionar —</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ $order->user_id == $user->id ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>
        <span class="text-danger error-msg" id="error-user_id"></span>
    </div>

    <div class="mb-3">
        <label>Método de Pago</label>
        <select name="pay_method_id" class="form-control" required>
            <option value="">Seleccione</option>
            @foreach($payMethods as $pay)
                <option value="{{ $pay->id }}" {{ $order->pay_method_id == $pay->id ? 'selected' : '' }}>
                    {{ $pay->name }}
                </option>
            @endforeach
        </select>
        <span class="text-danger error-msg" id="error-pay_method_id"></span>
    </div>

    <div class="mb-3">
        <label>Estado</label>
        <select name="status" class="form-control">
            <option value="open"           {{ $order->status == 'open'           ? 'selected' : '' }}>Abierta</option>
            <option value="in_preparation" {{ $order->status == 'in_preparation' ? 'selected' : '' }}>En preparación</option>
            <option value="ready"          {{ $order->status == 'ready'          ? 'selected' : '' }}>Lista</option>
            <option value="closed"         {{ $order->status == 'closed'         ? 'selected' : '' }}>Cerrada</option>
        </select>
        <span class="text-danger error-msg" id="error-status"></span>
    </div>

    <div class="mb-3">
        <label>Total</label>
        <input type="number" step="0.01" min="0" name="total" class="form-control" value="{{ $order->total }}" required>
        <span class="text-danger error-msg" id="error-total"></span>
    </div>

    <button type="submit" class="btn btn-primary">Actualizar</button>
    <a href="/orders" class="btn btn-secondary">Cancelar</a>
</form>

@include('partials.footer')
