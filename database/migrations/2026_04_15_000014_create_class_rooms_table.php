<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Kelas rill atau rombongan khusus saat suatu Mata Kuliah/Pelajaran diadakan.
        // Di kelas ini bisa juga dikait-link ke rombel (apabila di Sekolah), namun berdiri sendiri jika untuk KRS kampus.
        Schema::create('class_rooms', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('subject_id')->constrained('subjects')->cascadeOnDelete();
            $table->foreignUuid('semester_id')->constrained('semesters')->cascadeOnDelete();
            $table->foreignUuid('rombel_id')->nullable()->constrained('rombels')->nullOnDelete();
            $table->integer('capacity')->default(40);
            $table->string('room_code')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('class_rooms');
    }
};