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
    // public function run(): void
    // {
    //     Permission::create(['name' => 'view users list']);
    //     Permission::create(['name' => 'edit users']);
    //     Permission::create(['name' => 'edit own post']);
    //     Permission::create(['name' => 'delete own post']);
    //     Permission::create(['name' => 'edit any post']);
    //     Permission::create(['name' => 'delete any post']);
    //     Permission::create(['name' => 'view posts']);
    //     Permission::create(['name' => 'comment on posts']);
    //     Permission::create(['name' => 'create posts']);
    //     Permission::create(['name' => 'own posts']);
    // }

    public function run(): void
    {
        // Permission::truncate();
        //user permissions
        Permission::create(['name' => 'view users list']);
        Permission::create(['name' => 'edit users role']);
        Permission::create(['name' => 'create users']);
        //personal post permissions
        Permission::create(['name' => 'edit personal posts']);
        Permission::create(['name' => 'delete personal posts']);
        Permission::create(['name' => 'personal posts list']);
        //all post permissions
        Permission::create(['name' => 'edit any posts']);
        Permission::create(['name' => 'delete any posts']);
        Permission::create(['name' => 'view any post']);
        Permission::create(['name' => 'comment on posts']);
        Permission::create(['name' => 'create posts']);
        Permission::create(['name' => 'all posts list']);
        //assign permissions to roles
        Permission::create(['name' => 'Assign Permissions']);
    }
}
