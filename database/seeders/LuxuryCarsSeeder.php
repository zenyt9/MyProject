<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CarCategory;
use App\Models\Car;

class LuxuryCarsSeeder extends Seeder
{
    public function run(): void
    {
        $luxury = CarCategory::where('name', 'Luxury')->first();

        $cars = [
            [
                'brand' => 'Mercedes-Maybach',
                'model' => 'S 600',
                'year' => '2024',
                'color' => 'Хар',
                'plate_number' => 'УБ-4101',
                'seats' => 5,
                'daily_rate' => 700000,
                'status' => 'available',
                'features' => '6.0L V12 Biturbo, 530 морины хүч, Массажтай суудал, Буrmester 3D аудио',
                'category_id' => $luxury->id,
                'image' => null
            ],
            [
                'brand' => 'Rolls-Royce',
                'model' => 'Phantom',
                'year' => '2024',
                'color' => 'Цагаан',
                'plate_number' => 'УБ-4102',
                'seats' => 5,
                'daily_rate' => 1200000,
                'status' => 'available',
                'features' => '6.75L V12, 563 морины хүч, Starlight headliner, Бүрэн тохируулах боломжтой',
                'category_id' => $luxury->id,
                'image' => null
            ],
            [
                'brand' => 'Rolls-Royce',
                'model' => 'Wraith',
                'year' => '2024',
                'color' => 'Саарал',
                'plate_number' => 'УБ-4103',
                'seats' => 4,
                'daily_rate' => 900000,
                'status' => 'available',
                'features' => '6.6L V12 Twin-Turbo, 624 морины хүч, Coupe загвар, Suicide doors',
                'category_id' => $luxury->id,
                'image' => null
            ],
            [
                'brand' => 'BMW',
                'model' => '7 Series G70',
                'year' => '2024',
                'color' => 'Хөх',
                'plate_number' => 'УБ-4104',
                'seats' => 5,
                'daily_rate' => 500000,
                'status' => 'available',
                'features' => 'M760i xDrive, V12 хөдөлгүүр, Executive Lounge Seating, Бүрэн автомат жолоодлого',
                'category_id' => $luxury->id,
                'image' => null
            ]
        ];

        foreach ($cars as $carData) {
            Car::create($carData);
        }

        $this->command->info('4 Luxury машин амжилттай нэмэгдлээ!');
        $this->command->info('Mercedes-Maybach S 600, Rolls-Royce Phantom, Rolls-Royce Wraith, BMW 7 Series G70');
    }
}
