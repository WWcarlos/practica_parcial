<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Dish;
use Illuminate\Database\Eloquent\Factories\Factory;

class DishFactory extends Factory
{
    protected $model = Dish::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->optional()->sentence(),
            'price' => round($this->faker->randomFloat(2, 5000, 80000), 2),
            'available' => true,
            'category_id' => Category::inRandomOrder()->first()->id,
            'image'=> null,
        ];
    }
}
