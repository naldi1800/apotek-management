<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employee::create([
            'name' => 'Kasir1',
            'email' => 'pegawai1',
            'password' => Hash::make('12345678'),
        ]);
        Employee::create([
            'name' => 'Kasir2',
            'email' => 'pegawai2',
            'password' => Hash::make('12345678'),
        ]);
        Employee::create([
            'name' => 'Kasir3',
            'email' => 'pegawai3',
            'password' => Hash::make('12345678'),
        ]);
    }
}
