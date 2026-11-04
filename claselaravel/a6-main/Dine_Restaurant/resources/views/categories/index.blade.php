@include('partials.header')

<div class="d-flex justify-content-between mb-3">
    <h2>Categorías</h2>
    <a href="/categories/create" class="btn btn-primary">+ Crear</a>
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
        @foreach($categories as $cat)
        <tr>
            <td>{{ $cat->id }}</td>
            <td>{{ $cat->name }}</td>
            <td>{{ $cat->description }}</td>
            <td>
                <a href="/categories/{{ $cat->id }}" class="btn btn-info btn-sm">Ver</a>
                <a href="/categories/{{ $cat->id }}/edit" class="btn btn-warning btn-sm">Editar</a>

                <form action="/categories/{{ $cat->id }}" method="POST" style="display:inline;">
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
