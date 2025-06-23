<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeFormationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $typeFormations = [
            [
                'code' => 'INIT',
                'nom' => 'Formation initiale'
            ],
            [
                'code' => 'CONT',
                'nom' => 'Formation continue'
            ],
            [
                'code' => 'CERT',
                'nom' => 'Formation certifiante'
            ],
            [
                'code' => 'DIPL',
                'nom' => 'Formation diplômante'
            ],
            [
                'code' => 'QUAL',
                'nom' => 'Formation qualifiante'
            ],
        ];

        // Use upsert instead of insert to handle duplicates
        DB::table('type_formations')->upsert(
            $typeFormations,
            ['code'], // Unique key
            ['nom'] // Columns to update
        );
    }
}
