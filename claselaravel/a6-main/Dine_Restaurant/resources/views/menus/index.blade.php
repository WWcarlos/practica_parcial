@include('partials.header')

<div class="d-flex justify-content-between mb-3">
    <h2>Menús</h2>
    <a href="/menus/create" class="btn btn-primary">+ Crear</a>
</div>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Inicio</th>
            <th>Fin</th>
            <th>Activo</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        @foreach($menus as $menu)
        <tr>
            <td>{{ $menu->id }}</td>
            <td>{{ $menu->name }}</td>
            <td>{{ $menu->description }}</td>
            <td>{{ $menu->start_time }}</td>
            <td>{{ $menu->end_time }}</td>
            <td>
                @if($menu->active)
                    <span class="badge bg-success">Sí</span>
                @else
                    <span class="badge bg-danger">No</span>
                @endif
            </td>
            <td>
                <a href="/menus/{{ $menu->id }}" class="btn btn-info btn-sm">Ver</a>
                <a href="/menus/{{ $menu->id }}/edit" class="btn btn-warning btn-sm">Editar</a>

                <form action="/menus/{{ $menu->id }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@include('partials.footer')
