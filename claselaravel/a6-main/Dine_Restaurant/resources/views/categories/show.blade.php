@include('partials.header')

<h2>Detalle Categoría</h2>

<div class="card">
    <div class="card-body">
        <p><strong>Nombre:</strong> {{ $category->name }}</p>
        <p><strong>Descripción:</strong> {{ $category->description }}</p>
    </div>
</div>

<a href="/categories" class="btn btn-secondary mt-3">Volver</a>

@include('partials.footer')
