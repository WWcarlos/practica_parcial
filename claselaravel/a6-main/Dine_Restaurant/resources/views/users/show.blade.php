@include('partials.header')

<h2>Detalle Usuario</h2>

<div class="card">
    <div class="card-body">
        <p><strong>ID:</strong> {{ $user->id }}</p>
        <p><strong>Nombre:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Rol:</strong> {{ $user->role->name ?? 'N/A' }}</p>
        <p><strong>Estado:</strong> {{ $user->active ? 'Activo' : 'Inactivo' }}</p>
    </div>
</div>

<a href="/users" class="btn btn-secondary mt-3">Volver</a>

@include('partials.footer')