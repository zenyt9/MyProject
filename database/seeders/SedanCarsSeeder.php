<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CarCategory;
use App\Models\Car;

class SedanCarsSeeder extends Seeder
{
    public function run(): void
    {
        $sedan = CarCategory::where('name', 'Sedan')->first();

        $cars = [
            [
                'brand' => 'Toyota',
                'model' => 'Prius 50',
                'year' => '2024',
                'color' => 'Цагаан',
                'plate_number' => 'УБ-3101',
                'seats' => 5,
                'daily_rate' => 120000,
                'status' => 'available',
                'features' => 'Hybrid систем, Эдийн засгийн түлш зарцуулалт, CVT хурдны хайрцаг',
                'category_id' => $sedan->id,
                'image' => null
            ],
            [
                'brand' => 'Toyota',
                'model' => 'Crown 220',
                'year' => '2024',
                'color' => 'Хар',
                'plate_number' => 'УБ-3102',
                'seats' => 5,
                'daily_rate' => 180000,
                'status' => 'available',
                'features' => '2.5L Hybrid, Luxury Interior, JBL аудио систем',
                'category_id' => $sedan->id,
                'image' => null
            ],
            [
                'brand' => 'Toyota',
                'model' => 'Camry 50',
                'year' => '2024',
                'color' => 'Саарал',
                'plate_number' => 'УБ-3103',
                'seats' => 5,
                'daily_rate' => 130000,
                'status' => 'available',
                'features' => '2.5L хөдөлгүүр, Тав тухтай, Найдвартай',
                'category_id' => $sedan->id,
                'image' => null
            ],
            [
                'brand' => 'Mercedes-Benz',
                'model' => 'C-Class',
                'year' => '2024',
                'color' => 'Мөнгөлөг',
                'plate_number' => 'УБ-3104',
                'seats' => 5,
                'daily_rate' => 220000,
                'status' => 'available',
                'features' => 'Turbo хөдөлгүүр, MBUX систем, Арын суудлын халаалт',
                'category_id' => $sedan->id,
                'image' => null
            ]
        ];

        foreach ($cars as $carData) {
            Car::create($carData);
        }

        $this->command->info('4 Sedan машин амжилттай нэмэгдлээ!');
        $this->command->info('Toyota Prius 50, Toyota Crown 220, Toyota Camry 50, Mercedes-Benz C-Class');
    }
}
