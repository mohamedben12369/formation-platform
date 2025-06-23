<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeDiplomeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('type_diplomes')->upsert([
            [ 'nom' => 'Licence', 'created_at' => now(), 'updated_at' => now() ],
            [ 'nom' => 'Master', 'created_at' => now(), 'updated_at' => now() ],
            [ 'nom' => 'Doctorat', 'created_at' => now(), 'updated_at' => now() ],
            [ 'nom' => 'BTS', 'created_at' => now(), 'updated_at' => now() ],
        ], ['nom']);
    }
}
