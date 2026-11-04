@include('partials.header')

<style>
    .hero-home{
        position: relative;
        min-height: 85vh;
        border-radius: 18px;
        overflow: hidden;
        padding: 60px 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 10px 30px rgba(0,0,0,.20);
        border-radius:0;
    }

    /* Imagen real de fondo */
    .hero-home::before{
        content: "";
        position: absolute;
        inset: 0;
        background: url("{{ asset('images/restaurante.avif') }}");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        transform: scale(1.05);
        z-index: 1;
    }

    /* Oscurecer imagen */
    .hero-home::after{
        content: "";
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,.55);
        z-index: 2;
    }

    .hero-content{
        position: relative;
        z-index: 3;
        width: 100%;
        max-width: 1100px;
        color: white;
    }

    .hero-title{
        font-size: 3rem;
        font-weight: 800;
        text-shadow: 2px 2px 8px rgba(0,0,0,.5);
    }

    .hero-subtitle{
        font-size: 1.25rem;
        margin-bottom: 40px;
        color: #f1f1f1;
    }

    .menu-btn{
        font-size: 1.1rem;
        font-weight: 600;
        padding: 14px;
        border-radius: 12px;
        box-shadow: 0 8px 18px rgba(0,0,0,.25);
        transition: .3s ease;
    }

    .menu-btn:hover{
        transform: translateY(-4px);
    }
</style>

<div class="hero-home">

    <div class="hero-content text-center">

        <h1 class="hero-title">Restaurante donde paty </h1>
        <p class="hero-subtitle">Administra todo desde aquí de forma rápida y profesional</p>

        <div class="row justify-content-center">

            <div class="col-md-4 mb-3">
                <a href="/categories" class="btn btn-primary w-100 menu-btn">Categorías</a>
            </div>

            <div class="col-md-4 mb-3">
                <a href="/dishes" class="btn btn-success w-100 menu-btn">Platos</a>
            </div>

            <div class="col-md-4 mb-3">
                <a href="/menus" class="btn btn-warning w-100 menu-btn">Menús</a>
            </div>

            <div class="col-md-4 mb-3">
                <a href="/orders" class="btn btn-danger w-100 menu-btn">Órdenes</a>
            </div>

            <div class="col-md-4 mb-3">
                <a href="/tables" class="btn btn-dark w-100 menu-btn">Mesas</a>
            </div>

            <div class="col-md-4 mb-3">
                <a href="/users" class="btn btn-info w-100 menu-btn">Usuarios</a>
            </div>
            <div class="col-md-4 mb-3">
                
            </div>

        </div>

    </div>

</div>

@include('partials.footer')