@include('partials.header')

<h2>Crear Categoría</h2>

<form action="/categories" method="POST" class="form-validable">
    @csrf

    <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input type="text" name="name" class="form-control" required>
        <span class="text-danger error-msg" id="error-name"></span>
    </div>

    <div class="mb-3">
        <label class="form-label">Descripción</label>
        <textarea name="description" class="form-control"></textarea>
        <span class="text-danger error-msg" id="error-description"></span>
    </div>

    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="/categories" class="btn btn-secondary">Cancelar</a>
</form>

@include('partials.footer')
