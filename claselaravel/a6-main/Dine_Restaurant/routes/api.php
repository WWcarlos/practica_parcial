<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DishApiController;

Route::apiResource('dishes', DishApiController::class)->names([
    'index'   => 'api.dishes.index',
    'store'   => 'api.dishes.store',
    'show'    => 'api.dishes.show',
    'update'  => 'api.dishes.update',
    'destroy' => 'api.dishes.destroy',
]);