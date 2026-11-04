@include('partials.header')

<h2>Crear Rol</h2>

<form action="/roles" method="POST" class="form-validable">
    @csrf

    <div class="mb-3">
        <label>Nombre</label>
        <input type="text" name="name" class="form-control" required>
        <span class="text-danger error-msg" id="error-name"></span>
    </div>

    <div class="mb-3">
        <label>Descripción</label>
        <textarea name="description" class="form-control"></textarea>
        <span class="text-danger error-msg" id="error-description"></span>
    </div>

    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="/roles" class="btn btn-secondary">Cancelar</a>
</form>

@include('partials.footer')
