<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeFormateurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $typeFormateurs = [
            ['nom' => 'Formateur interne'],
            ['nom' => 'Formateur externe'],
            ['nom' => 'Expert métier'],
            ['nom' => 'Enseignant-chercheur'],
            ['nom' => 'Coach professionnel'],
        ];

        DB::table('type_formateurs')->insert($typeFormateurs);
    }
}
