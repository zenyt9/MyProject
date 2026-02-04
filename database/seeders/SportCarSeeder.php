<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CarCategory;
use App\Models\Car;

class SportCarSeeder extends Seeder
{
    public function run(): void
    {
        // Sport категори үүсгэх
        $sportCategory = CarCategory::firstOrCreate(
            ['name' => 'Sport'],
            [
                'description' => 'Спорт машинууд - Өндөр хурдтай, гоё загвартай',
                'daily_rate' => 300000
            ]
        );

        // SUV машинуудын суудлыг засах
        $suvUpdates = [
            ['brand' => 'Kia', 'model' => 'Sorento', 'seats' => 7],
            ['brand' => 'Honda', 'model' => 'CR-V', 'seats' => 5],
            ['brand' => 'Mazda', 'model' => 'CX-9', 'seats' => 7],
            ['brand' => 'Hyundai', 'model' => 'Palisade', 'seats' => 8],
        ];

        foreach ($suvUpdates as $update) {
            Car::where('brand', $update['brand'])
                ->where('model', $update['model'])
                ->update(['seats' => $update['seats']]);
        }

        // 10 Sport машин нэмэх
        $sportCars = [
            [
                'brand' => 'Lamborghini',
                'model' => 'Huracan',
                'year' => '2024',
                'color' => 'Шар',
                'plate_number' => 'УБ-S001',
                'seats' => 2,
                'daily_rate' => 500000,
                'status' => 'available',
                'image' => 'cars/lamborghini-huracan.jpg'
            ],
            [
                'brand' => 'Ferrari',
                'model' => 'F8 Tributo',
                'year' => '2024',
                'color' => 'Улаан',
                'plate_number' => 'УБ-S002',
                'seats' => 2,
                'daily_rate' => 550000,
                'status' => 'available',
                'image' => 'cars/ferrari-f8.jpg'
            ],
            [
                'brand' => 'Porsche',
                'model' => '911 Turbo',
                'year' => '2024',
                'color' => 'Хар',
                'plate_number' => 'УБ-S003',
                'seats' => 2,
                'daily_rate' => 450000,
                'status' => 'available',
                'image' => 'cars/porsche-911.jpg'
            ],
            [
                'brand' => 'McLaren',
                'model' => '720S',
                'year' => '2023',
                'color' => 'Улбар шар',
                'plate_number' => 'УБ-S004',
                'seats' => 2,
                'daily_rate' => 520000,
                'status' => 'available',
                'image' => 'cars/mclaren-720s.jpg'
            ],
            [
                'brand' => 'Audi',
                'model' => 'R8',
                'year' => '2024',
                'color' => 'Цэнхэр',
                'plate_number' => 'УБ-S005',
                'seats' => 2,
                'daily_rate' => 400000,
                'status' => 'available',
                'image' => 'cars/audi-r8.jpg'
            ],
            [
                'brand' => 'BMW',
                'model' => 'M8 Competition',
                'year' => '2024',
                'color' => 'Саарал',
                'plate_number' => 'УБ-S006',
                'seats' => 4,
                'daily_rate' => 380000,
                'status' => 'available',
                'image' => 'cars/bmw-m8.jpg'
            ],
            [
                'brand' => 'Mercedes-AMG',
                'model' => 'GT R',
                'year' => '2023',
                'color' => 'Ногоон',
                'plate_number' => 'УБ-S007',
                'seats' => 2,
                'daily_rate' => 420000,
                'status' => 'available',
                'image' => 'cars/amg-gtr.jpg'
            ],
            [
                'brand' => 'Chevrolet',
                'model' => 'Corvette C8',
                'year' => '2024',
                'color' => 'Улаан',
                'plate_number' => 'УБ-S008',
                'seats' => 2,
                'daily_rate' => 350000,
                'status' => 'available',
                'image' => 'cars/corvette-c8.jpg'
            ],
            [
                'brand' => 'Nissan',
                'model' => 'GT-R',
                'year' => '2023',
                'color' => 'Хар',
                'plate_number' => 'УБ-S009',
                'seats' => 4,
                'daily_rate' => 320000,
                'status' => 'available',
                'image' => 'cars/nissan-gtr.jpg'
            ],
            [
                'brand' => 'Dodge',
                'model' => 'Challenger SRT',
                'year' => '2024',
                'color' => 'Хар',
                'plate_number' => 'УБ-S010',
                'seats' => 4,
                'daily_rate' => 300000,
                'status' => 'available',
                'image' => 'cars/challenger-srt.jpg'
            ]
        ];

        foreach ($sportCars as $carData) {
            Car::create(array_merge($carData, [
                'category_id' => $sportCategory->id
            ]));
        }

        $this->command->info('Sport категорид 10 машин амжилттай нэмэгдлээ!');
        $this->command->info('SUV машинуудын суудал засагдлаа!');
    }
}
