@include('partials.header')

<h2>Detalle Rol</h2>

<div class="card">
    <div class="card-body">
        <p><strong>ID:</strong> {{ $role->id }}</p>
        <p><strong>Nombre:</strong> {{ $role->name }}</p>
        <p><strong>Descripción:</strong> {{ $role->description }}</p>
    </div>
</div>

<a href="/roles" class="btn btn-secondary mt-3">Volver</a>

@include('partials.footer')