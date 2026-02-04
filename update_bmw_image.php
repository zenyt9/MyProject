<?php

use App\Models\Car;
use Illuminate\Support\Facades\File;

$car = Car::find(3);

$imageUrl = 'https://images.unsplash.com/photo-1555215695-3004980ad54e?w=800&q=80';
$imageName = 'bmw_m4.jpg';
$imagePath = public_path('storage/cars/' . $imageName);

try {
    $imageContent = file_get_contents($imageUrl);
    File::ensureDirectoryExists(public_path('storage/cars'));
    file_put_contents($imagePath, $imageContent);
    $car->update(['image' => 'cars/' . $imageName]);
    echo 'BMW M4 зураг амжилттай татагдлаа' . PHP_EOL;
} catch (Exception $e) {
    echo 'Алдаа: ' . $e->getMessage() . PHP_EOL;
}
