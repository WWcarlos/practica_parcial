<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OrderDish;
class OrderDishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       OrderDish::factory(75)->create();
    }
}
