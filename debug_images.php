<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Http\Kernel');

use App\Models\GamePackage;

$packages = GamePackage::all();
foreach ($packages as $pkg) {
    echo "Game: {$pkg->game_name} - Package: {$pkg->package_name} - Image: {$pkg->image}\n";
}

// Check if file exists
$imagePath = base_path('public/images/games/mobile legend.jpeg');
echo "\nFile path: {$imagePath}\n";
echo "File exists: " . (file_exists($imagePath) ? 'YES' : 'NO') . "\n";

// List files in directory
echo "\nFiles in public/images/games/:\n";
$dir = base_path('public/images/games');
if (is_dir($dir)) {
    $files = scandir($dir);
    foreach ($files as $file) {
        if ($file !== '.' && $file !== '..') {
            echo "  - {$file}\n";
        }
    }
}
