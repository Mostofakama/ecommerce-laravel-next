<?php

namespace Database\Seeders;

use App\Models\PromoCode;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PromoCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       PromoCode::create([
            'code' => 'DISCOUNT10',
            'discount_percentage' => 10,
            'valid_from' => now()->subDays(1),
            'valid_until' => now()->addDays(10),
            'is_active' => true,
        ]);
    }
}
