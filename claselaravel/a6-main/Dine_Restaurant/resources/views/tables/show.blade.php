@include('partials.header')

<h2>Detalle Mesa</h2>

<div class="card">
    <div class="card-body">
        <p><strong>Número:</strong> {{ $table->number }}</p>
        <p><strong>Capacidad:</strong> {{ $table->capacity }}</p>
        <p><strong>Estado:</strong> {{ $table->status }}</p>
    </div>
</div>

<a href="/tables" class="btn btn-secondary mt-3">Volver</a>

@include('partials.footer')
