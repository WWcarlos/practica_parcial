<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use Illuminate\Http\Request;

class DishApiController extends Controller
{
    // GET /api/dishes
    public function index()
    {
        $dishes = Dish::with('category')->get();

        return response()->json($dishes);
    }

    // GET /api/dishes/{id}
    public function show($id)
    {
        $dish = Dish::with('category')->find($id);

        if (!$dish) {
            return response()->json([
                'message' => 'Plato no encontrado'
            ], 404);
        }

        return response()->json($dish);
    }

    // POST /api/dishes
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'available' => 'required|boolean',
            'category_id' => 'required'
        ]);

        $dish = Dish::create($request->all());

        return response()->json([
            'message' => 'Plato creado correctamente',
            'data' => $dish
        ], 201);
    }

    // PUT /api/dishes/{id}
    public function update(Request $request, $id)
    {
        $dish = Dish::find($id);

        if (!$dish) {
            return response()->json([
                'message' => 'Plato no encontrado'
            ], 404);
        }

        $request->validate([
            'name' => 'required',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'available' => 'required|boolean',
            'category_id' => 'required'
        ]);

        $dish->update($request->all());

        return response()->json([
            'message' => 'Plato actualizado correctamente',
            'data' => $dish
        ]);
    }

    // DELETE /api/dishes/{id}
    public function destroy($id)
    {
        $dish = Dish::find($id);

        if (!$dish) {
            return response()->json([
                'message' => 'Plato no encontrado'
            ], 404);
        }

        $dish->delete();

        return response()->json([
            'message' => 'Plato eliminado correctamente'
        ]);
    }
}