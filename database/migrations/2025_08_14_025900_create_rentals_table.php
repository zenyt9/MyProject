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
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();

            // Үйлчлүүлэгч болон машин
            $table->foreignId('customer_id')
                  ->nullable()
                  ->constrained('customers')
                  ->nullOnDelete();

            $table->foreignId('car_id')
                  ->nullable()
                  ->constrained('cars')
                  ->nullOnDelete();

            // Түрээсийн мэдээлэл
            $table->date('start_date'); // эхлэх огноо
            $table->date('end_date'); // дуусах огноо
            $table->integer('days')->default(1); // хоног
            $table->decimal('daily_rate', 10, 2); // өдрийн үнэ
            $table->decimal('total_cost', 10, 2); // нийт үнэ
            $table->string('status')->default('active'); // active, completed, cancelled
            $table->text('notes')->nullable(); // тэмдэглэл

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
