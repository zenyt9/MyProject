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
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();

            // Оюутны мэдээлэл
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();

            // Анги болон хичээл
            $table->foreignId('school_class_id')
                  ->nullable()
                  ->constrained('school_classes')
                  ->nullOnDelete(); // Анги устсан ч элсэлт үлдэх

            $table->foreignId('subject_id')
                  ->nullable()
                  ->constrained('subjects')
                  ->nullOnDelete(); // Хичээл устсан ч элсэлт үлдэх

            // Элсэлттэй холбоотой нэмэлт мэдээлэл
            $table->string('semester');
            $table->integer('year');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
