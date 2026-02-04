<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CarCategory;

class AdditionalCategoriesSeeder extends Seeder
{
    public function run(): void
    {
        // Sedan категори нэмэх
        CarCategory::firstOrCreate(
            ['name' => 'Sedan'],
            [
                'description' => 'Седан машинууд - Эдийн засгийн, тав тухтай, хотын машинууд',
                'daily_rate' => 100000
            ]
        );

        // Luxury категори нэмэх
        CarCategory::firstOrCreate(
            ['name' => 'Luxury'],
            [
                'description' => 'Тансаг зэрэглэлийн машинууд - Дээд зэргийн тав тух, технологи',
                'daily_rate' => 350000
            ]
        );

        $this->command->info('2 шинэ категори (Sedan, Luxury) амжилттай нэмэгдлээ!');
        $this->command->info('Одоо нийт: ' . CarCategory::count() . ' категори байна.');
    }
}
