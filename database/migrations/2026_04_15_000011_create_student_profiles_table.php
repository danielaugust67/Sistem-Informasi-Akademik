<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Profil rinci untuk Siswa atau Mahasiswa. Di sini mereka berelasi ke rombel (opsional jika kampus) 
        // maupun wali kelas/dosen pembimbing akademiknya (PA).
        Schema::create('student_profiles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->unique()->constrained('users')->cascadeOnDelete();
            $table->string('nis_nim')->nullable()->unique();
            $table->foreignUuid('study_program_id')->nullable()->constrained('study_programs')->nullOnDelete();
            $table->foreignUuid('rombel_id')->nullable()->constrained('rombels')->nullOnDelete();
            $table->foreignUuid('academic_advisor_id')->nullable()->constrained('teacher_profiles')->nullOnDelete();
            $table->string('status');
            $table->date('enrolled_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_profiles');
    }
};