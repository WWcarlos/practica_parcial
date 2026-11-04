<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;


class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'Administrator', 'description' => 'Acceso total al sistema'],
            ['name' => 'Waiter',        'description' => 'Gestión de mesas y órdenes'],
            ['name' => 'Chef',          'description' => 'Gestión de platos y menús'],
            ['name' => 'Customer',      'description' => 'Cliente del restaurante'],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role['name']], $role);
        }
    }
}