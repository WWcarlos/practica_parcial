@include('partials.header')

<div class="d-flex justify-content-between mb-3">
    <h2>Platos</h2>
    <a href="/dishes/create" class="btn btn-primary">+ Crear</a>
</div>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Precio</th>
            <th>Disponible</th>
            <th>Imagen</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        @foreach($dishes as $dish)
        <tr>
            <td>{{ $dish->id }}</td>
            <td>{{ $dish->name }}</td>
            <td>{{ $dish->category->name ?? 'N/A' }}</td>
            <td>${{ $dish->price }}</td>
            <td>
                @if($dish->available)
                    <span class="badge bg-success">Sí</span>
                @else
                    <span class="badge bg-danger">No</span>
                @endif
            </td>
            <td>
                @if($dish->image)
                    <img src="{{ asset('storage/' . $dish->image) }}" width="60">
                @else
                    Sin imagen
                @endif
            </td>
            <td>
                <a href="/dishes/{{ $dish->id }}" class="btn btn-info btn-sm">Ver</a>
                <a href="/dishes/{{ $dish->id }}/edit" class="btn btn-warning btn-sm">Editar</a>

                <form action="/dishes/{{ $dish->id }}" method="POST" style="display:inline;">
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
