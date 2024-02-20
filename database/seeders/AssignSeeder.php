<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AssignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::where('name', 'superadmin')->first();
        $role->givePermissionTo(Permission::all());

        $roleadmin = Role::where('name', 'admin')->first();
        $roleadmin->givePermissionTo('own posts', 'create posts', 'edit own post', 'delete own post', 'view posts', 'comment on posts');
        //   $role->givePermissionTo();
     
        $roleViewer = Role::where('name', 'viewer')->first();
        $roleViewer->givePermissionTo('view posts', 'comment on posts');
    }
}
