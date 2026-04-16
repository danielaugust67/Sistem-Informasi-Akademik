<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel ini menyimpan data Tahun Akademik (misal: 2023/2024).
        // Berfungsi sebagai acuan utama siklus pembelajaran di institusi terkait setiap tahunnya.
        Schema::create('academic_years', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('institution_id')->constrained('institutions')->cascadeOnDelete();
            $table->string('year', 20);
            $table->enum('status', ['active', 'inactive', 'planned'])->default('planned');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('academic_years');
    }
};