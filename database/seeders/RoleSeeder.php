<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Role::query()->exists()) {
            return;
        }

        $now = now();

        Role::insert([
            ['name' => 'Admin', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Manager', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Editor', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Support', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Viewer', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
