<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;
class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Los menus se basan en desayuno, almuerzo y cena, pudiendo ofrecer platos similares entre
        //ellos o full distintos
        Menu::factory(10)->create();
    }
}
