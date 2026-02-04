<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CarCategory;
use App\Models\Car;

class AllCarsSeeder extends Seeder
{
    public function run(): void
    {
        // Категориудыг авах
        $suv = CarCategory::where('name', 'SUV')->first();
        $sport = CarCategory::where('name', 'Sport')->first();
        $sedan = CarCategory::where('name', 'Sedan')->first();
        $luxury = CarCategory::where('name', 'Luxury')->first();

        // SUV категорийн 5 машин
        $suvCars = [
            [
                'brand' => 'Toyota',
                'model' => 'Land Cruiser Prado',
                'year' => '2024',
                'color' => 'Цагаан',
                'plate_number' => 'УБ-1001',
                'seats' => 7,
                'daily_rate' => 180000,
                'status' => 'available',
                'image' => 'cars/prado.jpg',
                'features' => 'AWD, Арын камер, GPS навигаци',
                'category_id' => $suv->id
            ],
            [
                'brand' => 'Ford',
                'model' => 'Explorer',
                'year' => '2023',
                'color' => 'Хар',
                'plate_number' => 'УБ-1002',
                'seats' => 7,
                'daily_rate' => 170000,
                'status' => 'available',
                'image' => 'cars/ford-explorer.jpg',
                'features' => 'Панорам дээвэр, 7 суудалтай',
                'category_id' => $suv->id
            ],
            [
                'brand' => 'Chevrolet',
                'model' => 'Tahoe',
                'year' => '2024',
                'color' => 'Саарал',
                'plate_number' => 'УБ-1003',
                'seats' => 8,
                'daily_rate' => 200000,
                'status' => 'available',
                'image' => 'cars/tahoe.jpg',
                'features' => '8 суудал, Том ачааны орон зай',
                'category_id' => $suv->id
            ],
            [
                'brand' => 'Honda',
                'model' => 'CR-V',
                'year' => '2023',
                'color' => 'Мөнгөлөг',
                'plate_number' => 'УБ-1004',
                'seats' => 5,
                'daily_rate' => 130000,
                'status' => 'available',
                'image' => 'cars/crv.jpg',
                'features' => 'Эдийн засгийн түлш зарцуулалт',
                'category_id' => $suv->id
            ],
            [
                'brand' => 'Nissan',
                'model' => 'Patrol',
                'year' => '2024',
                'color' => 'Цагаан',
                'plate_number' => 'УБ-1005',
                'seats' => 8,
                'daily_rate' => 190000,
                'status' => 'available',
                'image' => 'cars/patrol.jpg',
                'features' => 'Хүчирхэг хөдөлгүүр, 8 суудал',
                'category_id' => $suv->id
            ]
        ];

        // Sport категорийн 5 машин
        $sportCars = [
            [
                'brand' => 'Lamborghini',
                'model' => 'Huracan',
                'year' => '2024',
                'color' => 'Шар',
                'plate_number' => 'УБ-2001',
                'seats' => 2,
                'daily_rate' => 500000,
                'status' => 'available',
                'image' => 'cars/lamborghini-huracan.jpg',
                'features' => 'V10 хөдөлгүүр, 610 морины хүч',
                'category_id' => $sport->id
            ],
            [
                'brand' => 'Ferrari',
                'model' => 'F8 Tributo',
                'year' => '2024',
                'color' => 'Улаан',
                'plate_number' => 'УБ-2002',
                'seats' => 2,
                'daily_rate' => 550000,
                'status' => 'available',
                'image' => 'cars/ferrari-f8.jpg',
                'features' => 'V8 Twin-Turbo, 720 морины хүч',
                'category_id' => $sport->id
            ],
            [
                'brand' => 'Porsche',
                'model' => '911 Turbo S',
                'year' => '2024',
                'color' => 'Хар',
                'plate_number' => 'УБ-2003',
                'seats' => 4,
                'daily_rate' => 450000,
                'status' => 'available',
                'image' => 'cars/porsche-911.jpg',
                'features' => '640 морины хүч, PDK хурдны хайрцаг',
                'category_id' => $sport->id
            ],
            [
                'brand' => 'McLaren',
                'model' => '720S',
                'year' => '2023',
                'color' => 'Улбар шар',
                'plate_number' => 'УБ-2004',
                'seats' => 2,
                'daily_rate' => 520000,
                'status' => 'available',
                'image' => 'cars/mclaren-720s.jpg',
                'features' => '720 морины хүч, Нүүрсхүчлийн биет',
                'category_id' => $sport->id
            ],
            [
                'brand' => 'Chevrolet',
                'model' => 'Corvette C8',
                'year' => '2024',
                'color' => 'Улаан',
                'plate_number' => 'УБ-2005',
                'seats' => 2,
                'daily_rate' => 350000,
                'status' => 'available',
                'image' => 'cars/corvette-c8.jpg',
                'features' => 'Дунд хөдөлгүүр, 495 морины хүч',
                'category_id' => $sport->id
            ]
        ];

        // Sedan категорийн 5 машин
        $sedanCars = [
            [
                'brand' => 'Toyota',
                'model' => 'Land Cruiser',
                'year' => '2024',
                'color' => 'Цагаан',
                'plate_number' => 'УБ-3001',
                'seats' => 7,
                'daily_rate' => 180000,
                'status' => 'available',
                'image' => 'cars/land-cruiser.jpg',
                'features' => 'AWD, Арын камер, GPS навигаци',
                'category_id' => $sedan->id
            ],
            [
                'brand' => 'Mazda',
                'model' => 'CX-9',
                'year' => '2023',
                'color' => 'Хар',
                'plate_number' => 'УБ-3002',
                'seats' => 7,
                'daily_rate' => 110000,
                'status' => 'available',
                'image' => 'cars/cx9.jpg',
                'features' => '7 суудалтай, Турбо хөдөлгүүр',
                'category_id' => $sedan->id
            ],
            [
                'brand' => 'Hyundai',
                'model' => 'Palisade',
                'year' => '2024',
                'color' => 'Саарал',
                'plate_number' => 'УБ-3003',
                'seats' => 8,
                'daily_rate' => 150000,
                'status' => 'available',
                'image' => 'cars/palisade.jpg',
                'features' => '8 суудалтай, Smart Cruise Control',
                'category_id' => $sedan->id
            ],
            [
                'brand' => 'Kia',
                'model' => 'Sorento',
                'year' => '2023',
                'color' => 'Улаан',
                'plate_number' => 'УБ-3004',
                'seats' => 7,
                'daily_rate' => 120000,
                'status' => 'available',
                'image' => 'cars/sorento.jpg',
                'features' => '7 суудалтай, AWD',
                'category_id' => $sedan->id
            ],
            [
                'brand' => 'Honda',
                'model' => 'CR-V',
                'year' => '2024',
                'color' => 'Цэнхэр',
                'plate_number' => 'УБ-3005',
                'seats' => 5,
                'daily_rate' => 100000,
                'status' => 'available',
                'image' => 'cars/crv.jpg',
                'features' => 'Эдийн засгийн түлш зарцуулалт',
                'category_id' => $sedan->id
            ]
        ];

        // Luxury категорийн 5 машин
        $luxuryCars = [
            [
                'brand' => 'Mercedes-Benz',
                'model' => 'AMG GT-R',
                'year' => '2024',
                'color' => 'Ногоон',
                'plate_number' => 'УБ-4001',
                'seats' => 2,
                'daily_rate' => 500000,
                'status' => 'available',
                'image' => 'cars/amg-gtr.jpg',
                'features' => '577 морины хүч, 4.0L V8 Biturbo',
                'category_id' => $luxury->id
            ],
            [
                'brand' => 'BMW',
                'model' => 'M8 Competition',
                'year' => '2024',
                'color' => 'Саарал',
                'plate_number' => 'УБ-4002',
                'seats' => 4,
                'daily_rate' => 480000,
                'status' => 'available',
                'image' => 'cars/bmw-m8.jpg',
                'features' => '617 морины хүч, Twin-Turbo V8',
                'category_id' => $luxury->id
            ],
            [
                'brand' => 'Audi',
                'model' => 'R8 V10',
                'year' => '2024',
                'color' => 'Цагаан',
                'plate_number' => 'УБ-4003',
                'seats' => 2,
                'daily_rate' => 520000,
                'status' => 'available',
                'image' => 'cars/audi-r8.jpg',
                'features' => 'V10 хөдөлгүүр, 602 морины хүч',
                'category_id' => $luxury->id
            ],
            [
                'brand' => 'Lexus',
                'model' => 'LX 570',
                'year' => '2024',
                'color' => 'Хар',
                'plate_number' => 'УБ-4004',
                'seats' => 8,
                'daily_rate' => 380000,
                'status' => 'available',
                'image' => 'cars/lexus-lx570.jpg',
                'features' => '8 суудалтай, V8 хөдөлгүүр',
                'category_id' => $luxury->id
            ],
            [
                'brand' => 'Nissan',
                'model' => 'GT-R',
                'year' => '2024',
                'color' => 'Саарал',
                'plate_number' => 'УБ-4005',
                'seats' => 4,
                'daily_rate' => 450000,
                'status' => 'available',
                'image' => 'cars/nissan-gtr.jpg',
                'features' => '565 морины хүч, Twin-Turbo V6',
                'category_id' => $luxury->id
            ]
        ];

        // Бүх машинуудыг нэмэх
        foreach ($suvCars as $car) {
            Car::create($car);
        }
        foreach ($sportCars as $car) {
            Car::create($car);
        }
        foreach ($sedanCars as $car) {
            Car::create($car);
        }
        foreach ($luxuryCars as $car) {
            Car::create($car);
        }

        $this->command->info('Нийт 20 машин амжилттай нэмэгдлээ!');
        $this->command->info('SUV: 5, Sport: 5, Sedan: 5, Luxury: 5');
    }
}
