@include('partials.header')

<h2>Detalle Menú</h2>

<div class="card">
    <div class="card-body">
        <p><strong>Nombre:</strong> {{ $menu->name }}</p>
        <p><strong>Descripción:</strong> {{ $menu->description }}</p>
        <p><strong>Inicio:</strong> {{ $menu->start_time }}</p>
        <p><strong>Fin:</strong> {{ $menu->end_time }}</p>
        <p><strong>Activo:</strong> {{ $menu->active ? 'Sí' : 'No' }}</p>
    </div>
</div>

<a href="/menus" class="btn btn-secondary mt-3">Volver</a>

@include('partials.footer')
