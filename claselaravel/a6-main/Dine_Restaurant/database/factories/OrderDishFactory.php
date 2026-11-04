<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Dish;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderDishFactory extends Factory
{
    public function definition(): array
    {
        $dish = Dish::inRandomOrder()->first();

        return [
            'order_id'   => Order::inRandomOrder()->first()->id,
            'dish_id'    => $dish->id,
            'quantity'   => $this->faker->numberBetween(1, 3),
            'unit_price' => $dish->price,
            'comment'    => null,
            'status'     => 'pending'
        ];
    }
}
