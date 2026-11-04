<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PayMethod;

class PayMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Pueden ser maximo como tantos esten declarados en el factory
        PayMethod::factory(6)->create();
    }
}
