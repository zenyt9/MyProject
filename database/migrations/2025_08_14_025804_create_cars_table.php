<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('brand'); // брэнд: Toyota, BMW
            $table->string('model'); // модел: Camry, X5
            $table->string('year'); // үйлдвэрлэсэн он
            $table->string('plate_number')->unique(); // дугаар
            $table->string('color')->nullable(); // өнгө
            $table->integer('seats')->default(5); // суудлын тоо
            $table->text('features')->nullable(); // онцлог
            $table->decimal('daily_rate', 10, 2); // өдрийн үнэ
            $table->string('status')->default('available'); // available, rented, maintenance
            $table->string('image')->nullable(); // зураг
            $table->foreignId('category_id')
                ->nullable()
                ->constrained('car_categories')
                ->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
