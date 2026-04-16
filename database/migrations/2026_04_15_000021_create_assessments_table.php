<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Skema Komposisi Bobot Nilai (Misal UTS: 30%, UAS: 40%, Tugas Praktek: 30%).
        // Dinamis tanpa perlu hardcode pada DB di setiap Sekolah (terutama untuk Penilaian K-13 & K-Merdeka yang Rumit)
        Schema::create('assessments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('class_room_id')->constrained('class_rooms')->cascadeOnDelete();
            $table->string('name');
            $table->decimal('weight', 5, 2)->default(0); // Bobot persentase
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assessments');
    }
};