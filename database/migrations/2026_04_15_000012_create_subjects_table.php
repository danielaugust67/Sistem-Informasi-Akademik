<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Mata Pelajaran (Skala Sekolah) atau Mata Kuliah (Skala Kampus).
        // Setiap mata pelajaran memiliki parameter credit_hours (Bobot SKS/JP).
        Schema::create('subjects', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('institution_id')->constrained('institutions')->cascadeOnDelete();
            $table->foreignUuid('curriculum_id')->nullable()->constrained('curriculums')->nullOnDelete();
            $table->foreignUuid('study_program_id')->nullable()->constrained('study_programs')->nullOnDelete();
            $table->string('code');
            $table->string('name');
            $table->integer('credit_hours')->default(1);
            $table->string('level');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};