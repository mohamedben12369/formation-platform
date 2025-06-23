<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeExperienceSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('type_experiences')->insert([
            ['nom' => 'Stage'],
            ['nom' => 'Emploi'],
            ['nom' => 'Bénévolat'],
            ['nom' => 'Freelance'],
            ['nom' => 'Alternance'],
        ]);
    }
}
