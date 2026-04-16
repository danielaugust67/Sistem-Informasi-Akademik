<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel ini menyimpan Program Studi (seperti Teknik Informatika) yang ada di sebuah Fakultas (Department).
        // Dapat juga dimanfaatkan jika Sekolah Vokasi (SMK) butuh list program keahlian.
        Schema::create('study_programs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('department_id')->constrained('departments')->cascadeOnDelete();
            $table->string('code')->nullable();
            $table->string('name');
            $table->string('level')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('study_programs');
    }
};