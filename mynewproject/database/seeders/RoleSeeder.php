<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'nom' => 'Entreprise',
                'permession' => 'entreprise',
                'color' => 'blue',
                'icon' => 'building',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Formateur',
                'permession' => 'formateur',
                'color' => 'green',
                'icon' => 'chalkboard-teacher',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Autre',
                'permession' => 'autre',
                'color' => 'gray',
                'icon' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
} 