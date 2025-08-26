<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\History>
 */
class HistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $day = now()->subDays(rand(0, 365));
        return [
            'sparepart_id' => rand(1, 10),
            'jumlah' => rand(1, 15),
            'total_harga' => rand(100000, 2000000),
            'tanggal_restock' => $day,
            'keterangan' => fake()->sentence(10),
            'created_at' => $day,
            'updated_at' => now()
        ];
    }
}
