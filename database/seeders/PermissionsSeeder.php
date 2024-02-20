<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'watch users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'edit own post']);
        Permission::create(['name' => 'delete own post']);
        Permission::create(['name' => 'edit any post']);
        Permission::create(['name' => 'delete any post']);
        Permission::create(['name' => 'view posts']);
        Permission::create(['name' => 'comment on posts']);
        Permission::create(['name' => 'create posts']);
        Permission::create(['name' => 'own posts']);
    }
}
