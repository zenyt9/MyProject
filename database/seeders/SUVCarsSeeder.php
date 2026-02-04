<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CarCategory;
use App\Models\Car;

class SUVCarsSeeder extends Seeder
{
    public function run(): void
    {
        $suv = CarCategory::where('name', 'SUV')->first();

        $cars = [
            [
                'brand' => 'Lamborghini',
                'model' => 'Urus',
                'year' => '2024',
                'color' => 'Хар',
                'plate_number' => 'УБ-5001',
                'seats' => 5,
                'daily_rate' => 600000,
                'status' => 'available',
                'features' => '4.0L V8 Twin-Turbo, 650 морины хүч, 0-100км/ц 3.6 сек, Super SUV',
                'category_id' => $suv->id,
                'image' => null
            ],
            [
                'brand' => 'Toyota',
                'model' => 'Land Cruiser 300',
                'year' => '2024',
                'color' => 'Цагаан',
                'plate_number' => 'УБ-5002',
                'seats' => 7,
                'daily_rate' => 250000,
                'status' => 'available',
                'features' => '3.5L V6 Twin-Turbo, 415 морины хүч, Full-Time 4WD, 7 суудалтай',
                'category_id' => $suv->id,
                'image' => null
            ],
            [
                'brand' => 'Lexus',
                'model' => 'LX 600',
                'year' => '2024',
                'color' => 'Саарал',
                'plate_number' => 'УБ-5003',
                'seats' => 7,
                'daily_rate' => 400000,
                'status' => 'available',
                'features' => '3.5L V6 Twin-Turbo, 409 морины хүч, Luxury Interior, Mark Levinson аудио',
                'category_id' => $suv->id,
                'image' => null
            ],
            [
                'brand' => 'Audi',
                'model' => 'RS Q8',
                'year' => '2024',
                'color' => 'Улаан',
                'plate_number' => 'УБ-5004',
                'seats' => 5,
                'daily_rate' => 550000,
                'status' => 'available',
                'features' => '4.0L V8 Twin-Turbo, 600 морины хүч, Quattro AWD, RS Performance',
                'category_id' => $suv->id,
                'image' => null
            ]
        ];

        foreach ($cars as $carData) {
            Car::create($carData);
        }

        $this->command->info('4 SUV машин амжилттай нэмэгдлээ!');
        $this->command->info('Lamborghini Urus, Toyota Land Cruiser 300, Lexus LX 600, Audi RS Q8');
    }
}
