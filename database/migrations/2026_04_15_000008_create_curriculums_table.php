<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Menyimpan versi panduan kurikulum (Contoh: K13, Kurikulum Merdeka, Kurikulum KKNI 2020)
        // Membantu institusi memiliki sejarah kurikulum berbeda setiap program studinya.
        Schema::create('curriculums', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('institution_id')->constrained('institutions')->cascadeOnDelete();
            $table->string('name');
            $table->string('year')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('curriculums');
    }
};