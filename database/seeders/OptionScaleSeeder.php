<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class OptionScaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('option_scales')->insert([
            [
                'code' => 'AGREEMENT',
                'description' => 'Setuju / Tidak Setuju',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'SUITABILITY',
                'description' => 'Sesuai / Tidak Sesuai',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'SPEED',
                'description' => 'Cepat / Tidak Cepat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'SATISFACTION',
                'description' => 'Puas / Tidak Puas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
