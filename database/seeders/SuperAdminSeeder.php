<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::truncate();
        $user =  User::create([
            'name' => 'SuperAdmin',
            'email' => 'superadmin@compliance.com',
            'password' => bcrypt('root@123'),
            'email_verified_at' => now(),
        ]);

        $user->assignRole('superadmin');
    }
}
