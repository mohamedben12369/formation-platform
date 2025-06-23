<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AxeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('axes')->upsert([
            [ 'nom' => 'HARDSKILLS', 'description' => 'Développement des outils', 'created_at' => now(), 'updated_at' => now() ],
            [ 'nom' => 'SOFTSKILLS', 'description' => 'Développement personels', 'created_at' => now(), 'updated_at' => now() ],
        ], ['nom']);
    }
}
