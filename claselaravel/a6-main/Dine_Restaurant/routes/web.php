<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Panel Nutricional (API Externa)
    Route::get('/panel-nutricion', function () {
        return view('restaurante.nutricion');
    })->name('panel.nutricion');

    // ── Solo lectura — todos los roles autenticados ────
    Route::resource('menus', MenuController::class)->only(['index', 'show']);
    Route::resource('tables', TableController::class)->only(['index', 'show']);
    
    // Proxy server-side hacia Fruityvice (evita el bloqueo CORS del navegador)
    Route::get('/api/fruits', function () {
        try {
            $response = \Illuminate\Support\Facades\Http::timeout(15)
                ->get('https://www.fruityvice.com/api/fruit/all');

            if (!$response->successful()) {
                return response()->json([
                    'error' => 'La API externa devolvió HTTP ' . $response->status(),
                ], 502);
            }

            return response()->json($response->json());
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'No se pudo contactar la API externa: ' . $e->getMessage(),
            ], 502);
        }
    })->name('api.fruits');

    // ── Solo Administrador ────────────────────
    Route::middleware(['role:Administrator'])->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('roles', RoleController::class);
    });

    // ── Administrador + Waiter ─────────────────
    Route::middleware(['role:Administrator,Waiter'])->group(function () {
        Route::resource('orders', OrderController::class);
        Route::resource('tables', TableController::class)->except(['index', 'show']);
    });

    // ── Administrador + Chef ───────────────────
    Route::middleware(['role:Administrator,Chef'])->group(function () {
        Route::resource('categories', CategoryController::class);
        Route::resource('dishes', DishController::class);
        Route::resource('menus', MenuController::class)->except(['index', 'show']);
    });

    // ── Reportes — Administrador ─────
    Route::middleware(['role:Administrator'])->prefix('reports')->name('reports.')->group(function () {
        Route::get('orders', [ReportController::class, 'orders'])->name('orders');
        Route::get('top-dishes', [ReportController::class, 'topDishes'])->name('top_dishes');
    });

});