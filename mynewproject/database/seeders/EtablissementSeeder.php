<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EtablissementSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('etablissements')->upsert([
            [
                'id' => 1,
                'nom' => 'Université de Paris',
                'ville' => 'Paris',
                'pays' => 'France',
                'telephone' => '0102030405',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'nom' => 'Université de Lyon',
                'ville' => 'Lyon',
                'pays' => 'France',
                'telephone' => '0203040506',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 3,
                'nom' => 'Université de Marseille',
                'ville' => 'Marseille',
                'pays' => 'France',
                'telephone' => '0304050607',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 4,
                'nom' => 'Université de Casablanca',
                'ville' => 'Casablanca',
                'pays' => 'Maroc',
                'telephone' => '0405060708',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ], ['id'], ['nom', 'ville', 'pays', 'telephone', 'updated_at']);
    }
}
