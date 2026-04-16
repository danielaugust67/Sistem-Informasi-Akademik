<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Rekam Induk Pembayaran, cicilan dan tunggakan tagihan keuangan Pendidikan.
        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('student_id')->constrained('student_profiles')->cascadeOnDelete();
            $table->foreignUuid('semester_id')->nullable()->constrained('semesters')->cascadeOnDelete();
            $table->decimal('total_amount', 12, 2);
            $table->enum('status', ['unpaid', 'partial', 'paid', 'cancelled'])->default('unpaid');
            $table->string('invoice_no')->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};