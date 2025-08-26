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
        Schema::create('baskets', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_nota'); // Menyimpan nomor nota transaksi
            $table->foreignId('medicine_id')->constrained()->onDelete('cascade'); 
            $table->foreignId('stock_id')->constrained()->onDelete('cascade'); 
            $table->foreignId('employee_id')->constrained()->onDelete('cascade'); 
            $table->integer('jumlah'); // Jumlah barang yang dibeli
            $table->decimal('subtotal', 10, 2); // Total harga untuk barang tertentu
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baskets');
    }
};
