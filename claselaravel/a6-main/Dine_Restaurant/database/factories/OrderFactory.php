<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\PayMethod;
use App\Models\Table;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        $status = $this->faker->randomElement(['open', 'in_preparation', 'ready', 'closed']);

        return [
            'table_id' => Table::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id,
            'pay_method_id' => $status === 'closed' ? PayMethod::inRandomOrder()->first()->id : null,
            'status' => $status,
            'total' => round($this->faker->randomFloat(2, 10000, 300000), 2),
            'opened_at' => now(),
            'closed_at' => $status === 'closed' ? now() : null,
        ];
    }
}
