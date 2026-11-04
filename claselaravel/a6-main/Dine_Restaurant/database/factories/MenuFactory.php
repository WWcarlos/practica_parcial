<?php

namespace Database\Factories;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;

class MenuFactory extends Factory
{
    protected $model = Menu::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->words(2, true),
            'description' => $this->faker->optional()->paragraph(),
            'start_time' => $this->faker->time('H:i:s'),
            'end_time' => $this->faker->time('H:i:s'),
            'active' => true,
        ];
    }
}
