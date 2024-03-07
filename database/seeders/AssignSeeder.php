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

        // $roleadmin = Role::where('name', 'admin')->first();
        // $roleadmin->givePermissionTo('personal posts list', 'create posts', 'edit personal posts', 'delete personal posts', 'view any post', 'comment on posts');
        // //   $role->givePermissionTo();
     
        // $roleViewer = Role::where('name', 'viewer')->first();
        // $roleViewer->givePermissionTo('view any post', 'comment on posts');
    }
}
