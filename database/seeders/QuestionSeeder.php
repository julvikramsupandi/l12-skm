<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil element id by code
        $elements = DB::table('elements')
            ->pluck('id', 'code');

        // Ambil scale id by code
        $optionScales = DB::table('option_scales')
            ->pluck('id', 'code');

        $questions = [

            /*
            |--------------------------------------------------------------------------
            | ONLINE
            |--------------------------------------------------------------------------
            */
            ['U1', 'SUITABILITY', 'ONLINE', 'Informasi pelayanan tersedia melalui media elektronik maupun nonelektronik'],
            ['U1', 'SUITABILITY', 'ONLINE', 'Kesesuaian persyaratan dengan informasi yang diberikan'],

            ['U2', 'AGREEMENT', 'ONLINE', 'Standar dan prosedur layanan diinformasikan dengan jelas'],
            ['U2', 'AGREEMENT', 'ONLINE', 'Prosedur/Alur layanan mudah dipahami dan dilakukan'],
            ['U2', 'AGREEMENT', 'ONLINE', 'Layanan diberikan sesuai prosedur tanpa kecurangan'],

            ['U3', 'SUITABILITY', 'ONLINE', 'Jangka waktu layanan sesuai dengan yang diinformasikan'],
            ['U4', 'SUITABILITY', 'ONLINE', 'Biaya layanan sesuai dengan yang diinformasikan'],

            ['U7', 'AGREEMENT', 'ONLINE', 'Tidak ada pungutan liar (pungli) dalam pelayanan'],
            ['U7', 'AGREEMENT', 'ONLINE', 'Tidak ada percaloan/perantara tidak resmi dalam pelayanan'],

            ['U5', 'SUITABILITY', 'ONLINE', 'Produk layanan yang diterima sesuai dengan yang dipublikasikan'],

            ['U6', 'AGREEMENT', 'ONLINE', 'Aplikasi sistem pelayanan merespon kebutuhan dengan cepat'],
            ['U6', 'AGREEMENT', 'ONLINE', 'Fitur pada aplikasi sistem layanan mudah digunakan'],

            ['U7', 'AGREEMENT', 'ONLINE', 'Seluruh pengguna layanan dilayani secara adil tanpa diskriminasi'],
            ['U7', 'AGREEMENT', 'ONLINE', 'Pelayanan diberikan tanpa imbalan di luar aturan'],

            ['U8', 'AGREEMENT', 'ONLINE', 'Layanan konsultasi dan pengaduan mudah diakses'],
            ['U9', 'AGREEMENT', 'ONLINE', 'Sistem layanan online nyaman dan mudah digunakan'],

            /*
            |--------------------------------------------------------------------------
            | OFFLINE
            |--------------------------------------------------------------------------
            */
            ['U1', 'SUITABILITY', 'OFFLINE', 'Informasi pelayanan tersedia melalui media elektronik maupun nonelektronik'],
            ['U1', 'SUITABILITY', 'OFFLINE', 'Kesesuaian persyaratan dengan informasi yang diberikan'],

            ['U2', 'AGREEMENT', 'OFFLINE', 'Standar dan prosedur layanan diinformasikan dengan jelas'],
            ['U2', 'AGREEMENT', 'OFFLINE', 'Prosedur/Alur layanan mudah dipahami dan dilakukan'],
            ['U2', 'AGREEMENT', 'OFFLINE', 'Layanan diberikan sesuai prosedur tanpa kecurangan'],

            ['U3', 'SUITABILITY', 'OFFLINE', 'Jangka waktu layanan sesuai dengan yang diinformasikan'],
            ['U4', 'SUITABILITY', 'OFFLINE', 'Biaya layanan sesuai dengan yang diinformasikan'],

            ['U7', 'AGREEMENT', 'OFFLINE', 'Tidak ada pungutan liar (pungli) dalam pelayanan'],
            ['U7', 'AGREEMENT', 'OFFLINE', 'Tidak ada percaloan/perantara tidak resmi dalam pelayanan'],

            ['U5', 'SUITABILITY', 'OFFLINE', 'Produk layanan yang diterima sesuai dengan yang dipublikasikan'],

            ['U6', 'AGREEMENT', 'OFFLINE', 'Petugas merespon kebutuhan dengan cepat'],
            ['U7', 'AGREEMENT', 'OFFLINE', 'Petugas melayani saya dengan ramah'],

            ['U8', 'AGREEMENT', 'OFFLINE', 'Layanan konsultasi dan pengaduan mudah diakses'],
            ['U9', 'AGREEMENT', 'OFFLINE', 'Sarana prasarana nyaman dan mudah digunakan'],

            /*
            |--------------------------------------------------------------------------
            | HYBRID
            |--------------------------------------------------------------------------
            */
            ['U1', 'SUITABILITY', 'HYBRID', 'Informasi pelayanan tersedia melalui media elektronik maupun nonelektronik'],
            ['U1', 'SUITABILITY', 'HYBRID', 'Kesesuaian persyaratan dengan informasi yang diberikan'],

            ['U2', 'AGREEMENT', 'HYBRID', 'Standar dan prosedur layanan diinformasikan dengan jelas'],
            ['U2', 'AGREEMENT', 'HYBRID', 'Prosedur/Alur layanan mudah dipahami dan dilakukan'],
            ['U2', 'AGREEMENT', 'HYBRID', 'Layanan diberikan sesuai prosedur tanpa kecurangan'],

            ['U3', 'SUITABILITY', 'HYBRID', 'Jangka waktu layanan sesuai dengan yang diinformasikan'],
            ['U4', 'SUITABILITY', 'HYBRID', 'Biaya layanan sesuai dengan yang diinformasikan'],

            ['U7', 'AGREEMENT', 'HYBRID', 'Tidak ada pungutan liar (pungli) dalam pelayanan'],
            ['U7', 'AGREEMENT', 'HYBRID', 'Tidak ada percaloan/perantara tidak resmi dalam pelayanan'],

            ['U5', 'SUITABILITY', 'HYBRID', 'Produk layanan yang diterima sesuai dengan yang dipublikasikan'],

            ['U6', 'AGREEMENT', 'HYBRID', 'Petugas merespon kebutuhan dengan cepat'],
            ['U6', 'SPEED', 'HYBRID', 'Aplikasi sistem pelayanan merespon kebutuhan dengan cepat'],

            ['U7', 'AGREEMENT', 'HYBRID', 'Petugas melayani saya dengan ramah'],
            ['U6', 'AGREEMENT', 'HYBRID', 'Fitur pada aplikasi sistem layanan mudah digunakan'],

            ['U8', 'AGREEMENT', 'HYBRID', 'Layanan konsultasi dan pengaduan mudah diakses'],
            ['U9', 'AGREEMENT', 'HYBRID', 'Sarana prasarana nyaman dan mudah digunakan'],
            ['U9', 'AGREEMENT', 'HYBRID', 'Sistem layanan online nyaman dan mudah digunakan'],
        ];

        foreach ($questions as [$elementCode, $scaleCode, $channel, $text]) {
            DB::table('questions')->insert(
                [
                    'element_id' => $elements[$elementCode],
                    'option_scale_id' => $optionScales[$scaleCode],
                    'question_code' =>  'P1',
                    'question_text' => $text,
                    'service_channel' => $channel,
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
