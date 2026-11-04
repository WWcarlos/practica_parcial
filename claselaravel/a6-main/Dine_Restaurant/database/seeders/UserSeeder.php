<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Usuarios fijos por rol (credenciales conocidas para pruebas)
        $fixed = [
            ['name' => 'Admin Principal',  'email' => 'admin@dine.com',   'role' => 'Administrator'],
            ['name' => 'Carlos Mesero',    'email' => 'waiter@dine.com',  'role' => 'Waiter'],
            ['name' => 'María Chef',       'email' => 'chef@dine.com',    'role' => 'Chef'],
            ['name' => 'Juan Cliente',     'email' => 'cliente@dine.com', 'role' => 'Customer'],
        ];

        foreach ($fixed as $data) {
            $role = Role::where('name', $data['role'])->first();
            if (!$role) continue;
            User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name'     => $data['name'],
                    'password' => Hash::make('password'),
                    'role_id'  => $role->id,
                    'active'   => true,
                ]
            );
        }

        // Usuarios aleatorios adicionales
        User::factory(30)->create();
    }
}
