<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Dish;
use Illuminate\Http\Request;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dishes = Dish::all();
        return view('dishes.index', compact('dishes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('dishes.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'available' => 'required|boolean',
            'category_id' => 'required',
            'image' => 'nullable|image'
        ]);
        Dish::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'available' => $request->available,
            'category_id' => $request->category_id,
            'image' => $request->has('image') ? $request->file('image')->store('dishes', 'public') : null,
        ]);
        return redirect("/dishes");
    }

    /**
     * Display the specified resource.
     */
    public function show(Dish $dish)
    {
        return view('dishes.show', compact('dish'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dish $dish)
    {
        $categories = Category::all();
        return view('dishes.edit', compact('dish', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dish $dish)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'available' => 'required|boolean',
            'category_id' => 'required',
            'image' => 'nullable|image'
        ]);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'available' => $request->available,
            'category_id' => $request->category_id,
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('dishes', 'public');
        }
        $dish->update($data);
        return redirect('/dishes');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dish $dish)
    {
        $dish->delete();
        return redirect('/dishes');
    }
}
