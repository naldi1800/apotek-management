<?php

namespace Database\Seeders;

use App\Models\Stock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Stock::create([
            'medicine_id' => 1,
            'batch_number' => 'BN001',
            'expiry_date' => '2025-12-31',
            'stock_date' => '2024-06-01',
            'initial_quantity' => 30,
            'current_quantity' => 30,
            'status' => 'tersedia',
        ]);

        Stock::create([
            'medicine_id' => 2,
            'batch_number' => 'BN002',
            'expiry_date' => '2024-11-30',
            'stock_date' => '2024-06-15',
            'initial_quantity' => 20,
            'current_quantity' => 20,
            'status' => 'tersedia',
        ]);
        Stock::create([
            'medicine_id' => 3,
            'batch_number' => 'BN003',
            'expiry_date' => '2025-01-15',
            'stock_date' => '2024-07-01',
            'initial_quantity' => 25,
            'current_quantity' => 25,
            'status' => 'tersedia',
        ]);
        

    }
}
