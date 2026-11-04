@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0"><i class="bi bi-person-plus-fill text-danger me-2"></i>Crear Usuario</h4>
    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary btn-sm">← Volver</a>
</div>

<div class="card">
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
        @endif

        <form method="POST" action="{{ route('users.store') }}" class="form-validable">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Nombre</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    <span class="text-danger error-msg" id="error-name"></span>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Correo electrónico</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    <span class="text-danger error-msg" id="error-email"></span>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Contraseña</label>
                    <input type="password" name="password" class="form-control" required>
                    <span class="text-danger error-msg" id="error-password"></span>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Confirmar contraseña</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                    <span class="text-danger error-msg" id="error-password_confirmation"></span>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Rol</label>
                    <select name="role_id" class="form-select" required>
                        <option value="">— Seleccionar —</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                    <span class="text-danger error-msg" id="error-role_id"></span>
                </div>
                <div class="col-md-6 d-flex align-items-end">
                    <div class="form-check">
                        <input type="checkbox" name="active" value="1" id="active" class="form-check-input"
                               {{ old('active', 1) ? 'checked' : '' }}>
                        <label for="active" class="form-check-label fw-semibold">Usuario activo</label>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-danger px-4">
                        <i class="bi bi-save me-1"></i>Guardar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
