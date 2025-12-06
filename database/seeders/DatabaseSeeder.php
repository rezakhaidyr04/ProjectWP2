<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. ADMIN USER - Full access, system management
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'),
                'role' => 'admin',
                'phone' => '081234567890',
                'address' => 'Jl. Admin No. 1, Jakarta',
            ]
        );

        // 2. PENGGUNA (MEMBER) - Regular customer
        User::firstOrCreate(
            ['email' => 'pengguna@example.com'],
            [
                'name' => 'Pengguna',
                'password' => bcrypt('password'),
                'role' => 'member',
                'phone' => '082345678901',
                'address' => 'Jl. Pengguna No. 10, Bandung',
            ]
        );

        // 3. PUBLISHER - Game publisher/seller
        User::firstOrCreate(
            ['email' => 'publisher@example.com'],
            [
                'name' => 'Publisher',
                'password' => bcrypt('password'),
                'role' => 'publisher',
                'phone' => '083456789012',
                'address' => 'Jl. Publisher No. 5, Jakarta',
            ]
        );

        $this->call([
            GamePackageSeeder::class,
        ]);
    }
}
