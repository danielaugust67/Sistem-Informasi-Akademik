<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel ini menangani Semester (Ganjil, Genap, Pendek) di dalam sebuah Tahun Akademik.
        // Diperlukan terutama di tingkat Perguruan Tinggi atau sekolah dengan sistem blok semester.
        Schema::create('semesters', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('academic_year_id')->constrained('academic_years')->cascadeOnDelete();
            $table->enum('type', ['odd', 'even', 'short']);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('semesters');
    }
};