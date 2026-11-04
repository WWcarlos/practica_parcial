<?php

namespace Database\Factories;

use App\Models\Table;
use Illuminate\Database\Eloquent\Factories\Factory;

class TableFactory extends Factory
{
    protected $model = Table::class;

    public function definition(): array
    {
        return [
            'number' => $this->faker->unique()->numberBetween(1, 200),
            'capacity' => $this->faker->numberBetween(2, 10),
            'status' => 'available',
            'waiter_id' => null, //Se asigna despues en un seeder, ya que no se pueden crear ambas tablas a la vez
        ];
    }
}
