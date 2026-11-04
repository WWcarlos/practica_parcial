<?php

namespace Database\Factories;

use App\Models\PayMethod;
use Illuminate\Database\Eloquent\Factories\Factory;

class PayMethodFactory extends Factory
{
    protected $model = PayMethod::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement([
                'Cash',
                'Debit card',
                'Credit card',
                'Transfer',
                'Nequi',
                'Daviplata',
            ]),
            'active' => true,
        ];
    }
}
