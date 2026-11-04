@include('partials.header')

<h2>Detalle Plato</h2>

<div class="card">
    <div class="card-body">
        <p><strong>Nombre:</strong> {{ $dish->name }}</p>
        <p><strong>Descripción:</strong> {{ $dish->description }}</p>
        <p><strong>Precio:</strong> ${{ $dish->price }}</p>
        <p><strong>Categoría:</strong> {{ $dish->category->name ?? 'N/A' }}</p>
        <p><strong>Disponible:</strong> {{ $dish->available ? 'Sí' : 'No' }}</p>

        @if($dish->image)
            <img src="{{ asset('storage/' . $dish->image) }}" width="150">
        @endif
    </div>
</div>

<a href="/dishes" class="btn btn-secondary mt-3">Volver</a>

@include('partials.footer')
