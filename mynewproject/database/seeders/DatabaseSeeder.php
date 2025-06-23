<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SecuriteQuestionSeeder::class,
            DomaineSeeder::class,
            SousDomaineSeeder::class,
            NiveauSeeder::class,
            AxeSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            CompetenceSeeder::class,
            TypeDiplomeSeeder::class,
            EtablissementSeeder::class,
            TypeFormateurSeeder::class,
            TypeFormationSeeder::class,
            StatutFormationSeeder::class,
            ThemeFormationSeeder::class,
            EntrepriseSeeder::class,
            FormationSeeder::class,
        ]);
    }
}
