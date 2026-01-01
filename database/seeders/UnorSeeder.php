<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class UnorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Path to your SQL file
        $path = database_path('seeders/sql/unor.sql');

        // Read the content of the SQL file
        $sql = File::get($path);

        // Execute the SQL statements
        DB::unprepared($sql);
    }
}
