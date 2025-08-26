<?php

namespace Database\Seeders;

use App\Models\Medicine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Medicine::create([
            'generic_name' => 'Paracetamol',
            'brand_name' => 'Panadol',
            'unit' => 'tablet',
            'purchase_price' => 5000.00,
            'selling_price' => 7000.00,
            'bpom_number' => 'BPOM123456',
        ]);
        Medicine::create([
            'generic_name' => 'Amoxicillin',
            'brand_name' => 'Amoxil',
            'unit' => 'capsule',
            'purchase_price' => 8000.00,
            'selling_price' => 10000.00,
            'bpom_number' => 'BPOM654321',
        ]);
        Medicine::create([
            'generic_name' => 'Ibuprofen',
            'brand_name' => 'Advil',
            'unit' => 'tablet',
            'purchase_price' => 6000.00,
            'selling_price' => 8500.00,
            'bpom_number' => 'BPOM112233',
        ]);
    }
}
