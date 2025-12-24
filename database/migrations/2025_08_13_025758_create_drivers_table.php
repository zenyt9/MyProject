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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // жолоочийн нэр
            $table->string('license_number')->nullable(); // үнэмлэхний дугаар
            $table->string('email')->nullable(); // имэйл
            $table->string('phone')->nullable(); // утас
            $table->text('address')->nullable(); // хаяг
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
