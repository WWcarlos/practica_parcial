@include('partials.header')

<h2>Crear Plato</h2>

<form action="/dishes" method="POST" enctype="multipart/form-data" class="form-validable">
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
        <label>Precio</label>
        <input type="number" step="0.01" min="0" name="price" class="form-control" required>
        <span class="text-danger error-msg" id="error-price"></span>
    </div>

    <div class="mb-3">
        <label>Categoría</label>
        <select name="category_id" class="form-control" required>
            <option value="">— Seleccionar —</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
        </select>
        <span class="text-danger error-msg" id="error-category_id"></span>
    </div>

    <div class="mb-3">
        <label>Disponible</label>
        <select name="available" class="form-control">
            <option value="1">Sí</option>
            <option value="0">No</option>
        </select>
        <span class="text-danger error-msg" id="error-available"></span>
    </div>

    <div class="mb-3">
        <label>Imagen</label>
        <input type="file" name="image" class="form-control">
    </div>

    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="/dishes" class="btn btn-secondary">Cancelar</a>
</form>

@include('partials.footer')
