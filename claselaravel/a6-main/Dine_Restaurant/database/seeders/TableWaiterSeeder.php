<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use App\Models\Table;

class TableWaiterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $waiterRole = Role::where('name', 'Waiter')->first();
        $waiters = User::where('role_id', $waiterRole->id)->get();
        $tables = Table::all();

        foreach ($tables as $table) {
            $table->update([
                'waiter_id' => $waiters->random()->id
            ]);
        }
    }
}
