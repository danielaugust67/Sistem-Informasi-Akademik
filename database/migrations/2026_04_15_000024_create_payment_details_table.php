<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Detail Item Penagihan yang wajib dilunasi oleh Siswa/Mhs.
        // Bisa berupa Uang Gedung, Sumbangan, SPP Bulan Juli, Cuti Kuliah, dst.
        Schema::create('payment_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('payment_id')->constrained('payments')->cascadeOnDelete();
            $table->string('item_name');
            $table->decimal('amount', 12, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_details');
    }
};