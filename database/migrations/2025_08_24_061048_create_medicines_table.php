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
        Schema::create('medicines', function (Blueprint $table) {
           $table->id();
            $table->string('generic_name');
            $table->string('brand_name');
            $table->string('unit'); // Ex: tablet, bottle, box
            $table->decimal('purchase_price', 10, 2); // Harga beli
            $table->decimal('selling_price', 10, 2); // Harga jual
            $table->string('bpom_number'); // No BPOM
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baskets');
        Schema::dropIfExists('inventories');
        Schema::dropIfExists('stocks');
        Schema::dropIfExists('medicines');
    }
};
