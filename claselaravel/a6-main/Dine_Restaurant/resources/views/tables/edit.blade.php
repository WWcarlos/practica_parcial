@include('partials.header')

<h2>Editar Mesa</h2>

<form action="/tables/{{ $table->id }}" method="POST" class="form-validable">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Número</label>
        <input type="number" min="0" name="number" class="form-control" value="{{ $table->number }}" required>
        <span class="text-danger error-msg" id="error-number"></span>
    </div>

    <div class="mb-3">
        <label>Capacidad</label>
        <input type="number" min="0" name="capacity" class="form-control" value="{{ $table->capacity }}" required>
        <span class="text-danger error-msg" id="error-capacity"></span>
    </div>

    <div class="mb-3">
        <label>Estado</label>
        <input type="text" name="status" class="form-control" value="{{ $table->status }}" required>
        <span class="text-danger error-msg" id="error-status"></span>
    </div>

    <button type="submit" class="btn btn-primary">Actualizar</button>
    <a href="/tables" class="btn btn-secondary">Cancelar</a>
</form>

@include('partials.footer')
