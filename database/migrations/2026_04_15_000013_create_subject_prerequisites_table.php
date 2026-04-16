<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Relasi diri sendiri (Self-Referencing) di mana 1 buah Mata Kuliah menuntut 
        // lulusnya minimal di Mata Kuliah sebelumnya (Konsep Prasyarat ala Universitas).
        Schema::create('subject_prerequisites', function (Blueprint $table) {
            $table->uuid('subject_id')->constrained('subjects')->cascadeOnDelete();
            $table->uuid('required_subject_id')->constrained('subjects')->cascadeOnDelete();
            $table->string('minimum_grade')->nullable();
            $table->primary(['subject_id', 'required_subject_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subject_prerequisites');
    }
};