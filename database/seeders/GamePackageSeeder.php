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
                'image' => 'https://via.placeholder.com/300x200/FF6B9D/FFFFFF?text=Mobile+Legends',
                'is_active' => true
            ],
            [
                'game_name' => 'Mobile Legends',
                'package_name' => 'Diamonds 34',
                'amount' => 34,
                'price' => 18000,
                'description' => '34 Diamonds untuk Mobile Legends',
                'image' => 'https://via.placeholder.com/300x200/FF6B9D/FFFFFF?text=Mobile+Legends',
                'is_active' => true
            ],
            [
                'game_name' => 'Mobile Legends',
                'package_name' => 'Diamonds 56',
                'amount' => 56,
                'price' => 29000,
                'description' => '56 Diamonds untuk Mobile Legends',
                'image' => 'https://via.placeholder.com/300x200/FF6B9D/FFFFFF?text=Mobile+Legends',
                'is_active' => true
            ],

            // Free Fire
            [
                'game_name' => 'Free Fire',
                'package_name' => 'Diamonds 10',
                'amount' => 10,
                'price' => 8000,
                'description' => '10 Diamonds untuk Free Fire',
                'image' => 'https://via.placeholder.com/300x200/FF3D00/FFFFFF?text=Free+Fire',
                'is_active' => true
            ],
            [
                'game_name' => 'Free Fire',
                'package_name' => 'Diamonds 50',
                'amount' => 50,
                'price' => 39000,
                'description' => '50 Diamonds untuk Free Fire',
                'image' => 'https://via.placeholder.com/300x200/FF3D00/FFFFFF?text=Free+Fire',
                'is_active' => true
            ],

            // PUBG Mobile
            [
                'game_name' => 'PUBG Mobile',
                'package_name' => 'UC 60',
                'amount' => 60,
                'price' => 9000,
                'description' => '60 UC untuk PUBG Mobile',
                'image' => 'https://via.placeholder.com/300x200/1B5E20/FFFFFF?text=PUBG+Mobile',
                'is_active' => true
            ],
            [
                'game_name' => 'PUBG Mobile',
                'package_name' => 'UC 300',
                'amount' => 300,
                'price' => 45000,
                'description' => '300 UC untuk PUBG Mobile',
                'image' => 'https://via.placeholder.com/300x200/1B5E20/FFFFFF?text=PUBG+Mobile',
                'is_active' => true
            ],

            // Valorant
            [
                'game_name' => 'Valorant',
                'package_name' => 'Points 500',
                'amount' => 500,
                'price' => 50000,
                'description' => '500 Valorant Points',
                'image' => 'https://via.placeholder.com/300x200/FF4081/FFFFFF?text=Valorant',
                'is_active' => true
            ],
        ];

        foreach ($packages as $package) {
            \App\Models\GamePackage::create($package);
        }
    }
}
