@include('partials.header')

<h2>Editar Categoría</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="/categories/{{ $category->id }}" method="POST" class="form-validable">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nombre</label>
        <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
        <span class="text-danger error-msg" id="error-name"></span>
    </div>

    <div class="mb-3">
        <label>Descripción</label>
        <textarea name="description" class="form-control">{{ $category->description }}</textarea>
        <span class="text-danger error-msg" id="error-description"></span>
    </div>

    <button type="submit" class="btn btn-primary">Actualizar</button>
    <a href="/categories" class="btn btn-secondary">Cancelar</a>
</form>

@include('partials.footer')
