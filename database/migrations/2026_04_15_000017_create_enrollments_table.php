<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Proses Pengambilan Kelas (KRS) atau 'Enrolled' jika SD-SMA didaftarkan Admin/Wali.
        // Data relasinya menyangkut Student -> Kelas yang diikuti apa.
        Schema::create('enrollments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('student_id')->constrained('student_profiles')->cascadeOnDelete();
            $table->foreignUuid('class_room_id')->constrained('class_rooms')->cascadeOnDelete();
            $table->enum('status', ['pending', 'approved', 'rejected', 'completed'])->default('pending');
            $table->timestamp('enrolled_at')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};