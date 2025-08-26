<?php

namespace Database\Seeders;

use App\Models\Inventory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Inventory::create([
            'medicine_id' => 1,
            'stock_id' => 1,
            'date' => '2024-06-10',
            'quantity' => 30,
            'type' => 'masuk',
            'description' => 'Penambahan stok awal',
        ]);

        Inventory::create([
            'medicine_id' => 2,
            'stock_id' => 2,
            'date' => '2024-06-20',
            'quantity' => 20,
            'type' => 'masuk',
            'description' => 'Penambahan stok awal',
        ]);

        Inventory::create([
            'medicine_id' => 3,
            'stock_id' => 3,
            'date' => '2024-07-05',
            'quantity' => 25,
            'type' => 'keluar',
            'description' => 'Penambahan stok awal',
        ]);
    }
}
