<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Menyimpan data Rombongan Belajar (Rombel), sangat identik dengan konsep persekolahan K-12.
        // Siswa dan wali kelas (homeroom_teacher) akan digabungkan di grup ini.
        Schema::create('rombels', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('institution_id')->constrained('institutions')->cascadeOnDelete();
            $table->foreignUuid('academic_year_id')->constrained('academic_years')->cascadeOnDelete();
            $table->string('name');
            $table->foreignUuid('homeroom_teacher_id')->nullable()->constrained('teacher_profiles')->nullOnDelete();
            $table->integer('capacity')->default(30);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rombels');
    }
};