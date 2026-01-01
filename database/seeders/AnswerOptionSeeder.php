<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class AnswerOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $scales = DB::table('option_scales')
            ->pluck('id', 'code');

        $options = [
            'AGREEMENT' => [
                1 => 'Sangat tidak setuju',
                2 => 'Tidak setuju',
                3 => 'Setuju',
                4 => 'Sangat setuju',
            ],
            'SUITABILITY' => [
                1 => 'Sangat tidak sesuai',
                2 => 'Tidak sesuai',
                3 => 'Sesuai',
                4 => 'Sangat sesuai',
            ],
            'SPEED' => [
                1 => 'Sangat tidak cepat',
                2 => 'Tidak cepat',
                3 => 'Cepat',
                4 => 'Sangat cepat',
            ],
            'SATISFACTION' => [
                1 => 'Sangat tidak puas',
                2 => 'Tidak puas',
                3 => 'Puas',
                4 => 'Sangat puas',
            ],
        ];

        foreach ($options as $scaleCode => $labels) {
            foreach ($labels as $score => $label) {
                DB::table('answer_options')->insert([
                    'option_scale_id' => $scales[$scaleCode],
                    'score' => $score,
                    'label' => $label,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
