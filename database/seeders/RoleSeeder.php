<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Create roles
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'customer']);

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
