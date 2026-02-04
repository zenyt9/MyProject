<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CarCategory;
use App\Models\Car;
use Illuminate\Support\Facades\File;

class SportCarsSeeder extends Seeder
{
    public function run(): void
    {
        $sport = CarCategory::where('name', 'Sport')->first();

        $cars = [
            [
                'brand' => 'Toyota',
                'model' => 'Supra MK5',
                'year' => '2024',
                'color' => 'Улаан',
                'plate_number' => 'УБ-2101',
                'seats' => 2,
                'daily_rate' => 380000,
                'status' => 'available',
                'features' => '3.0L Twin-Turbo, 382 морины хүч, 0-100км/ц 4.3 сек',
                'category_id' => $sport->id,
                'image_url' => 'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?w=800&q=80'
            ],
            [
                'brand' => 'Nissan',
                'model' => 'GT-R R35',
                'year' => '2024',
                'color' => 'Саарал',
                'plate_number' => 'УБ-2102',
                'seats' => 4,
                'daily_rate' => 450000,
                'status' => 'available',
                'features' => '3.8L V6 Twin-Turbo, 565 морины хүч, AWD',
                'category_id' => $sport->id,
                'image_url' => 'https://images.unsplash.com/photo-1609521263047-f8f205293f24?w=800&q=80'
            ],
            [
                'brand' => 'BMW',
                'model' => 'M4',
                'year' => '2024',
                'color' => 'Цэнхэр',
                'plate_number' => 'УБ-2103',
                'seats' => 4,
                'daily_rate' => 420000,
                'status' => 'available',
                'features' => '3.0L Twin-Turbo I6, 503 морины хүч, Competition пакет',
                'category_id' => $sport->id,
                'image_url' => 'https://images.unsplash.com/photo-1617531653520-bd4f03662b7d?w=800&q=80'
            ],
            [
                'brand' => 'Subaru',
                'model' => 'BRZ',
                'year' => '2024',
                'color' => 'Хар',
                'plate_number' => 'УБ-2104',
                'seats' => 4,
                'daily_rate' => 280000,
                'status' => 'available',
                'features' => '2.4L Boxer хөдөлгүүр, 228 морины хүч, RWD',
                'category_id' => $sport->id,
                'image_url' => 'https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?w=800&q=80'
            ]
        ];

        foreach ($cars as $carData) {
            $imageUrl = $carData['image_url'];
            unset($carData['image_url']);

            // Зураг татах
            $imageName = strtolower(str_replace([' ', '-'], '_', $carData['brand'] . '_' . $carData['model'])) . '.jpg';
            $imagePath = public_path('storage/cars/' . $imageName);

            try {
                $imageContent = @file_get_contents($imageUrl);
                if ($imageContent !== false) {
                    File::ensureDirectoryExists(public_path('storage/cars'));
                    file_put_contents($imagePath, $imageContent);
                    $carData['image'] = 'cars/' . $imageName;
                    $this->command->info("Зураг татагдлаа: {$imageName}");
                }
            } catch (\Exception $e) {
                $this->command->warn("Зураг татахад алдаа гарлаа: {$carData['brand']} {$carData['model']}");
                $carData['image'] = null;
            }

            Car::create($carData);
        }

        $this->command->info('4 Sport машин амжилттай нэмэгдлээ!');
    }
}
