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
        Schema::create('transaction_models', function (Blueprint $table) {
           $table->id();
            $table->foreignId('transaction_id')->constrained()->onDelete('cascade'); // Relasi ke transaksi
            $table->foreignId('medicine_id')->constrained()->onDelete('cascade'); // Relasi ke obat
            $table->foreignId('stock_id')->constrained()->onDelete('cascade'); // Relasi ke batch stok
            $table->integer('jumlah'); // Jumlah barang yang terjual
            $table->decimal('harga_satuan', 10, 2); // Harga satuan pada saat transaksi
            $table->decimal('subtotal', 10, 2); // Subtotal harga
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_models');
    }
};
