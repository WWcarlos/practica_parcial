<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use App\Models\Table;

class UserFactory extends Factory
{
    public function definition(): array
    {
        //Trae la tabla de roles, asigna al azar su rol y si es cliente le asigna una mesa
        $role = Role::inRandomOrder()->first();
        $tableId = null;
        if($role->name === 'Customer'){
            $tableId = Table::inRandomOrder()->first();
        }
        return [
            'name'     => $this->faker->name(),
            'email'    => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'role_id'  => Role::inRandomOrder()->first()->id,
            'active'   => true,
            'table_id' => $tableId,
        ];
    }
}