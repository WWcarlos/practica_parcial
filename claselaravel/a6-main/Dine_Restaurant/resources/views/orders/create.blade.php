@include('partials.header')

<h2>Crear Orden</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="/orders" method="POST" class="form-validable">
    @csrf

    <div class="mb-3">
        <label>Mesa</label>
        <select name="table_id" class="form-control" required>
            <option value="">— Seleccionar —</option>
            @foreach($tables as $table)
                <option value="{{ $table->id }}">{{ $table->number }}</option>
            @endforeach
        </select>
        <span class="text-danger error-msg" id="error-table_id"></span>
    </div>

    <div class="mb-3">
        <label>Usuario</label>
        <select name="user_id" class="form-control" required>
            <option value="">— Seleccionar —</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
        <span class="text-danger error-msg" id="error-user_id"></span>
    </div>

    <div class="mb-3">
        <label>Método de Pago</label>
        <select name="pay_method_id" class="form-control" required>
            <option value="">Seleccione</option>
            @foreach($payMethods as $pay)
                <option value="{{ $pay->id }}">{{ $pay->name }}</option>
            @endforeach
        </select>
        <span class="text-danger error-msg" id="error-pay_method_id"></span>
    </div>

    <div class="mb-3">
        <label>Estado</label>
        <select name="status" class="form-control">
            <option value="open">Abierta</option>
            <option value="in_preparation">En preparación</option>
            <option value="ready">Lista</option>
            <option value="closed">Cerrada</option>
        </select>
        <span class="text-danger error-msg" id="error-status"></span>
    </div>

    <div class="mb-3">
        <label>Total</label>
        <input type="number" step="0.01" min="0" name="total" class="form-control" required>
        <span class="text-danger error-msg" id="error-total"></span>
    </div>

    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="/orders" class="btn btn-secondary">Cancelar</a>
</form>

@include('partials.footer')
