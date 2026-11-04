@include('partials.header')

<div class="d-flex justify-content-between mb-3">
    <h2>Roles</h2>
    <a href="/roles/create" class="btn btn-primary">+ Crear</a>
</div>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        @foreach($roles as $role)
        <tr>
            <td>{{ $role->id }}</td>
            <td>{{ $role->name }}</td>
            <td>{{ $role->description }}</td>
            <td>
                <a href="/roles/{{ $role->id }}" class="btn btn-info btn-sm">Ver</a>
                <a href="/roles/{{ $role->id }}/edit" class="btn btn-warning btn-sm">Editar</a>

                <form action="/roles/{{ $role->id }}" method="POST" style="display:inline;">
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