<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dine Restaurant — Iniciar Sesión</title>
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }
        .login-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,.4);
            overflow: hidden;
            width: 100%;
            max-width: 440px;
        }
        .login-header {
            background: linear-gradient(135deg, #c0392b, #e74c3c);
            padding: 2.5rem;
            text-align: center;
            color: #fff;
        }
        .login-header .icon {
            font-size: 3rem;
            margin-bottom: .5rem;
        }
        .login-header h1 {
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0;
        }
        .login-header p {
            opacity: .85;
            margin: .3rem 0 0;
            font-size: .95rem;
        }
        .login-body {
            padding: 2rem 2.5rem 2.5rem;
        }
        .form-control {
            border-radius: 10px;
            padding: .6rem 1rem;
        }
        .form-control:focus {
            border-color: #e74c3c;
            box-shadow: 0 0 0 .2rem rgba(231,76,60,.2);
        }
        .btn-login {
            background: linear-gradient(135deg, #c0392b, #e74c3c);
            border: none;
            border-radius: 10px;
            color: #fff;
            font-weight: 600;
            padding: .7rem;
            width: 100%;
            font-size: 1rem;
            transition: opacity .2s;
        }
        .btn-login:hover { opacity: .9; color: #fff; }
        .input-group-text {
            border-radius: 10px 0 0 10px;
            background: #f8f9fa;
        }
        label { font-weight: 600; color: #444; font-size: .9rem; }
        .credentials-hint {
            background: #fff8e1;
            border: 1px solid #ffe082;
            border-radius: 10px;
            padding: .8rem 1rem;
            font-size: .82rem;
            color: #5d4037;
            margin-bottom: 1.2rem;
        }
    </style>
</head>
<body>
<div class="login-card">
    <div class="login-header">
        <div class="icon">🍽</div>
        <h1>Dine Restaurant</h1>
        <p>Panel de Administración</p>
    </div>
    <div class="login-body">

        @if ($errors->any())
            <div class="alert alert-danger rounded-3 py-2 mb-3">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="credentials-hint">
            <strong>💡 Credenciales de prueba:</strong><br>
            Email: <code>admin@dine.com</code> &nbsp;|&nbsp; Contraseña: <code>password</code>
        </div>

        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <div class="mb-3">
                <label for="email">Correo electrónico</label>
                <div class="input-group mt-1">
                    <span class="input-group-text"><i class="bi bi-envelope-fill text-muted"></i></span>
                    <input type="email" id="email" name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email') }}" placeholder="tu@correo.com" required autofocus>
                </div>
            </div>

            <div class="mb-3">
                <label for="password">Contraseña</label>
                <div class="input-group mt-1">
                    <span class="input-group-text"><i class="bi bi-lock-fill text-muted"></i></span>
                    <input type="password" id="password" name="password"
                           class="form-control" placeholder="••••••••" required>
                </div>
            </div>

            <div class="mb-4 d-flex align-items-center">
                <input type="checkbox" id="remember" name="remember" class="me-2">
                <label for="remember" class="mb-0 fw-normal" style="font-weight:400!important">Recordarme</label>
            </div>

            <button type="submit" class="btn btn-login">
                <i class="bi bi-box-arrow-in-right me-2"></i>Iniciar Sesión
            </button>
        </form>
    </div>
</div>
</body>
</html>

