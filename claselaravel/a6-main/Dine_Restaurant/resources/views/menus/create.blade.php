@include('partials.header')

<h2>Crear Menú</h2>

<form action="/menus" method="POST" class="form-validable">
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

    <div class="mb-3">
        <label>Hora Inicio</label>
        <input type="time" name="start_time" class="form-control" required>
        <span class="text-danger error-msg" id="error-start_time"></span>
    </div>

    <div class="mb-3">
        <label>Hora Fin</label>
        <input type="time" name="end_time" class="form-control" required>
        <span class="text-danger error-msg" id="error-end_time"></span>
    </div>

    <div class="mb-3">
        <label>Activo</label>
        <select name="active" class="form-control">
            <option value="1">Sí</option>
            <option value="0">No</option>
        </select>
        <span class="text-danger error-msg" id="error-active"></span>
    </div>

    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="/menus" class="btn btn-secondary">Cancelar</a>
</form>

@include('partials.footer')
