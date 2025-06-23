<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NiveauSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('niveaux')->upsert([
            [ 'nom' => 'Débutant', 'created_at' => now(), 'updated_at' => now() ],
            [ 'nom' => 'Intermédiaire', 'created_at' => now(), 'updated_at' => now() ],
            [ 'nom' => 'Avancé', 'created_at' => now(), 'updated_at' => now() ],
            [ 'nom' => 'Expert', 'created_at' => now(), 'updated_at' => now() ],
        ], ['nom']);
    }
}
