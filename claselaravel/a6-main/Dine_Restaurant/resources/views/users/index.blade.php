@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0"><i class="bi bi-people-fill text-danger me-2"></i>Usuarios</h4>
    <a href="{{ route('users.create') }}" class="btn btn-danger btn-sm">
        <i class="bi bi-person-plus-fill me-1"></i>Nuevo Usuario
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
@endif

<div class="card">
    <div class="card-body p-0">
        <table class="table table-striped table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @php
                            $roleColors = ['Administrator'=>'danger','Waiter'=>'primary','Chef'=>'warning','Customer'=>'success'];
                            $color = $roleColors[$user->role->name ?? ''] ?? 'secondary';
                        @endphp
                        <span class="badge bg-{{ $color }}">{{ $user->role->name ?? 'Sin rol' }}</span>
                    </td>
                    <td>
                        @if($user->active)
                            <span class="badge bg-success">Activo</span>
                        @else
                            <span class="badge bg-secondary">Inactivo</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('users.show', $user) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('¿Eliminar usuario?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
