<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GamePackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packages = [
            // Mobile Legends
            [
                'game_name' => 'Mobile Legends',
                'package_name' => 'Diamonds 17',
                'amount' => 17,
                'price' => 9000,
                'description' => '17 Diamonds untuk Mobile Legends',
                'image' => 'https://images.weserv.nl/?url=i.pinimg.com/originals/8c/3f/2a/8c3f2a2c5b8e9f1a2b3c4d5e6f7a8b9c.png&w=300&h=300&fit=cover',
                'is_active' => true
            ],
            [
                'game_name' => 'Mobile Legends',
                'package_name' => 'Diamonds 34',
                'amount' => 34,
                'price' => 18000,
                'description' => '34 Diamonds untuk Mobile Legends',
                'image' => 'https://images.weserv.nl/?url=i.pinimg.com/originals/8c/3f/2a/8c3f2a2c5b8e9f1a2b3c4d5e6f7a8b9c.png&w=300&h=300&fit=cover',
                'is_active' => true
            ],
            [
                'game_name' => 'Mobile Legends',
                'package_name' => 'Diamonds 56',
                'amount' => 56,
                'price' => 29000,
                'description' => '56 Diamonds untuk Mobile Legends',
                'image' => 'https://images.weserv.nl/?url=i.pinimg.com/originals/8c/3f/2a/8c3f2a2c5b8e9f1a2b3c4d5e6f7a8b9c.png&w=300&h=300&fit=cover',
                'is_active' => true
            ],

            // Free Fire
            [
                'game_name' => 'Free Fire',
                'package_name' => 'Diamonds 10',
                'amount' => 10,
                'price' => 8000,
                'description' => '10 Diamonds untuk Free Fire',
                'image' => 'https://images.weserv.nl/?url=i.pinimg.com/originals/9f/4e/7d/9f4e7d3e8b2c5a1f9e6d4c3b2a1f8e9d.png&w=300&h=300&fit=cover',
                'is_active' => true
            ],
            [
                'game_name' => 'Free Fire',
                'package_name' => 'Diamonds 50',
                'amount' => 50,
                'price' => 39000,
                'description' => '50 Diamonds untuk Free Fire',
                'image' => 'https://images.weserv.nl/?url=i.pinimg.com/originals/9f/4e/7d/9f4e7d3e8b2c5a1f9e6d4c3b2a1f8e9d.png&w=300&h=300&fit=cover',
                'is_active' => true
            ],

            // PUBG Mobile
            [
                'game_name' => 'PUBG Mobile',
                'package_name' => 'UC 60',
                'amount' => 60,
                'price' => 9000,
                'description' => '60 UC untuk PUBG Mobile',
                'image' => 'https://images.weserv.nl/?url=i.pinimg.com/originals/7e/2f/5c/7e2f5c1a9b8d6e3f2a4c5b7e8f9d1a2b.png&w=300&h=300&fit=cover',
                'is_active' => true
            ],
            [
                'game_name' => 'PUBG Mobile',
                'package_name' => 'UC 300',
                'amount' => 300,
                'price' => 45000,
                'description' => '300 UC untuk PUBG Mobile',
                'image' => 'https://images.weserv.nl/?url=i.pinimg.com/originals/7e/2f/5c/7e2f5c1a9b8d6e3f2a4c5b7e8f9d1a2b.png&w=300&h=300&fit=cover',
                'is_active' => true
            ],

            // Valorant
            [
                'game_name' => 'Valorant',
                'package_name' => 'Points 500',
                'amount' => 500,
                'price' => 50000,
                'description' => '500 Valorant Points',
                'image' => 'https://images.weserv.nl/?url=i.pinimg.com/originals/5d/9c/3b/5d9c3b7e2f1a8e4c6b9d2e5f7a3c1b8e.png&w=300&h=300&fit=cover',
                'is_active' => true
            ],
        ];

        foreach ($packages as $package) {
            \App\Models\GamePackage::create($package);
        }
    }
}
