<?php

namespace Database\Factories;

use App\Models\Menu;
use App\Models\Dish;
use Illuminate\Database\Eloquent\Factories\Factory;

class MenuDishFactory extends Factory
{
    public function definition(): array
    {
        return [
            'menu_id' => Menu::inRandomOrder()->first()->id,
            'dish_id' => Dish::inRandomOrder()->first()->id
        ];
    }
}
