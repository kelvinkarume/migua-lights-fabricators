<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ===============================
        // ADMIN USER
        // ===============================
        User::create([
            'name' => 'System Admin',
            'national_id' => '10000001',
            'phone' => '0700000001',
            'gender' => 'Male',
            'residence' => 'Nairobi',
            'photo' => null,
            'role' => 'admin',
            'password' => Hash::make('password123'),
        ]);

        // ===============================
        // PRODUCTION MANAGER
        // ===============================
        User::create([
            'name' => 'Production Manager',
            'national_id' => '10000002',
            'phone' => '0700000002',
            'gender' => 'Male',
            'residence' => 'Mombasa',
            'photo' => null,
            'role' => 'production_manager',
            'password' => Hash::make('password123'),
        ]);

        // ===============================
        // SALES MANAGER
        // ===============================
        User::create([
            'name' => 'Sales Manager',
            'national_id' => '10000003',
            'phone' => '0700000003',
            'gender' => 'Female',
            'residence' => 'Kisumu',
            'photo' => null,
            'role' => 'sales_manager',
            'password' => Hash::make('password123'),
        ]);

        // ===============================
        // NORMAL USERS (Workers)
        // ===============================
        User::factory()->count(5)->create();
    }
}