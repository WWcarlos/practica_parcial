@include('partials.header')

<h2>Editar Rol</h2>

<form action="/roles/{{ $role->id }}" method="POST" class="form-validable">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nombre</label>
        <input type="text" name="name" class="form-control" value="{{ $role->name }}" required>
        <span class="text-danger error-msg" id="error-name"></span>
    </div>

    <div class="mb-3">
        <label>Descripción</label>
        <textarea name="description" class="form-control">{{ $role->description }}</textarea>
        <span class="text-danger error-msg" id="error-description"></span>
    </div>

    <button type="submit" class="btn btn-primary">Actualizar</button>
    <a href="/roles" class="btn btn-secondary">Cancelar</a>
</form>

@include('partials.footer')
