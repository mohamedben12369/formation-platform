<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatutFormationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
          $statutFormations = [
            [
                'code' => 'PLAN',
                'nom' => 'Planifiée',
                'dateCreation' => $now
            ],
            [
                'code' => 'ENCOURS',
                'nom' => 'En cours',
                'dateCreation' => $now
            ],
            [
                'code' => 'TERM',
                'nom' => 'Terminée',
                'dateCreation' => $now
            ],
            [
                'code' => 'ANNUL',
                'nom' => 'Annulée',
                'dateCreation' => $now
            ],
            [
                'code' => 'REPORT',
                'nom' => 'Reportée',
                'dateCreation' => $now
            ]
        ];

        DB::table('statut_formations')->insert($statutFormations);
    }
}
