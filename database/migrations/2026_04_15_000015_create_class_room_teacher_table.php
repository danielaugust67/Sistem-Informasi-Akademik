<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Many-to-Many tabel Pivot bagi Kelas dengan Dosen/Gurunya.
        // Diperlukan karena 1 Kelas Pelajaran/Kuliah bisa diisi banyak Dosen (System 'Team Teaching').
        Schema::create('class_room_teacher', function (Blueprint $table) {
            $table->uuid('class_room_id')->constrained('class_rooms')->cascadeOnDelete();
            $table->uuid('teacher_profile_id')->constrained('teacher_profiles')->cascadeOnDelete();
            $table->primary(['class_room_id', 'teacher_profile_id']);
            $table->boolean('is_primary')->default(true);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('class_room_teacher');
    }
};