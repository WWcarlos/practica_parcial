<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            TableSeeder::class,        // primero las mesas sin mesero
            UserSeeder::class,         // luego users (clientes ahora pueden tener table_id)
            TableWaiterSeeder::class,  // ahora asignamos meseros a las mesas
            CategorySeeder::class,
            MenuSeeder::class,
            DishSeeder::class,
            PayMethodSeeder::class,
            OrderSeeder::class,
            MenuDishSeeder::class,
            OrderDishSeeder::class,
        ]);
    }
}
