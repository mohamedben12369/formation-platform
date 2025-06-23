<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Domaine;
use Illuminate\Support\Facades\DB;

class DomaineSeeder extends Seeder
{
    public function run()
    {
        // Supprimer les données existantes


        $domaines = [
            [
                'nom' => 'Technologie',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nom' => 'Finance',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nom' => 'Télécommunications',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nom' => 'Industrie',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nom' => 'Tourisme',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nom' => 'Santé',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        DB::table('domaines')->upsert($domaines, ['nom']);
    }
}
