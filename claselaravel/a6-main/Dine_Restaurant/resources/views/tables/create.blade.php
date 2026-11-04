@include('partials.header')

<h2>Crear Mesa</h2>

<form action="/tables" method="POST" class="form-validable">
    @csrf

    <div class="mb-3">
        <label>Número</label>
        <input type="number" min="0" name="number" class="form-control" required>
        <span class="text-danger error-msg" id="error-number"></span>
    </div>

    <div class="mb-3">
        <label>Capacidad</label>
        <input type="number" min="0" name="capacity" class="form-control" required>
        <span class="text-danger error-msg" id="error-capacity"></span>
    </div>

    <div class="mb-3">
        <label>Estado</label>
        <input type="text" name="status" class="form-control" required>
        <span class="text-danger error-msg" id="error-status"></span>
    </div>

    <div class="mb-3">
        <label>Mesero</label>
        <select name="waiter_id" class="form-control">
            <option value="">Sin asignar</option>
            @foreach($waiters as $waiter)
                <option value="{{ $waiter->id }}">{{ $waiter->name }}</option>
            @endforeach
        </select>
        <span class="text-danger error-msg" id="error-waiter_id"></span>
    </div>

    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="/tables" class="btn btn-secondary">Cancelar</a>
</form>

@include('partials.footer')
