<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::create([
            'name' => 'Administrator',
            'slug' => 'admin',
            'description' => 'Full access to all features'
        ]);
        
        Role::create([
            'name' => 'Manager',
            'slug' => 'manager',
            'description' => 'Can manage and approve complaints'
        ]);
        
        Role::create([
            'name' => 'Petugas',
            'slug' => 'petugas',
            'description' => 'Access to review and process complaints'
        ]);
        
        Role::create([
            'name' => 'Regular User',
            'slug' => 'user',
            'description' => 'Can create and manage own complaints'
        ]);
    }
}