<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EntrepriseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer des entreprises
        $entreprises = [
            [
                'nom' => 'Entreprise 1',
                'email' => 'entreprise1@example.com',
                'Adresse' => 'Adresse de l\'entreprise 1',
                'tel' => '0612345678',
                'fax' => '0512345678',
                'CNSS' => 'CNSS2807423',
                'IF' => 'IF123456',
                'RC' => 'RC789012',
                'ICE' => 'ICE345678',
                'patente' => 'PAT901234',
                'date_creation' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nom' => 'Entreprise 2',
                'email' => 'entreprise2@example.com',
                'Adresse' => 'Adresse de l\'entreprise 2',
                'tel' => '0612345679',
                'fax' => '0512345679',
                'CNSS' => 'CNSS2807424',
                'IF' => 'IF123457',
                'RC' => 'RC789013',
                'ICE' => 'ICE345679',
                'patente' => 'PAT901235',
                'date_creation' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nom' => 'Entreprise 3',
                'email' => 'entreprise3@example.com',
                'Adresse' => 'Adresse de l\'entreprise 3',
                'tel' => '0612345680',
                'fax' => '0512345680',
                'CNSS' => 'CNSS2807425',
                'IF' => 'IF123458',
                'RC' => 'RC789014',
                'ICE' => 'ICE345680',
                'patente' => 'PAT901236',
                'date_creation' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        // Insert all enterprises
        DB::table('entreprises')->insert($entreprises);
    }
}
