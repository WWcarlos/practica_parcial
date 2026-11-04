@include('partials.header')

<div class="d-flex justify-content-between mb-3">
    <h2>Mesas</h2>
    <a href="/tables/create" class="btn btn-primary">+ Crear</a>
</div>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Número</th>
            <th>Capacidad</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        @foreach($tables as $table)
        <tr>
            <td>{{ $table->id }}</td>
            <td>{{ $table->number }}</td>
            <td>{{ $table->capacity }}</td>
            <td>{{ $table->status }}</td>
            <td>
                <a href="/tables/{{ $table->id }}" class="btn btn-info btn-sm">Ver</a>
                <a href="/tables/{{ $table->id }}/edit" class="btn btn-warning btn-sm">Editar</a>

                <form action="/tables/{{ $table->id }}" method="POST" style="display:inline;">
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
