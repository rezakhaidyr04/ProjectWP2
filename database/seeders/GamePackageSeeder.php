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
                'image' => 'https://via.placeholder.com/150x150?text=ML17',
                'is_active' => true
            ],
            [
                'game_name' => 'Mobile Legends',
                'package_name' => 'Diamonds 34',
                'amount' => 34,
                'price' => 18000,
                'description' => '34 Diamonds untuk Mobile Legends',
                'image' => 'https://via.placeholder.com/150x150?text=ML34',
                'is_active' => true
            ],
            [
                'game_name' => 'Mobile Legends',
                'package_name' => 'Diamonds 56',
                'amount' => 56,
                'price' => 29000,
                'description' => '56 Diamonds untuk Mobile Legends',
                'image' => 'https://via.placeholder.com/150x150?text=ML56',
                'is_active' => true
            ],

            // Free Fire
            [
                'game_name' => 'Free Fire',
                'package_name' => 'Diamonds 10',
                'amount' => 10,
                'price' => 8000,
                'description' => '10 Diamonds untuk Free Fire',
                'image' => 'https://via.placeholder.com/150x150?text=FF10',
                'is_active' => true
            ],
            [
                'game_name' => 'Free Fire',
                'package_name' => 'Diamonds 50',
                'amount' => 50,
                'price' => 39000,
                'description' => '50 Diamonds untuk Free Fire',
                'image' => 'https://via.placeholder.com/150x150?text=FF50',
                'is_active' => true
            ],

            // PUBG Mobile
            [
                'game_name' => 'PUBG Mobile',
                'package_name' => 'UC 60',
                'amount' => 60,
                'price' => 9000,
                'description' => '60 UC untuk PUBG Mobile',
                'image' => 'https://via.placeholder.com/150x150?text=PUBG60',
                'is_active' => true
            ],
            [
                'game_name' => 'PUBG Mobile',
                'package_name' => 'UC 300',
                'amount' => 300,
                'price' => 45000,
                'description' => '300 UC untuk PUBG Mobile',
                'image' => 'https://via.placeholder.com/150x150?text=PUBG300',
                'is_active' => true
            ],

            // Valorant
            [
                'game_name' => 'Valorant',
                'package_name' => 'Points 500',
                'amount' => 500,
                'price' => 50000,
                'description' => '500 Valorant Points',
                'image' => 'https://via.placeholder.com/150x150?text=VAL500',
                'is_active' => true
            ],
        ];

        foreach ($packages as $package) {
            \App\Models\GamePackage::create($package);
        }
    }
}
