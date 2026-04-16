<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Detail perolehan nilai anak tsb dari suatu 'assessments' tertentu.
        // Terhubung ke KRS. Totalnya nanti terhitung di tabel utama 'grades'.
        Schema::create('assessment_grades', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('assessment_id')->constrained('assessments')->cascadeOnDelete();
            $table->foreignUuid('enrollment_id')->constrained('enrollments')->cascadeOnDelete();
            $table->decimal('score', 5, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assessment_grades');
    }
};