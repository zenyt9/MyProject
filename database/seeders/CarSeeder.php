<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CarCategory;
use App\Models\Car;

class CarSeeder extends Seeder
{
    public function run(): void
    {
        // Эхлээд SUV категори үүсгэх
        $suvCategory = CarCategory::firstOrCreate(
            ['name' => 'SUV'],
            [
                'description' => 'Sport Utility Vehicle - Том, тав тухтай, олон зорчигчтой',
                'daily_rate' => 150000
            ]
        );

        // 10 SUV машин нэмэх
        $suvCars = [
            [
                'brand' => 'Toyota',
                'model' => 'Land Cruiser',
                'year' => '2023',
                'color' => 'Хар',
                'plate_number' => 'УБ-1234',
                'seats' => 7,
                'daily_rate' => 200000,
                'status' => 'available',
                'image' => 'cars/land-cruiser.jpg'
            ],
            [
                'brand' => 'Toyota',
                'model' => 'Prado',
                'year' => '2023',
                'color' => 'Цагаан',
                'plate_number' => 'УБ-2345',
                'seats' => 7,
                'daily_rate' => 180000,
                'status' => 'available',
                'image' => 'cars/prado.jpg'
            ],
            [
                'brand' => 'Lexus',
                'model' => 'LX 570',
                'year' => '2024',
                'color' => 'Хар',
                'plate_number' => 'УБ-3456',
                'seats' => 7,
                'daily_rate' => 250000,
                'status' => 'available',
                'image' => 'cars/lexus-lx570.jpg'
            ],
            [
                'brand' => 'Ford',
                'model' => 'Explorer',
                'year' => '2023',
                'color' => 'Саарал',
                'plate_number' => 'УБ-4567',
                'seats' => 7,
                'daily_rate' => 170000,
                'status' => 'available',
                'image' => 'cars/ford-explorer.jpg'
            ],
            [
                'brand' => 'Chevrolet',
                'model' => 'Tahoe',
                'year' => '2024',
                'color' => 'Хар',
                'plate_number' => 'УБ-5678',
                'seats' => 8,
                'daily_rate' => 220000,
                'status' => 'available',
                'image' => 'cars/tahoe.jpg'
            ],
            [
                'brand' => 'Honda',
                'model' => 'CR-V',
                'year' => '2023',
                'color' => 'Мөнгөлөг',
                'plate_number' => 'УБ-6789',
                'seats' => 5,
                'daily_rate' => 130000,
                'status' => 'available',
                'image' => 'cars/crv.jpg'
            ],
            [
                'brand' => 'Nissan',
                'model' => 'Patrol',
                'year' => '2023',
                'color' => 'Цагаан',
                'plate_number' => 'УБ-7890',
                'seats' => 7,
                'daily_rate' => 190000,
                'status' => 'available',
                'image' => 'cars/patrol.jpg'
            ],
            [
                'brand' => 'Hyundai',
                'model' => 'Palisade',
                'year' => '2024',
                'color' => 'Хөх',
                'plate_number' => 'УБ-8901',
                'seats' => 8,
                'daily_rate' => 160000,
                'status' => 'available',
                'image' => 'cars/palisade.jpg'
            ],
            [
                'brand' => 'Kia',
                'model' => 'Sorento',
                'year' => '2023',
                'color' => 'Улаан',
                'plate_number' => 'УБ-9012',
                'seats' => 7,
                'daily_rate' => 140000,
                'status' => 'available',
                'image' => 'cars/sorento.jpg'
            ],
            [
                'brand' => 'Mazda',
                'model' => 'CX-9',
                'year' => '2024',
                'color' => 'Саарал',
                'plate_number' => 'УБ-0123',
                'seats' => 7,
                'daily_rate' => 150000,
                'status' => 'available',
                'image' => 'cars/cx9.jpg'
            ]
        ];

        foreach ($suvCars as $carData) {
            Car::create(array_merge($carData, [
                'category_id' => $suvCategory->id
            ]));
        }

        $this->command->info('SUV категорид 10 машин амжилттай нэмэгдлээ!');
    }
}
