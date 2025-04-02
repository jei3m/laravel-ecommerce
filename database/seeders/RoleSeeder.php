<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Create roles if they don't exist
        Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'customer', 'guard_name' => 'web']);

        // For testing purposes, create an admin user if none exists
        if (!User::whereHas('roles', fn($q) => $q->where('name', 'admin'))->exists()) {
            $adminUser = User::create([
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('password'),
            ]);
            $adminUser->assignRole('admin');
        }
    }
}
