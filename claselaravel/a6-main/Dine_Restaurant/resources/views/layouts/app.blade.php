<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dine Restaurant — Panel</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f6f9;
        }

        .main-header {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .brand-link {
            font-size: 1.2rem;
            font-weight: 700;
            letter-spacing: .5px;
        }

        .content-wrapper {
            min-height: 100vh;
            background: linear-gradient(to bottom, #f8f9fa, #eef1f4);
        }

        .content-header h1 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #343a40;
        }

        .card {
            border: none;
            border-radius: 14px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, .06);
        }

        .btn {
            border-radius: 10px;
        }

        .main-footer {
            background: #fff;
            border-top: 1px solid #dee2e6;
            padding: 12px 20px;
            font-size: .95rem;
        }

        /* Sidebar active link */
        .nav-sidebar .nav-link.active {
            background-color: #e74c3c !important;
            color: #fff !important;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        @include('layouts.navbar')
        @include('layouts.sidebar')

        <div class="content-wrapper">
            <section class="content px-4 py-4">
                @yield('content')
            </section>
        </div>

        <footer class="main-footer text-center">
            <strong>Dine Restaurant</strong> | © {{ date('Y') }} Todos los derechos reservados.
        </footer>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/js/adminlte.min.js"></script>
    {{-- Bootstrap JS para dropdowns de la navbar --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/globalValidation.js') }}"></script>
    @yield('scripts')
</body>

</html>