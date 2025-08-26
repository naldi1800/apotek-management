<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_nota')->unique();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade'); // Relasi ke pegawai
            $table->decimal('total_harga', 15, 2); // Total harga penjualan
            $table->date('tanggal_transaksi'); // Tanggal transaksi
            $table->text('keterangan')->nullable(); // Catatan tambahan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_models');
        Schema::dropIfExists('transaction');
    }
};
